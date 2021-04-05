<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\TranscriptPdf;
use App\Models\NotarizationPayment;
use App\Models\Notarization;
use App\Models\ConfirmationLetter;
use App\Models\CustomLetterPayment;
use DB;

class NotarizationController extends Controller
{

    public function index()
    {
        $parent_id = ParentProfile::getParentId();
        $countries = Country::get();
        $students = StudentProfile::select('id', 'first_name', 'last_name', 'gender')
            ->selectRaw('DATE(d_o_b) as dob')
            ->where('parent_profile_id', $parent_id)
            ->with('graduation')
            ->get();
        $transcript = TranscriptPdf::where('status', 'approved')->get();
        // dd($transcript);
        $confirmationLetter = ConfirmationLetter::where('status', 'completed')->get();
        $custom_letter = CustomLetterPayment::where('status', 'completed')->get();
        $transcriptdoc = DB::table('confirmation_letters')->select('transcript_pdf.pdf_link', 'confirmation_letters.pdf_link as confirm')
            ->where('confirmation_letters.parent_profile_id', $parent_id)->where('confirmation_letters.status', 'completed')
            ->join('transcript_pdf', 'transcript_pdf.parent_profile_id', 'confirmation_letters.parent_profile_id')
            ->get();
        $notarization_fee = getFeeDetails('notarization_doc_fee');
        $appostile_fee = getFeeDetails('apostille_doc_fee');
        return view('orderPostage/notarization', compact('countries', 'students', 'transcriptdoc', 'notarization_fee', 'appostile_fee', 'transcript', 'confirmationLetter', 'custom_letter'));
    }


    public function getCountryShippingCharges(Request $request)
    {
        $country_shipping = getCountryAmount($request->country_name);
        return response()->json($country_shipping);
    }

    // public function store(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $parent_id = ParentProfile::getParentId();
    //         $doctotal = count(collect($request)->get('documents'));
    //         $notarizationDetails = Notarization::create([
    //             'parent_profile_id' => $parent_id,
    //             'additional_message' => $request['message'],
    //             'postage_option' => $request['payfor'],
    //             'first_name' => $request['first_name'],
    //             'last_name' => $request['last_name'],
    //             'street' => $request['street'],
    //             'city' => $request['city'],
    //             'state' => $request['state'],
    //             'zip_code' => $request['zip_code'],
    //             'country' => $request['country'],
    //             'apostille_country' =>  $request['apostille_country'],
    //         ]);

    //         DB::commit();
    //         if ($request->expectsJson()) {
    //             return response()->json(['status' => 'success', 'message' => 'Record added successfully', 'data' => $notarizationDetails]);
    //         }
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         if ($request->expectsJson()) {
    //             return response()->json(['status' => 'error', 'message' => 'Failed to Record']);
    //         }
    //     }
    // }
}
