<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\TranscriptCourse;

class ScienceController extends Controller
{
    public function index($id)
    {
        $student_id = $id;
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'Science')
            ->first();
        $course_id = $course->id;
        $science_course = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->get();
        return view('cources.science', compact('science_course', 'student_id', 'course_id'));
    }
    public function store(Request $request)
    {
        $id = $request->get('courses_id');
        $refreshCourse = TranscriptCourse::select()->where('courses_id', $id)->get();
        $refreshCourse->each->delete();
        foreach ($request->get('sciencecourse', []) as $period) {
            $subject = $period['subject'];
            $subject = Subject::where('subject_name', $subject)->first();

            $english_course = TranscriptCourse::create([
                'student_profile_id' => $period['student_id'],
                'courses_id' => $period['courses_id'],
                'subject_id' => $subject->id,
                'score' => $period['grade']
            ]);
        }
    }
}
