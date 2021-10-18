<?php

namespace App\Http\Controllers;

use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\EnrollmentPeriods;
use App\Models\ConfirmationLetter;
use App\Models\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use Str;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($student_id, $grade_id)
    {
        try {
            $parent_id = ParentProfile::getParentId();
            $studentProfileData = StudentProfile::whereId($student_id)->first();
            $pdfname = $studentProfileData->fullname . '_' . $student_id . '_'  . $studentProfileData->d_o_b->format('F_d_Y') . '_' . 'Confirmation_letter';
            $enrollment_periods = StudentProfile::where('student_profiles.parent_profile_id', $parent_id)
                ->where('enrollment_periods.grade_level', $grade_id)
                ->join('enrollment_periods', 'enrollment_periods.student_profile_id', 'student_profiles.id')->where('enrollment_periods.student_profile_id', $student_id)
                ->with('enrollmentPeriods')->first();
            $confirmation_data = ConfirmationLetter::where('student_profile_id', $student_id)->first();
            if ($enrollment_periods !== null) {
                $data = [
                    'student' => $studentProfileData,
                    'enrollment' => $enrollment_periods,
                    'title' => 'Confirmation of Enrollment',
                    'date' => date('M j, Y'),
                    'confirmData' => $confirmation_data,
                    'type' => 'signed'
                ];
                $pdf = PDF::loadView('confirmationLetter', $data);
                Storage::put(ConfirmationLetter::UPLOAD_DIR_STUDENT . '/' . $pdfname . '.' . Str::random(10), $pdf->output());
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
            report($e);
            $notification = [
                'message' => 'Failed!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
}
