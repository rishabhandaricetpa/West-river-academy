<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentProfile;
use App\Models\ParentProfile;
use App\Models\TranscriptPayment;
use App\Models\Transcript;
use Auth;
use DB;

class TranscriptWizardController extends Controller
{
    public function index()
    {
        $parentId = ParentProfile::getParentId();
        $enroll_students = StudentProfile::where('parent_profile_id', $parentId)->get();
        return view('transcript_wizard.view_students', compact('enroll_students'));
    }
    /**
     * Get all the purchased transcript for particular student
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function getAllTranscriptForWiz($student_id)
    {
        $enroll_student = StudentProfile::find($student_id);
        $allEnrollmentPeriods = $enroll_student->enrollmentPeriods()->get();
        $enrollment_ids = collect($allEnrollmentPeriods)->pluck('id');

        $payment_info = DB::table('enrollment_periods')
            ->whereIn('enrollment_payment_id', $enrollment_ids)
            ->join('enrollment_payments', 'enrollment_payments.enrollment_period_id', 'enrollment_periods.id')
            ->where('enrollment_payments.status', 'paid')
            ->get();
        if (count($payment_info) == 0) {
            return view('transcript.dashboard-notify', compact('enroll_student'));
        } else {
            $transcriptPayments = DB::table('transcripts')->where('student_profile_id', $student_id)
                ->join('transcript_payments', 'transcript_payments.transcript_id', 'transcripts.id')
                ->where('transcripts.transcript_wiz', 'YES')
                ->get();
            if (count($transcriptPayments) == 0) {
            }
        }
        return view('transcript_wizard.student-transcripts', compact('enroll_student', 'transcriptPayments'));
        // }
    }
    public function getAllTranscript($student_id)
    {
        $enroll_student = StudentProfile::find($student_id);
        return view('transcript_wizard.transcript_wizard_type', compact('enroll_student'));
    }

    public function createTranscript(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $enroll_student = StudentProfile::find($id);
            $type = $request->get('grade');
            $transcriptData = Transcript::create([
                'parent_profile_id' => ParentProfile::getParentId(),
                'student_profile_id' => $id,
                'period' => $request->get('grade'),
                'status' => 'pending',
                'transcript_wiz' => 'Yes',
            ]);
            TranscriptPayment::updateOrInsert(['transcript_id' => $transcriptData->id], ['amount' => '']);
            DB::commit();
            if ($transcriptData->period == 'K-8') {
                return view('transcript.dashboard-transcript', compact('enroll_student', 'transcriptData'));
            } else {
                $transcript_id = $transcriptData->id;
                return view('transcript9to12.ready-for-start', compact('id', 'enroll_student', 'transcript_id'));
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }


    public function saveDraft($student_id, $transcript_id)
    {
        $id = Auth::user()->id;
        $type = Transcript::whereId($transcript_id)->first();
        $notification = [
            'message' => 'Transcript Wizard saved Successfully!',
            'alert-type' => 'success',
        ];
        return view('transcript_wizard.thankyou', compact('student_id', 'transcript_id', 'type', 'id'))->with($notification);
    }
}
