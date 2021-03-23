<?php

namespace App\Http\Controllers\TranscriptCourses;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Transcript9_12;
use DB;
use App\Models\TranscriptCourse9_12;
use App\Models\Credits;
use Illuminate\Http\Request;

class PhysicalEducationCourse extends Controller
{
    public function index($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'Physical Education')
            ->first();
        $courses_id = $course->id;
        $scienceCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', '9-12')
            ->where('status', 0)
            ->get();
        $is_carnegie = Transcript9_12::where('id', $transcript_id)->select('is_carnegie')->first();
        $all_credits = Credits::whereIn('is_carnegia', $is_carnegie)->select('credit')->get();
        $total_credits = Credits::where('is_carnegia', $is_carnegie)->select('total_credit')->first();
        return view('transcript9to12_courses.physicaleducationCourse', compact('courses_id', 'scienceCourse', 'student_id', 'transcript_id', 'all_credits', 'total_credits'));
    }
}
