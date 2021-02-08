<?php

namespace App\Http\Controllers;

use App\Models\Transcript;
use App\Models\StudentProfile;
use App\Models\EnrollmentPeriods;
use App\Models\ParentProfile;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

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
        return view('transcript.view-students', compact('enroll_students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewEnrollment($id)
    {

        $enrollment_periods = StudentProfile::find($id)->enrollmentPeriods()->get();
        $items = array();
        foreach ($enrollment_periods as $key => $enrollment_period) {

            $items[] = \Carbon\Carbon::parse($enrollment_period->start_date_of_enrollment)->format('Y');
        }
        $result = array_unique($items);
        return view('frontendpages.dashboard-transcript-filling2', compact('result'));
    }

    public function create(Request $request)
    {
        if ($request->get('student_grade')) {
            echo $request->get('student_grade');
        } elseif ($request->get('other_year')) {
            echo $request->get('other_year');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
}
