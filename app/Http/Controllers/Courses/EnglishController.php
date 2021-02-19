<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\TranscriptCourse;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class EnglishController extends Controller
{
    public function index($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'English / Language Arts')
            ->first();
        $courses_id = $course->id;
        $englishCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->get();
        return view('courses.english-course', compact('englishCourse', 'student_id', 'transcript_id', 'courses_id'));
    }

    public function store(Request $request)
    {
        $id = $request->get('courses_id');
        //first delete the course if exists in database

        $refreshCourse =  TranscriptCourse::select()->where('courses_id',  $request->get('courses_id'))->where('k8transcript_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();

        // then insert new subjects
        foreach ($request->get('englishCourse', []) as $period) {
            $subject = $period['subject'];
            $subject = Subject::where('subject_name', $subject)->first();

            $english_course = TranscriptCourse::create([
                'student_profile_id' => $period['student_id'],
                'courses_id' => $period['courses_id'],
                'subject_id' => $subject->id,
                'score' => $period['grade'],
                'k8transcript_id' => $period['transcript_id'],
            ]);
        }
    }
}
