<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\Course;
use App\Models\StudentProfile;
use App\Models\Subject;
use App\Models\TranscriptCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TranscriptController extends Controller
{
    public function index()
    {
        $students = StudentProfile::all();

        return view('admin.transcript.view-student', compact('students'));

    }


    public function edit($id)
    {
        $student = StudentProfile::find($id)->first();
        $transcriptCourses = StudentProfile::find($id)->transcriptCourses()->get();
        $transcriptData = TranscriptCourse::where('student_profile_id', $id)
                            ->join('courses','courses.id','transcript_course.courses_id')
                            ->join('subjects','subjects.id','transcript_course.subject_id')
                            ->join('k8transcript','k8transcript.id','transcript_course.k8transcript_id')
                            ->select(
                                'transcript_course.score',
                                'subjects.subject_name',
                                'subjects.transcript_period',
                                'courses.course_name',
                         )
        ->get();
        return view('admin.transcript.view-transcript', compact('transcriptData','student'));
    }
   
}
