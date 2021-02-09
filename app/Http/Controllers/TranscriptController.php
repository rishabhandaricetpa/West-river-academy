<?php

namespace App\Http\Controllers;

use App\Models\Transcript;
use App\Models\StudentProfile;
use App\Models\EnrollmentPeriods;
use App\Models\Cart;
use App\Models\ParentProfile;
use App\Models\Country;
use App\Models\EnrollmentPayment;
use App\Models\TranscriptK8;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $transcript =  TranscriptK8::updateOrCreate(
            ['student_profile_id' => $id],
            [
                'student_profile_id' => $id,
                'country' => $request->input('country'),
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
    public function storeEnrollmentYear(Request $request)
    {
    }
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
            dd('can not purchase transcript since no enrollment period is paid');
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
    public function storeYear(Request $request, $id)
    {
        $transcript_id = $request->get('transcript_id');
        $transcript = TranscriptK8::find($transcript_id);
        if ($request->get('enrollment_year')) {
            $transcript->enrollment_year = $request->get('enrollment_year');
        } elseif ($request->get('other_year')) {
            $transcript->enrollment_year = $request->get('other_year');
        }
        $transcript->save();
    }
}
