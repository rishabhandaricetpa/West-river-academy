<?php

namespace App\Http\Controllers\TranscriptCourses;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Transcript9_12;
use App\Models\Credits;
use App\Models\TranscriptCourse9_12;
use DB;
use Illuminate\Http\Request;

class EnglishCourse extends Controller
{
    public function index($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'English / Language Arts')
            ->first();
        $courses_id = $course->id;
        $englishCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', '9-12')
            ->where('status', 0)
            ->get();
        $is_carnegie = Transcript9_12::where('id', $transcript_id)->select('is_carnegie')->first();

        $all_credits = Credits::whereIn('is_carnegia', $is_carnegie)->select('credit')->get();
        $total_credits = Credits::whereIn('is_carnegia', $is_carnegie)->select('total_credit')->first();
        return view('transcript9to12_courses.englishCourse', compact('courses_id', 'englishCourse', 'student_id', 'transcript_id', 'all_credits', 'total_credits'));
    }
    public function store(Request $request)
    {
        // delete if course already exists
        $id = $request->get('course_id');
        $refreshCourse = TranscriptCourse9_12::select()->where('courses_id', $request->get('course_id'))->where('transcript9_12_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();

        //create new course
        foreach ($request->get('englishCourse', []) as $period) {
            $other_subjects = $period['other_subject'];
            $selectedCredit =  $period['selectedCredit'];
            $total_credits = $period['total_credits'];
            $credit = Credits::where('credit', $selectedCredit)->first();
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
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
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
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
                    'transcript9_12_id' => $period['transcript_id'],
                ]);
            }
        }
    }
}
