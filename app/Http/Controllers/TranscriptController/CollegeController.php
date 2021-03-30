<?php

namespace App\Http\Controllers\TranscriptController;

use App\Http\Controllers\Controller;
use App\Models\CollegeCourse;
use App\Models\Transcript9_12;
use App\Models\Credits;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function addCollege(Request $request, $student_id)
    {
        $transcript_id =  $request->trans_id;
        $transcript9_12id = $request->transcript9_12id;
        $carnegia_status = Transcript9_12::whereId($transcript9_12id)->select('is_carnegie')->first();
        $credits = Credits::whereIn('is_carnegia', $carnegia_status)->select('credit')->get();
        if ($request->is_apCourse == 'Yes') {
            return view('transcript9to12.college-info', compact('transcript_id', 'student_id', 'transcript9_12id', 'credits'));
        } else {
            return redirect()->route('display.grades', $student_id);
        }
    }
    public function store(Request $request)
    {
        foreach ($request->get('collegeCourse', [])  as $course) {
            CollegeCourse::create([
                'student_profile_id' => $request->get('student_id'),
                'name' => $course['name'],
                'course_name' => $course['course_name'],
                "grade" => $course['grade'],
                "is_college_level" => $course['is_college_level'],
                "course_grade" => $course['course_grade'],
                "selectedCredit" => $course['selectedCredit']
            ]);
        }
    }
}
