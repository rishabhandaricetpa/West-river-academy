<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transcript;
use App\Models\TranscriptK8;
use App\Models\TranscriptPayment;
use App\Models\TranscriptPdf;
use DB;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload($student_id, $transcript_id)
    {
        return view('admin.transcript.fileUpload', compact('student_id', 'transcript_id'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'transcript_file' => 'required|mimes:pdf|max:2048',
            ]);
            $fileName = $request->transcript_file->getClientOriginalName();

            $request->transcript_file->move(public_path('storage/pdf'), $fileName);

            //store file to the teanscript_pdf table

            //store pdf link
            $storetranscript = TranscriptPdf::where('transcript_id', $request->get('transcript_id'))
                ->where('status', 'completed')->first();
            if ($storetranscript != null) {
                $storetranscript->pdf_link = $fileName;
                $storetranscript->save();
            }
            $updateTranscriptStatus = Transcript::whereId($request->get('transcript_id'))
                ->where('status', 'completed')->first();
            if ($updateTranscriptStatus != null) {
                $updateTranscriptStatus->status = 'approved';
                $updateTranscriptStatus->save();
            }
            $paymentsTranscriptStatus = TranscriptPayment::where('transcript_id', $request->get('transcript_id'))
                ->where('status', 'completed')->first();
            if ($paymentsTranscriptStatus != null) {
                $paymentsTranscriptStatus->status = 'approved';
                $paymentsTranscriptStatus->save();
            }
            DB::commit();

            return back()
                ->with('success', 'You have successfully upload file.')
                ->with('file', $fileName);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Data Missmatch',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
}
