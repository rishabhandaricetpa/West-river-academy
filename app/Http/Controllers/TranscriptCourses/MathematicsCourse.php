<?php

namespace App\Http\Controllers\TranscriptCourses;

use App\Enums\CourseType;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Transcript9_12;
use DB;
use App\Models\TranscriptCourse9_12;
use App\Models\Credits;
use Illuminate\Http\Request;

class MathematicsCourse extends Controller
{
    public function index($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', CourseType::MathsCourse)
            ->first();
        $courses_id = $course->id;
        $mathscourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', '9-12')
            ->where('status', 0)
            ->get();
        $carnegie_status = Transcript9_12::where('id', $transcript_id)->select('is_carnegie')->first();
        $transcript_credit = TranscriptCourse9_12::where('transcript9_12_id', $transcript_id)->orderBy('id', 'DESC')->first();

        if (is_null($transcript_credit)) {
            // first course having full credit , so check its country and assign full credit
            $remaining_credit = $carnegie_status->is_carnegie == 1 ? CourseType::NotCaliforniaTotalCredit : CourseType::CaliforniaTotalCredit;
        } else {
            $remaining_credit = $transcript_credit->remaining_credits;
        }
      
        $all_credits = Credits::whereIn('is_carnegia', $carnegie_status)->select('credit')->get()->toArray();
        $selectedCreditRequired = max($all_credits);
        $total_credits = Credits::whereIn('is_carnegia', $carnegie_status)->select('total_credit')->first();
        return view('transcript9to12_courses.mathsCourse', compact('courses_id', 'mathscourse', 'student_id', 'transcript_id', 'all_credits', 'total_credits', 'selectedCreditRequired', 'remaining_credit'));
    }
    public function store(Request $request)
    {
        // delete if course already exists
        $refreshCourse = TranscriptCourse9_12::select()->where('courses_id', $request->get('course_id'))->where('transcript9_12_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();

        //create new course
        foreach ($request->get('mathscourse', []) as $period) {
            $selectedCredit =  $period['selectedCredit'];
            $credit = Credits::where('credit', $selectedCredit)->first();
            $other_subjects = $period['other_subject'];
            if ($other_subjects) {
                $other_sub = Subject::create([
                    'courses_id' => $period['course_id'],
                    'subject_name' => $other_subjects,
                    'transcript_period' => '9-12',
                    'status' => 1,
                ]);
                TranscriptCourse9_12::create([
                    'student_profile_id' => $period['student_id'],
                    'courses_id' => $period['course_id'],
                    'subject_id' => $other_sub->id,
                    'score' => isset($period['grade']) ? $period['grade'] : 'In Progress',
                    'remaining_credits' =>   $request->final_remaining_credit,
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
                    'other_subject' => $other_sub->subject_name,
                    'transcript9_12_id' => $period['transcript_id'],
                ]);
            } else {
                $subject_name = $period['subject_name'];
                $selectedCredit =  $period['selectedCredit'];
                $credit = Credits::where('credit', $selectedCredit)->first();
                $subject = Subject::where('subject_name', $subject_name)->first();
                TranscriptCourse9_12::create([
                    'student_profile_id' => $period['student_id'],
                    'courses_id' => $period['course_id'],
                    'subject_id' => $subject->id,
                    'score' => isset($period['grade']) ? $period['grade'] : 'In Progress',
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
                    'remaining_credits' =>$request->final_remaining_credit,
                    'transcript9_12_id' => $period['transcript_id'],
                ]);
            }
        }
    }
}
