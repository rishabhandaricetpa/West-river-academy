<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Dashboard;
use App\Models\FeesInfo;
use App\Models\Notification;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\Transcript;
use App\Models\TranscriptCourse;
use App\Models\TranscriptK8;
use App\Models\TranscriptPayment;
use App\Models\TranscriptPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TranscriptController extends Controller
{
    /**
     * Display a listing of the all students.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $enroll_students = ParentProfile::find($id)->studentProfile()->get();
        return view('transcript.graduation-app', compact('enroll_students'));
    }

    /**
     * Show student enrollments for years page in transcript.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewEnrollment(Request $request, $id)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $student = StudentProfile::find($id);
            $student->first_name = $request->get('first_name');
            $student->middle_name = $request->get('middle_name');
            $student->last_name = $request->get('last_name');
            $student->update();

            $transcript = TranscriptK8::create(
                [
                    'student_profile_id' => $id,
                    'country' => $request->get('country'),
                    'transcript_id' => $request->get('transcript_id'),
                ]
            );
            DB::commit();

            return view('transcript.grade', compact('transcript', 'student'));
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Purchase a new transcript
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function purchaseNew($id)
    {
        try {

            $enrollment_ids =   getEnrollmetForStudents($id);
            // return view('transcript.transcript-wizard', compact('enroll_student'));
            DB::beginTransaction();
            $transcriptData = Transcript::create([
                'parent_profile_id' => ParentProfile::getParentId(),
                'student_profile_id' => $id,
                'period' => '',
                'status' => 'pending',
            ]);
            DB::commit();

            $payment_info = getPaymentInformation($enrollment_ids);

            if (count($payment_info) == 0) {
                return view('transcript.dashboard-notify', compact('enroll_student'));
            }
            $getPaidData = Transcript::where('student_profile_id', $id)->whereIn('status', ['approved', 'paid', 'completed', 'canEdit'])->get();
            $student = StudentProfile::whereId($id)->with(['TranscriptK8', 'transcriptCourses', 'parentProfile'])->first();
            if (count($getPaidData) > 0) {
                $transcript_fee = FeesInfo::getFeeAmount('additional_transcript');
                TranscriptPayment::updateOrInsert(['transcript_id' => $transcriptData->id], ['amount' => $transcript_fee]);
                $transcript_id = $transcriptData->id;
            } else {
                $transcript_fee = FeesInfo::getFeeAmount('transcript');
                TranscriptPayment::updateOrInsert(['transcript_id' => $transcriptData->id], ['amount' => $transcript_fee]);
                $transcript_id = $transcriptData->id;
            }
            return view('transcript.purchase-transcript', compact('student', 'transcript_fee', 'transcript_id'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
        // }
    }

    /**
     * Get all the purchased transcript for particular student
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function getAllTranscript($student_id)
    {
        $enrollment_ids =   getEnrollmetForStudents($id);

        $payment_info = getPaymentInformation($enrollment_ids);

        if (count($payment_info) == 0) {
            return view('transcript.dashboard-notify', compact('enroll_student'));
        } else {
            $transcriptPayments = DB::table('transcripts')->where('student_profile_id', $student_id)
                ->join('transcript_payments', 'transcript_payments.transcript_id', 'transcripts.id')
                ->where('transcript_payments.status', 'paid')
                ->get();
            return view('transcript.student-transcripts', compact('enroll_student', 'transcriptPayments'));
        }
        // }
    }

    /**
     * Change transcript screen according to the transcript type and payment status
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function createTranscript(Request $request, $transcript_id, $id)
    {
        $enroll_student = StudentProfile::find($id);
        $enrollment_ids =   getEnrollmetForStudents($id);
        $payment_info = getPaymentInformation($enrollment_ids);

        if (count($payment_info) == 0) {
            return view('transcript.dashboard-notify', compact('enroll_student'));
        } else {
            $transcriptPayment = DB::table('transcripts')->where('student_profile_id', $id)
                ->join('transcript_payments', 'transcript_payments.transcript_id', 'transcripts.id')
                ->where('transcripts.id', $transcript_id)
                ->first();
            if ($transcriptPayment) {
                if ($transcriptPayment->period == 'K-8') {
                    $transcriptData = $transcriptPayment->transcript_id;
                    return view('transcript.dashboard-transcript', compact('enroll_student', 'transcriptPayment', 'transcriptData'));
                } elseif ($transcriptPayment->period == '9-12') {
                    $transcript = Transcript::where('student_profile_id', $id)->first();
                    $transcript_id = $transcript_id;
                    return view('transcript9to12.ready-for-start', compact('id', 'enroll_student', 'transcript_id'));
                } else {
                    return view('transcript.transcript-wizard', compact('enroll_student', 'transcript_id'));
                }
            } else {
                return view('transcript.pending-payments', compact('id'));
            }
        }
    }
    /**
     * User Can Choose the Transcript type
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function updateTranscriptPeriodAndCreate(Request $request, $id)
    {
        try {
            $enroll_student = StudentProfile::find($id);
            $type = $request->get('grade');
            $transcript_id = $request->get('transcript_id');
            $transcriptData = Transcript::whereId($transcript_id)->first();
            $transcriptData->period = $request->get('grade');
            $transcriptData->save();
            if ($transcriptData->period == 'K-8') {
                return view('transcript.dashboard-transcript', compact('enroll_student', 'transcriptData'));
            } else {
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

    /**
     * Display Student
     *
     * @return \Illuminate\Http\Response
     */

    public function displayStudent($id, $transcriptData_id)
    {
        $studentProfile = StudentProfile::find($id);
        $countries = Country::all();

        return view('transcript.dashboard-transcript-filling', compact('studentProfile', 'countries', 'transcriptData_id'));
    }

    /**
     *Store grades to transcript k-8
     *
     * @return \Illuminate\Http\Response
     */
    public function storeGrade(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $transcript_id = $request->get('transcript_id');
            $transcript = TranscriptK8::find($transcript_id);
            $transcript->grade = $request->get('student_grade');

            if ($request->get('school_name') == 'West River Academy') {
                $transcript->school_name = $request->get('school_name');
            } elseif ($request->get('school_name') == 'Others') {
                $transcript->school_name = $request->get('other_school');
            }
            $transcript->save();

            $enrollment_periods = StudentProfile::find($id)->enrollmentPeriods()->get();
            $items = [];
            foreach ($enrollment_periods as $key => $enrollment_period) {
                $items[] = \Carbon\Carbon::parse($enrollment_period->start_date_of_enrollment)->format('Y');
            }
            $result = array_unique($items);
            DB::commit();

            return view('transcript.transcript-enrollment-year', compact('transcript', 'id', 'result'));
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    /**
     *Store selected years to transcript k-8
     *
     * @return \Illuminate\Http\Response
     */

    public function storeYear(Request $request, $student_id, $transcript_id)
    {
        try {
            DB::beginTransaction();
            $transcript_id = $request->get('transcript_id');
            $transcript = TranscriptK8::find($transcript_id);
            if ($request->get('enrollment_year')) {
                $transcript->enrollment_year = $request->get('enrollment_year');
            } elseif ($request->get('other_year')) {
                $transcript->enrollment_year = $request->get('other_year');
            }
            $transcript->save();
            DB::commit();

            return redirect()->route('english.course', [$student_id, $transcript_id]);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    /**
     *View another enrollments
     *
     * @return \Illuminate\Http\Response
     */

    public function viewAnotherEnrollment($student_id)
    {
        return view('transcript.grade');
    }

    /**
     *Display all the courses for  transcript k-8
     *
     * @return \Illuminate\Http\Response
     */

    public function displayAllCourse($transcript_id, $student_id)
    {
        $k8transcriptData = TranscriptK8::where('id', $transcript_id)->first();
        $transcript = Transcript::where('id', $k8transcriptData->transcript_id)->first();

        if ($transcript->status == 'approved') {
            dd('To edit this school course please pay $25 since this transcript is approved by WRA.');
        } else {
            $courses = TranscriptCourse::where('k8transcript_id', $transcript_id)
                ->join('k8transcript', 'k8transcript.id', 'transcript_course.k8transcript_id')
                ->join('courses', 'courses.id', 'transcript_course.courses_id')
                ->join('subjects', 'subjects.id', 'transcript_course.subject_id')
                ->get();

            $studentInfo = StudentProfile::find($student_id);
            $school = TranscriptK8::find($transcript_id);

            return view('transcript-wizard-grade', compact('courses', 'transcript_id', 'student_id', 'studentInfo', 'school'));
        }
    }

    /**
     *Delete the school name and its course and subject data for particular student
     *
     * @return \Illuminate\Http\Response
     */

    public function deleteSchool($transcript_id)
    {
        try {
            $transcriptDetails = TranscriptK8::find($transcript_id)->delete();
            $notification = [
                'message' => 'School Record Deleted Successfully!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    /**
     *Preview the transcript befor submission
     *
     * @return \Illuminate\Http\Response
     */

    public function previewTranscript($student_id, $transcript_id)
    {
        // dd($transcript_id);
        $parentId = ParentProfile::getParentId();
        $address = ParentProfile::where('id', $parentId)->first();
        $student = StudentProfile::find($student_id);
        $year = TranscriptK8::where('transcript_id', $transcript_id)->orderBy('enrollment_year', 'ASC')->get(['enrollment_year'])->unique('enrollment_year');

        $grades  = TranscriptK8::where('transcript_id', $transcript_id)->orderBy('grade', 'ASC')->get(['grade']);

        $transcriptData = TranscriptK8::select()->where('transcript_id', $transcript_id)
            ->with(['TranscriptDetails', 'TranscriptCourse.subject', 'TranscriptCourse.course'])
            ->get();
        $transcript_course_id = TranscriptK8::select('id')->where('transcript_id', $transcript_id)->get();
        $groupCourses = TranscriptCourse::with(['subject'])->whereIn('k8transcript_id', $transcript_course_id)->get()->unique('subject_id');
        if ($transcript_id) {
            $enrollment_periods = TranscriptK8::where('transcript_id', $transcript_id)->get();
            $years = collect($enrollment_periods)->pluck('enrollment_year');
            $maxYear = $years->max();
            $minYear = $years->min();
            return view('transcript/preview-transcript', compact('student', 'transcriptData', 'grades', 'groupCourses', 'transcript_id', 'address', 'year', 'minYear', 'maxYear'));
        } else {
            $enrollment_periods = TranscriptK8::where('transcript_id', $transcript_id)->get();
            $years = collect($enrollment_periods)->pluck('enrollment_year');
            $maxYear = $years->max();
            $minYear = $years->min();
            $transcript_id = Transcript::select()->where('student_profile_id', $student_id)->whereStatus('completed')->where('status', 'paid')->first();
            return view('transcript/preview-transcript', compact('student', 'transcriptData', 'grades', 'groupCourses', 'transcript_id', 'address', 'year', 'minYear', 'maxYear'));
        }
    }

    /**
     *Purchase transcript 
     *
     * @return \Illuminate\Http\Response
     */

    public function purchase(Request $request, $id)
    {
        if ($request->transcript_wiz !== 'Yes') {
            DB::beginTransaction();
            $type = $request->get('grade');
            $transcriptData = Transcript::create([
                'parent_profile_id' => ParentProfile::getParentId(),
                'student_profile_id' => $id,
                'period' => $request->get('grade'),
                'status' => 'pending',
            ]);
        } else {
            $type = $request->get('type');
            $transcriptData = Transcript::where('id', $request->get('transcript_id'))->first();
            $enrollment_ids =   getEnrollmetForStudents($id);
            $payment_info = getPaymentInformation($enrollment_ids);
            if (count($payment_info) == 0) {
                return view('transcript.dashboard-notify', compact('enroll_student'));
            }
        }
        try {
            $getPaidData = Transcript::where('student_profile_id', $id)->whereIn('status', ['approved', 'paid', 'completed', 'canEdit'])->get();
            $student = StudentProfile::whereId($id)->with(['TranscriptK8', 'transcriptCourses', 'parentProfile'])->first();
            if (count($getPaidData) > 0) {
                $transcript_fee = FeesInfo::getFeeAmount('additional_transcript');
                TranscriptPayment::updateOrInsert(['transcript_id' => $transcriptData->id], ['amount' => $transcript_fee]);
                $transcript_id = $transcriptData->id;
            } else {
                $transcript_fee = FeesInfo::getFeeAmount('transcript');
                TranscriptPayment::updateOrInsert(['transcript_id' => $transcriptData->id], ['amount' => $transcript_fee]);
                $transcript_id = $transcriptData->id;
            }
            DB::commit();
            return view('transcript.purchase-transcript', compact('student', 'transcript_fee', 'transcript_id', 'type'));
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

    /**
     *Download the transcript 
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function downlaodTranscript($transcrip_id, $student_id)
    {
        $data = TranscriptPdf::where('transcript_id', $transcrip_id)->first();
        $pdflink = $data->pdf_link;
        $students = StudentProfile::whereId($student_id)->first();
        return view('transcript/download-transcript', compact('students', 'transcrip_id', 'student_id', 'pdflink', 'data'));
    }

    /**
     *Submit final transcript 
     *
     * @return \Illuminate\Http\Response
     * 
     */

    public function submitTranscript($student_id, $transcrip_id)
    {
        $transcript_payment = TranscriptPayment::where('transcript_id', $transcrip_id)->first();
        if ($transcript_payment != null) {
            $transcript_payment->status = 'completed';
        }
        $transcript_payment->save();
        $transcriptData = Transcript::whereId($transcrip_id)->first();
        if ($transcriptData != null) {
            $transcriptData->status = 'completed';
            Dashboard::create([
                'student_profile_id' => $student_id,
                'linked_to' => $transcript_payment->id,
                'is_archieved' => 0,
                'related_to' => 'transcript_ordered',
                'notes' =>  $transcriptData['student']['fullname'],
                'created_date' => \Carbon\Carbon::now()->format('M d Y'),
            ]);
        }
        $transcriptData->save();
        // notification bell for succesfully creating transcript
        if ($transcriptData->period == 'K-8') {
            Notification::create([
                'parent_profile_id' => ParentProfile::getParentId(),
                'content' => 'Your transcript has been sucessfully created',
                'type' => 'transcript_submitted_k8',
                'read' => 'false',
                'student_profile_id' => $student_id,
                'transcript_id' => $transcrip_id
            ]);
        } else {
            Notification::create([
                'parent_profile_id' => ParentProfile::getParentId(),
                'content' => 'Your transcript has been sucessfully created',
                'type' => 'transcript_submitted_9_12',
                'read' => 'false',
                'student_profile_id' => $student_id,
                'transcript_id' => $transcrip_id
            ]);
        }


        //store pdf link
        $storetranscript = TranscriptPdf::create([
            'parent_profile_id' => ParentProfile::getParentId(),
            'student_profile_id' => $student_id,
            'transcript_id' => $transcrip_id, //save the transcript id to column
            'status' => 'completed',
        ]);
        $storetranscript->save();
        $notification = [
            'message' => 'Transcript Submitted Successfully!',
            'alert-type' => 'success',
        ];

        return redirect('transcript-submitted')->with($notification);
    }

    /**
     *Display transcript to student and parent after approval from backend
     *
     * @return \Illuminate\Http\Response
     * 
     */



    /**
     *Edit the approved transcript with $25 extra charge
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function editApprovedTranscript($transcript_id, $student_id)
    {
        $student = StudentProfile::find($student_id);
        $transcript_fee = FeesInfo::getFeeAmount('transcript_edit');
        $transcriptPayment = TranscriptPayment::updateOrCreate(
            ['transcript_id' => $transcript_id],
            [
                'amount' => $transcript_fee,
                'transcript_id' => $transcript_id,
                'status' => 'pending',
            ]
        );
        $student = StudentProfile::whereId($student_id)->with(['TranscriptK8', 'transcriptCourses', 'parentProfile'])->first();

        return view('transcript.edit_approved', compact('student', 'transcript_fee', 'transcript_id', 'transcriptPayment', 'student_id'));

        return view('transcript/edit_approved');
    }
}
