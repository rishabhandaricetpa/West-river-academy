<?php

namespace App\Http\Controllers;

use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
        $Userid = Auth::user()->id;
        $parentProfileData = User::find($Userid)->parentProfile()->first();
        $studentProfileData=StudentProfile::whereId($id)->first();
        $pdfname=$studentProfileData->first_name.'_'.$studentProfileData->last_name.'_'.$studentProfileData->d_o_b->format('M_d_Y').'_'.'Confirmation_letter';
        $enrollment_periods = StudentProfile::find($studentProfileData->id)->enrollmentPeriods()->get();
        $id = $parentProfileData->id;
        $data = [
            'student'=>$studentProfileData,
            'enrollment'=>$enrollment_periods,
            'title' => 'Confirmation of Enrollment',
            'date' => date('m/d/Y'),
        ];
        $pdf = PDF::loadView('confirmationLetter', $data);
        // Storage::disk('local')->put('public/pdf/Confirmation.pdf', $pdf->output());
        return $pdf->download($pdfname.'.pdf');
    }
}
