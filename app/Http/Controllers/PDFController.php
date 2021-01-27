<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\StudentProfile;
use PDF;
use Auth;

class PDFController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $Userid =Auth::user()->id;
        $parentProfileData = User::find($Userid)->parentProfile()->first();
        $id = $parentProfileData->id;
        $data = [
            'title' => 'Confirmation of Enrollment',
            'date' => date('m/d/Y')
        ];
        
        $pdf = PDF::loadView('confirmationLetter', $data);
    
        return $pdf->download('Confirmation.pdf');
    }
}
