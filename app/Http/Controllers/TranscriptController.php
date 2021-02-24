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
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\User;
use PDF;
use Storage;

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
    public function notification(Request $request, $id)
    {
        if ($request->get('grade') == 'K-8') {
            $transcriptData = Transcript::create([
                'parent_profile_id' => ParentProfile::getParentId(),
                'student_profile_id' => $id,
                'period' => 'K-8',
                'status' => 'pending',
            ]);
            $transcript_fee = FeesInfo::getFeeAmount('transcript');
            TranscriptPayment::updateOrInsert(['transcript_id' => $transcriptData->id],[ 'amount' => $transcript_fee]);
            $student = StudentProfile::find($id);
            return view('transcript.dashboard-transcript', compact('student','transcriptData'));
        } else {
            //add screen for 9-12 students
            dd('Add 9-12 screen');
        }
    }
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
                'transcript_id'=>$request->get('transcript_id'),
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
            return view('transcript.transcript-wizard', compact('enroll_student'));
        }
    }
    public function displayStudent($id,$transcriptData_id)
    {
        $studentProfile = StudentProfile::find($id);
        $countries = Country::all();
        return view('transcript.dashboard-transcript-filling', compact('studentProfile', 'countries','transcriptData_id'));
    }
    public function storeGrade(Request $request, $id)
    {
        $transcript_id = $request->get('transcript_id');
        $transcript = TranscriptK8::find($transcript_id);
        $transcript->grade = $request->get('student_grade');

        if ($request->get('school_name')) {
            $transcript->school_name = $request->get('school_name');
        } elseif ($request->get('other_school')) {
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

    public function genrateTranscript($id)
    {

        $Userid = Auth::user()->id;
        $parentProfileData = User::find($Userid)->parentProfile()->first();

        $studentProfileData = StudentProfile::whereId($id)->first();

        $pdfname = $studentProfileData->first_name . '_' . $studentProfileData->last_name . '_' . $studentProfileData->d_o_b->format('M_d_Y') . '_' . 'unsigned_transcript_letter';

        $enrollment_periods = StudentProfile::find($studentProfileData->id)->enrollmentPeriods()->get();

        $id = $parentProfileData->id;
        $data = [
            'student' => $studentProfileData,
            'enrollment' => $enrollment_periods,
            'title' => 'transcript',
            'date' => date('m/d/Y'),
        ];

        $pdf = PDF::loadView('transcript.pdf', $data);

        Storage::disk('local')->put('public/pdf/' . $pdfname . '.pdf', $pdf->output());

        //store pdf link
        $storetranscript = TranscriptPdf::create([
            'student_profile_id' => $studentProfileData->id,
            'pdf_link' => $pdfname . '.pdf',
            'k8transcript_id' => '1',
            'status' => 'pending',
        ]);
        return $pdf->download($pdfname . '.pdf');
    }
    public function viewAnotherEnrollment($student_id)
    {
        return view('transcript.grade');
    }
    public function displayAllCourse($transcript_id, $student_id)
    {
        $courses = TranscriptCourse::where('k8transcript_id', $transcript_id)
            ->join('k8transcript', 'k8transcript.id', 'transcript_course.k8transcript_id')
            ->join('courses', 'courses.id', 'transcript_course.courses_id')
            ->join('subjects', 'subjects.id', 'transcript_course.subject_id')
            ->get();
        $studentInfo = StudentProfile::find($student_id);
        $school = TranscriptK8::find($transcript_id);
        return view('transcript-wizard-grade', compact('courses', 'transcript_id', 'student_id', 'studentInfo', 'school'));
    }
    public function deleteSchool($transcript_id)
    {
        $transcriptDetails = TranscriptK8::find($transcript_id)->delete();
        return redirect()->back();
    }

    public function previewTranscript($student_id)
        {      
            $parentId=ParentProfile::getParentId();
            $address=ParentProfile::where('id',$parentId)->get();
            $student = StudentProfile::find($student_id);
            $grades  =TranscriptK8::distinct()->where('student_profile_id',$student_id)->get(['grade']);
            $transcriptData = TranscriptK8::select()->where('student_profile_id', $student_id)
            ->with(['TranscriptDetails', 'TranscriptCourse.subject', 'TranscriptCourse.course'])
            ->get();
            $transcript_id=Transcript::select()->where('student_profile_id', $student_id)->where('status',"pending")->first();
            $groupCourses = TranscriptCourse::with(['subject'])->where('student_profile_id', $student_id)->get()->unique('subject_id');
            return view('transcript/preview-transcript',compact('student','transcriptData','grades', 'groupCourses','transcript_id'));
        }

        public function purchase(Request $request, $id,$transcript_id)
        {
            // $transcriptData->save();
            $student = StudentProfile::whereId($id)->with(['TranscriptK8', 'transcriptCourses','parentProfile'])->first();
            $transcript_fee = FeesInfo::getFeeAmount('transcript');
            return view('transcript.purchase-transcript',compact('student', 'transcript_fee','transcript_id'));
        }
}
