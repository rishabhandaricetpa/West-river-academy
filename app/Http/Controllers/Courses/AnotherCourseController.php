<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\TranscriptCourse;
use App\Models\StudentProfile;
use App\Models\TranscriptK8;
use Illuminate\Support\Facades\DB;

class AnotherCourseController extends Controller
{
    public function index($id, $transcript_id)
    {
        $student_id = $id;
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'Another')
            ->first();
        $courses_id = $course->id;
        $anotherCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->get();
        return view('courses.another-course', compact('anotherCourse', 'student_id', 'courses_id', 'transcript_id'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $refreshCourse =  TranscriptCourse::select()->where('courses_id',  $request->get('courses_id'))->where('k8transcript_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();
        foreach ($request->get('anotherCourse', []) as $period) {
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
        DB::commit();
    }
    public function anotherGrade($id)
    {
        return view('courses.dashboard-another-languages', compact('id'));
    }
    public function storeAnotherGrade(Request $request, $student_id)
    {
        $student_transcripts = TranscriptCourse::where('student_profile_id', $student_id)->select('k8transcript_id')->groupBy('k8transcript_id')->get();
        // $alldata = TranscriptCourse::where('student_profile_id', $student_id)->select('subject_id')->get();
        // $c = collect($alldata)->pluck('subject_id');
        // $coursesmname = Subject::whereIn('id', $c)->get();
        //   dd($coursesmname);

        $transcriptCourses = StudentProfile::find($student_id)->transcriptCourses()->get();
        $k8details = StudentProfile::find($student_id)->TranscriptK8()->get();
        // dd($k8details);
        $transcriptDatas = array();
        foreach ($k8details as $k8detail) {
            $transcriptDatas[]  = TranscriptCourse::select(
                'transcript_course.score',
                'subjects.subject_name',
                'subjects.transcript_period',
                'courses.course_name',
                'k8transcript.school_name',
                'k8transcript.grade',
                'k8transcript.id',
                'transcript_course.courses_id',
                'transcript_course.subject_id',
                'transcript_course.k8transcript_id'
            )->where('k8transcript.school_name', $k8detail->school_name)
                ->join('courses', 'courses.id', 'transcript_course.courses_id')
                ->join('subjects', 'subjects.id', 'transcript_course.subject_id')
                ->join('k8transcript', 'k8transcript.id', 'transcript_course.k8transcript_id')
                ->get();
        }
        // $finalArray = [];
        // for ($i = 0; $i < count($transcriptDatas); $i++) {
        //     foreach ($transcriptDatas[$i] as $trans) {
        //         $finalArray[] = $trans;
        //     }
        // }

        // foreach ($finalArray as $arr) {
        //     $schoolKeys[] = $arr['k8transcript_id'];
        // }

        // for ($i = 0; $i < count($schoolKeys); $i++) {
        //     if ($schoolKeys[$i] == $finalArray[$i]['k8transcript_id']) {
        //         $array[$schoolKeys[$i]][] = $finalArray[$i];
        //     }
        // }

        $student = StudentProfile::find($student_id);
        if ($request->get('another_grade') == 'Yes') {
            return redirect()->route('display.studentProfile', $request->get('student_id'));
        } else {
            return view('transcript-wizard-dashboard', compact('student', 'transcriptDatas'));
        }
    }
}
    // $t = TranscriptK8::find(10)->transcripts()->get();
        // dd($t);
        // $item = array();
        // foreach ($student_transcripts as $key => $student_transcript) {
        //     $item[] = TranscriptK8::find($student_transcript);
        // }
        // dd($item);