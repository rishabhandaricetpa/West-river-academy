<?php

namespace App\Http\Controllers;

use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use PDF;

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
        $enrollment_periods = StudentProfile::find($studentProfileData->id)->enrollmentPeriods()->get();
        $id = $parentProfileData->id;
        $data = [
            'student'=>$studentProfileData,
            'enrollment'=>$enrollment_periods,
            'title' => 'Confirmation of Enrollment',
            'date' => date('m/d/Y'),
        ];

        $pdf = PDF::loadView('confirmationLetter', $data);

        return $pdf->download('Confirmation.pdf');
    }
}
