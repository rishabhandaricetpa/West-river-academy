<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\TranscriptCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocialStudiesController extends Controller
{
    public function index($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'History / Social Science')
            ->first();
        $courses_id = $course->id;
        $socialStudiesCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->where('status', 0)
            ->get();

        return view('courses.social-studies', compact('socialStudiesCourse', 'student_id', 'courses_id', 'transcript_id'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $refreshCourse = TranscriptCourse::select()->where('courses_id', $request->get('courses_id'))->where('k8transcript_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();
        foreach ($request->get('socialStudiesCourse', []) as $period) {
            $other_subjects = $period['other_subjects'];
            if ($other_subjects) {
                $other_sub = Subject::create([
                    'courses_id' => $period['courses_id'],
                    'subject_name' => $other_subjects,
                    'transcript_period' => 'K-8',
                    'status' => 1,
                ]);
                TranscriptCourse::create([
                    'student_profile_id' => $period['student_id'],
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $other_sub->id,
                    'score' => $period['grade'],
                    'other_subject' => $other_sub->subject_name,
                    'k8transcript_id' => $period['transcript_id'],
                ]);
            } else {
                $subject = $period['subject'];
                $subject = Subject::where('subject_name', $subject)->first();

                TranscriptCourse::create([
                    'student_profile_id' => $period['student_id'],
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $subject->id,
                    'score' => $period['grade'],
                    'k8transcript_id' => $period['transcript_id'],
                ]);
            }
        }
        DB::commit();
    }
}
