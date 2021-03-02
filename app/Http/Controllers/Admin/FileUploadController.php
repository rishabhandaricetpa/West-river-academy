<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload()
    {
        return view('admin.transcript.fileUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:pdf|max:2048',
            ]);

            $fileName = time() . '.' . $request->file->extension();

            $request->file->move(public_path('storage/pdf'), $fileName);
            return back()
                ->with('success', 'You have successfully upload file.')
                ->with('file', $fileName);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Missing Information!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
}
