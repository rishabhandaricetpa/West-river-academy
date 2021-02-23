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
            $student = StudentProfile::find($id);
            return view('transcript.dashboard-transcript', compact('student'));
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
    public function displayStudent($id)
    {
        $studentProfile = StudentProfile::find($id);
        $countries = Country::all();
        return view('transcript.dashboard-transcript-filling', compact('studentProfile', 'countries'));
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
        //  dd($request->all());
        $transcript_id = $request->get('transcript_id');
        $transcript = TranscriptK8::find($transcript_id);
        if ($request->get('enrollment_year')) {
            $transcript->enrollment_year = $request->get('enrollment_year');
        } elseif ($request->get('other_year')) {
            $transcript->enrollment_year = $request->get('other_year');
        }
        $transcript->save();
        // $course = Course::select('id', DB::raw('count(*) as total'))
        //     ->groupBy('id')
        //     ->where('course_name', 'English / Language Arts')
        //     ->first();
        // $courses_id = $course->id;
        // $englishCourse = Subject::where('courses_id', $course->id)
        //     ->where('transcript_period', 'K-8')
        //     ->get();
        return redirect()->route('english.course', [$student_id, $transcript_id]);

        //return view('courses.english-course', compact('englishCourse', 'student_id', 'transcript_id', 'courses_id'));
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

        // $courses = TranscriptCourse::where('k8transcript_id', $transcript_id)->get();
        $courses = TranscriptCourse::where('k8transcript_id', $transcript_id)
            ->join('k8transcript', 'k8transcript.id', 'transcript_course.k8transcript_id')
            ->join('courses', 'courses.id', 'transcript_course.courses_id')
            ->join('subjects', 'subjects.id', 'transcript_course.subject_id')
            ->get();
        //dd($courses);
        return view('transcript-wizard-grade', compact('courses', 'transcript_id', 'student_id'));
    }
}
