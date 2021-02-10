<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use App\Models\TranscriptCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnglishLanguageController extends Controller
{
    public function index(Request $request)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'English / Language Arts')
            ->first();
        $englishCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->get();
        return view('cources.english-cources', compact('englishCourse'));
    }
    public function store(Request $request)
    {
        // dd($request->all());

        foreach ($request->get('englishCourse', []) as $period) {

            $english_course = TranscriptCourse::create([
                'student_profile_id' => $period['student_id'],
                'courses_id' => $period['courses_id'],
                'subject_id' => $period['transcript_id'],
                'score' => $period['grade']
            ]);
            $english_course->save();
        }
    }
}
