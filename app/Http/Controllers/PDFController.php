<?php

namespace App\Http\Controllers;

use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\EnrollmentPeriods;
use App\Models\ConfirmationLetter;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($student_id)
    {
        try {
            $parent_id = ParentProfile::getParentId();
            $studentProfileData = StudentProfile::whereId($student_id)->first();
            $pdfname = $studentProfileData->fullname . '_' . $student_id . '_'  . $studentProfileData->d_o_b->format('M_d_Y') . '_' . 'Confirmation_letter';
            $enrollment_periods = StudentProfile::where('student_profiles.parent_profile_id', $parent_id)
                ->join('confirmation_letters', 'confirmation_letters.student_profile_id', 'student_profiles.id')->where('confirmation_letters.status', 'completed')
                ->join('enrollment_periods', 'enrollment_periods.student_profile_id', 'student_profiles.id')
                ->with('enrollmentPeriods')->get();
            if ($enrollment_periods !== null) {
                $data = [
                    'student' => $studentProfileData,
                    'enrollment' => $enrollment_periods,
                    'title' => 'Confirmation of Enrollment',
                    'date' => date('m/d/Y'),
                ];
                $pdf = PDF::loadView('confirmationLetter', $data);
                Storage::disk('local')->put('public/pdf/' . $pdfname . '.pdf', $pdf->output());

                //store pdf link
                $updatelink = ConfirmationLetter::where('student_profile_id', $student_id)->update(
                    [
                        'pdf_link' => $pdfname . '.pdf',
                        'status' => 'completed',
                    ]
                );
                return $pdf->download($pdfname . '.pdf');
            } else {
                $notification = [
                    'message' => 'Please check your enrollment ! If successfully enrolled and paid',
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }
        } catch (\Exception $e) {
            dd($e);
            $notification = [
                'message' => 'Failed!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
}
