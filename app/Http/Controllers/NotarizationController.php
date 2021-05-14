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

        $students = StudentProfile::where('parent_profile_id', $parent_id)->with(['graduation', 'parentProfile'])->first();

        $transcript = TranscriptPdf::whereNotNull('pdf_link')->where('parent_profile_id',$parent_id)->get();
        $confirmationLetter = ConfirmationLetter::where('status', 'completed')->where('parent_profile_id',$parent_id)->get();
        $custom_letter = CustomLetterPayment::where('status', 'completed')->where('parent_profile_id',$parent_id)->get();
        $transcriptdoc = DB::table('confirmation_letters')->select('transcript_pdf.pdf_link', 'confirmation_letters.pdf_link as confirm')
            ->where('confirmation_letters.parent_profile_id', $parent_id)->where('confirmation_letters.status', 'completed')
            ->join('transcript_pdf', 'transcript_pdf.parent_profile_id', 'confirmation_letters.parent_profile_id')
            ->get();
        $notarization_fee = getFeeDetails('notarization_doc_fee');
        $appostile_fee = getFeeDetails('apostille_doc_fee');
        return view('orderPostage/notarization', compact('countries', 'students', 'transcriptdoc', 'notarization_fee', 'appostile_fee', 'transcript', 'confirmationLetter', 'custom_letter'));
    }

    public function chooseType(Request $request)
    {
        $parent_id = ParentProfile::getParentId();
        $countries = Country::get();

        $students = StudentProfile::where('parent_profile_id', $parent_id)->with(['graduation', 'parentProfile'])->first();

        $transcript = TranscriptPdf::whereNotNull('pdf_link')->where('parent_profile_id',$parent_id)->get();
        $confirmationLetter = ConfirmationLetter::where('status', 'completed')->where('parent_profile_id',$parent_id)->get();
        $custom_letter = CustomLetterPayment::where('status', 'completed')->where('parent_profile_id',$parent_id)->get();
        $transcriptdoc = DB::table('confirmation_letters')->select('transcript_pdf.pdf_link', 'confirmation_letters.pdf_link as confirm')
            ->where('confirmation_letters.parent_profile_id', $parent_id)->where('confirmation_letters.status', 'completed')
            ->join('transcript_pdf', 'transcript_pdf.parent_profile_id', 'confirmation_letters.parent_profile_id')
            ->get();
        $notarization_fee = getFeeDetails('notarization_doc_fee');
        $appostile_fee = getFeeDetails('apostille_doc_fee');
        $type = $request->get('type');
        if ($type == 'apostille') {
            return view('orderPostage/apostille', compact('countries', 'students', 'transcriptdoc', 'notarization_fee', 'appostile_fee', 'transcript', 'confirmationLetter', 'custom_letter', 'type'));
        } else {
            return view('orderPostage/notarization', compact('countries', 'students', 'transcriptdoc', 'notarization_fee', 'appostile_fee', 'transcript', 'confirmationLetter', 'custom_letter', 'type'));
        }
    }
    public function getConsultationChrages()
    {
        $hourly_charge = getFeeDetails('consultation_fee');
        return view('orderPostage.order_consultation', compact('hourly_charge'));
    }


    public function getCountryShippingCharges(Request $request)
    {
        $country_shipping = getCountryAmount($request->country_name);
        return response()->json($country_shipping);
    }

    public function getPostageShippingTypes(Request $request)
    {
        if ($request->postage_type === 'express_usa') {
            $express = getFeeDetails('express_usa');
            return response()->json($express);
        } else
            $priority = getFeeDetails('priority_usa');
        return response()->json($priority);
    }

    public function viewOrderPostage()
    {
        $parent_id = ParentProfile::getParentId();
        $countries = Country::get();
        return view('orderPostage/order-postage', compact('countries'));
    }
}
