<?php

namespace App\Http\Controllers\TranscriptController;

use App\Http\Controllers\Controller;
use App\Models\AdvancePlacement;
use App\Models\Credits;
use App\Models\StudentProfile;
use App\Models\Transcript9_12;
use DB;
use Illuminate\Http\Request;

class Transcript9to12 extends Controller
{
    public function selectCountry($student_id, $transcript_id)
    {
        try {
            DB::beginTransaction();
            $transcript = Transcript9_12::create([
                'student_profile_id' => $student_id,
                'transcript_id' => $transcript_id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Failed to insert Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        return view('transcript9to12.Is_California', compact('student_id', 'transcript'));
    }
    public function selectGrade(Request $request, $student_id)
    {
        // dd($request->all());
        $transcript = Transcript9_12::find($request->input('transcript_id'));
        // dd($transcript);
        if ($request->is_united_states == 'Yes' && $request->is_california == 'Yes') {
            // is carnegia means all country expect california
            // 0 - not carnegia 

            try {
                DB::beginTransaction();
                $transcript->is_carnegie = 0;
                $transcript->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $notification = [
                    'message' => 'Failed to insert Record!',
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }
            return view('transcript9to12.grade', compact('student_id', 'transcript'));
        } else {

            dd('add other country in table and set is_carnegie as 1');
        }
    }
    public function enrollSchool(Request $request, $student_id)
    {
        try {
            DB::beginTransaction();
            $transcript_id = $request->get('transcript_id');
            $transcript = Transcript9_12::find($transcript_id);
            $transcript->grade = $request->get('student_grade');

            if ($request->get('school_name') == 'West River Academy') {
                $transcript->school_name = $request->get('school_name');
            } elseif ($request->get('school_name') == 'Others') {
                $transcript->school_name = $request->get('other_school');
            }
            $transcript->save();

            $enrollment_periods = StudentProfile::find($student_id)->enrollmentPeriods()->get();
            $items = [];
            foreach ($enrollment_periods as $key => $enrollment_period) {
                $items[] = \Carbon\Carbon::parse($enrollment_period->start_date_of_enrollment)->format('Y');
            }
            $result = array_unique($items);
            DB::commit();

            return view('transcript9to12.year-grade', compact('transcript', 'result', 'student_id'));
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
    public function enrollYear(Request $request, $student_id)
    {
        try {
            DB::beginTransaction();
            $transcript_id = $request->get('transcript_id');
            $transcript = Transcript9_12::find($transcript_id);
            if ($request->get('enrollment_year')) {
                $transcript->enrollment_year = $request->get('enrollment_year');
            } elseif ($request->get('other_year')) {
                $transcript->enrollment_year = $request->get('other_year');
            }
            $transcript->save();
            DB::commit();
            $is_carnegie = Transcript9_12::where('id', $transcript_id)->select('is_carnegie')->first();
            // if output is 0 then they belongs to california 
            $all_credits = Credits::whereIn('is_carnegia', $is_carnegie)->select('credit')->get();
            return view('transcript9to12.Ap-courses', compact('student_id', 'transcript_id', 'all_credits'));
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
    public function storeApCourses(Request $request)
    {
        $student_id = $request->get('student_id');
        $courses = $request->get('apCourses');
        foreach ($courses as $course) {
            AdvancePlacement::create([
                'student_profile_id' => $student_id,
                'ap_course_name' => $course['course_name'],
                'ap_course_grade' => $course['grade'],
                'ap_course_credits' => $course['credit'],
            ]);
        }
    }
    public function anotherGrade($student_id, $transcript_id)
    {
        return view('transcript9to12.another-grade-level', compact('student_id', 'transcript_id'));
    }
    public function getAnotherGradeStatus(Request $request)
    {
        $id = $request->get('student_id');
        $enroll_student = StudentProfile::find($id);
        $transcriptPayment = DB::table('transcripts')->where('student_profile_id', $id)
            ->join('transcript_payments', 'transcript_payments.transcript_id', 'transcripts.id')
            ->where('transcript_payments.status', 'paid')->where('transcripts.period', '9-12')
            ->first();
        dd($transcriptPayment);
        // dd($request->all());
        if ($request->get('another_grade') == 'Yes') {
            $id = $request->get('student_id');
            $enroll_student = StudentProfile::find($id);

            return view('transcript9to12.ready-for-start', compact('id', 'enroll_student', 'transcript_id'));
        } else {
            return view('transcript-wizard-dashboard', compact('student', 'transcriptDatas'));
        }
    }
}
