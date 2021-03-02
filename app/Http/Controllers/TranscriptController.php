<?php

namespace App\Http\Controllers;

use App\Models\Transcript;
use App\Models\StudentProfile;
use App\Models\EnrollmentPeriods;
use App\Models\Cart;
use App\Models\ParentProfile;
use App\Models\Country;
use App\Models\Course;
use App\Models\Subject;
use App\Models\EnrollmentPayment;
use App\Models\TranscriptK8;
use App\Models\TranscriptCourse;
use App\Models\TranscriptPdf;
use App\Models\TranscriptPayment;
use App\Models\FeesInfo;
use Illuminate\Http\Request;
use App\Mail\TranscriptEmail;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use Storage;
use Illuminate\Support\Facades\Mail;


class TranscriptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $enroll_students = ParentProfile::find($id)->studentProfile()->get();
        return view('transcript.graduation-app', compact('enroll_students'));
    }
    // public function notification(Request $request, $id)
    // {
    //     if ($request->get('grade') == 'K-8') {
    //         $student = StudentProfile::find($id);
    //         // return view('transcript.dashboard-transcript', compact('student','transcriptData'));
    //     } else {
    //         //add screen for 9-12 students
    //         dd('Add 9-12 screen');
    //     }
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewEnrollment(Request $request, $id)
    {

        $student = StudentProfile::find($id);
        $student->first_name = $request->get('first_name');
        $student->middle_name = $request->get('middle_name');
        $student->last_name = $request->get('last_name');
        $student->update();

        $transcript =  TranscriptK8::create(
            [
                'student_profile_id' => $id,
                'country' => $request->get('country'),
                'transcript_id' => $request->get('transcript_id'),
            ]
        );
        return view('transcript.grade', compact('transcript', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function viewStudent($id)
    {
        $enroll_student = StudentProfile::find($id);

        $allEnrollmentPeriods = StudentProfile::find($id)->enrollmentPeriods()->get();

        $id =  collect($allEnrollmentPeriods)->pluck('id');

        $payment_info = DB::table('enrollment_periods')
            ->whereIn('enrollment_payment_id', $id)
            ->join('enrollment_payments', 'enrollment_payments.enrollment_period_id', 'enrollment_periods.id')
            ->where('enrollment_payments.status', 'paid')
            ->get();
        if (count($payment_info) == 0) {
            return view('transcript.dashboard-notify', compact('enroll_student'));
        } else {
            $transcriptPayment = DB::table('transcripts')->whereIn('student_profile_id', $id)
                ->join('transcript_payments', 'transcript_payments.transcript_id', 'transcripts.id')
                ->where('transcript_payments.status', 'paid')
                ->first();
            if ($transcriptPayment) {
                $transcriptData = $transcriptPayment->transcript_id;
                $student = StudentProfile::find($id)->first();
                return view('transcript.dashboard-transcript', compact('student', 'transcriptPayment', 'transcriptData'));
            } else {
                return view('transcript.transcript-wizard', compact('enroll_student'));
            }
        }
    }
    public function displayStudent($id, $transcriptData_id)
    {
        $studentProfile = StudentProfile::find($id);
        $countries = Country::all();
        return view('transcript.dashboard-transcript-filling', compact('studentProfile', 'countries', 'transcriptData_id'));
    }
    public function storeGrade(Request $request, $id)
    {
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
        $items = array();
        foreach ($enrollment_periods as $key => $enrollment_period) {

            $items[] = \Carbon\Carbon::parse($enrollment_period->start_date_of_enrollment)->format('Y');
        }
        $result = array_unique($items);
        return view('transcript.transcript-enrollment-year', compact('transcript', 'id', 'result'));
    }
    public function storeYear(Request $request, $student_id, $transcript_id)
    {
        $transcript_id = $request->get('transcript_id');
        $transcript = TranscriptK8::find($transcript_id);
        if ($request->get('enrollment_year')) {
            $transcript->enrollment_year = $request->get('enrollment_year');
        } elseif ($request->get('other_year')) {
            $transcript->enrollment_year = $request->get('other_year');
        }
        $transcript->save();

        return redirect()->route('english.course', [$student_id, $transcript_id]);
    }


    public function viewAnotherEnrollment($student_id)
    {
        return view('transcript.grade');
    }
    public function displayAllCourse($transcript_id, $student_id)
    {

        $k8transcriptData = TranscriptK8::where('id', $transcript_id)->first();
        $transcript =  Transcript::where('id', $k8transcriptData->transcript_id)->first();

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
    public function deleteSchool($transcript_id)
    {
        $transcriptDetails = TranscriptK8::find($transcript_id)->delete();
        $notification = [
            'message' => 'School Record Deleted Successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function previewTranscript($student_id)
    {
        $parentId = ParentProfile::getParentId();
        $address = ParentProfile::where('id', $parentId)->first();
        $student = StudentProfile::find($student_id);
        $grades  = TranscriptK8::where('student_profile_id', $student_id)->orderBy('grade', 'ASC')->get(['grade']);
        $transcriptData = TranscriptK8::select()->where('student_profile_id', $student_id)
            ->with(['TranscriptDetails', 'TranscriptCourse.subject', 'TranscriptCourse.course'])
            ->get();
        $transcript_id = Transcript::select()->where('student_profile_id', $student_id)->where('status', "paid")->first();
        $groupCourses = TranscriptCourse::with(['subject'])->where('student_profile_id', $student_id)->get()->unique('subject_id');
        return view('transcript/preview-transcript', compact('student', 'transcriptData', 'grades', 'groupCourses', 'transcript_id', 'address'));
    }

    public function purchase(Request $request, $id)
    {

        if ($request->get('grade') == 'K-8') {
            $student = StudentProfile::find($id);
            $transcriptData = Transcript::create([
                'parent_profile_id' => ParentProfile::getParentId(),
                'student_profile_id' => $id,
                'period' => 'K-8',
                'status' => 'pending',
            ]);

            $transcript_fee = FeesInfo::getFeeAmount('transcript');
            TranscriptPayment::updateOrInsert(['transcript_id' => $transcriptData->id], ['amount' => $transcript_fee]);
            $transcript_id = $transcriptData->id;
            $id = Auth::user()->id;
            $user =  User::find($id)->first();
            $email = Auth::user()->email;
            Mail::to($email)->send(new TranscriptEmail($user));

            $student = StudentProfile::whereId($id)->with(['TranscriptK8', 'transcriptCourses', 'parentProfile'])->first();
            $transcript_fee = FeesInfo::getFeeAmount('transcript');
            return view('transcript.purchase-transcript', compact('student', 'transcript_fee', 'transcript_id'));
        } else {
            dd('Add 9-12 screen');
        }
    }
    public function downlaodTranscript($transcrip_id, $student_id)
    {
        $data = TranscriptPdf::where('transcript_id', $transcrip_id)->first();
        $pdflink = $data->pdf_link;
        $students = StudentProfile::whereId($student_id)->first();

        return view('transcript/download-transcript', compact('students', 'transcrip_id', 'student_id', 'pdflink'));
    }
    public function submitTranscript($student_id, $transcrip_id)
    {
        $transcript_payment =  TranscriptPayment::where('transcript_id', $transcrip_id)->first();
        if ($transcript_payment != null) {
            $transcript_payment->status = 'completed';
        }
        $transcript_payment->save();
        $transcriptData =  Transcript::whereId($transcrip_id)->first();
        if ($transcriptData != null) {
            $transcriptData->status = 'completed';
        }
        $transcriptData->save();
        //store pdf link
        $storetranscript = TranscriptPdf::create([
            'student_profile_id' => $student_id,
            'transcript_id' => $transcrip_id, //save the transcript id to column
            'status' => 'completed',
        ]);
        $notification = [
            'message' => 'Transcript Submitted Successfully!',
            'alert-type' => 'success',
        ];

        return redirect('transcript-submitted')->with($notification);
    }
    public function fetchfile($transcrip_id, $student_id)
    {
        // if(isEmpty($id)){
        //     alert('Transcript Not approved yet');
        // }else{
        $data = TranscriptPdf::where('transcript_id', $transcrip_id)->first();
        $pdflink = $data->pdf_link;
        //    dd($pdflink);
        //    $pdf = PDF::loadView('admin.transcript.pdf', $data);

        return response()->download('storage/pdf/' . $pdflink);
        // }
    }

    //editApprovedTranscript
    public function editApprovedTranscript($transcript_id, $student_id)
    {
        $student = StudentProfile::find($student_id);
        $transcript_fee = FeesInfo::getFeeAmount('transcript_edit');
        $transcriptPayment = TranscriptPayment::Create(
            [
                'amount' => $transcript_fee,
                'transcript_id' => $transcript_id,
                'status' => 'pending',
            ]
        );
        $student = StudentProfile::whereId($student_id)->with(['TranscriptK8', 'transcriptCourses', 'parentProfile'])->first();
        return view('transcript.edit_approved', compact('student', 'transcript_fee', 'transcript_id', 'transcriptPayment','student_id'));

        return view('transcript/edit_approved');
    }
}
