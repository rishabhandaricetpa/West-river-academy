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

    public function store(Request $request)
    {
        $id = $request->get('course_id');
        //first delete the course if exists in database
        $refreshCourses = TranscriptCourse::select()->where('courses_id', $id)->get();
        $refreshCourses->each->delete();

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
