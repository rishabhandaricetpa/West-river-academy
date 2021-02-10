<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;
use DB;

class EnglishLanguageController extends Controller
{
    public function index(Request $request)
    {
        $course=Course::select('id',DB::raw('count(*) as total'))                 
                            ->groupBy('id')
                            ->where('course_name','English / Language Arts')
                            ->first();
        $englishCourse=Subject::where('courses_id',$course->id)
                        ->where('transcript_period', 'K-8')
                        ->get();   
        return view('transcript.english-languages',compact('englishCourse'));
    }
}
