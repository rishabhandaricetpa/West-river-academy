<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\TranscriptPdf;
use App\Models\NotarizationPayment;
use App\Models\Notarization;
use DB;

class NotarizationController extends Controller
{

    public function index()
    {
        $parent_id = ParentProfile::getParentId();
        $countries = Country::select('country')->get();
        $students = StudentProfile::select('id', 'first_name', 'last_name', 'gender')
            ->selectRaw('DATE(d_o_b) as dob')
            ->where('parent_profile_id', $parent_id)
            ->with('graduation')
            ->get();
        $transcriptdoc = TranscriptPdf::select('transcript_pdf.pdf_link', 'documents.pdf_link')->whereNotNull('transcript_pdf.pdf_link')
            ->join('documents', 'documents.student_profile_id', 'transcript_pdf.student_profile_id')
            ->get();
        return view('orderPostage/notarization', compact('countries', 'students', 'transcriptdoc'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $parent_id = ParentProfile::getParentId();
            $doctotal = count(collect($request)->get('documents'));
            $notarizationDetails = Notarization::create([
                'parent_profile_id' => $parent_id,
                'number_of_documents' => $doctotal,
                'additional_message' => $request['message'],
                'postage_option' => $request['payfor'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'street' => $request['street'],
                'city' => $request['city'],
                'state' => $request['state'],
                'zip_code' => $request['zip_code'],
                'country' => $request['country'],
                'apostille_country' =>  $request['apostille_country'],
            ]);

            DB::commit();
            if ($request->expectsJson()) {
                return response()->json(['status' => 'success', 'message' => 'Record added successfully', 'data' => $notarizationDetails]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Failed to Record']);
            }
        }
    }
}
