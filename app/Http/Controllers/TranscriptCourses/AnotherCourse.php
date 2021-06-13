<?php

namespace App\Http\Controllers\TranscriptCourses;

use App\Enums\CourseType;
use App\Enums\CreditType;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Transcript9_12;
use DB;
use App\Models\TranscriptCourse9_12;
use App\Models\Credits;
use Illuminate\Http\Request;
use Transcript912;

class AnotherCourse extends Controller
{
    public function index($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', CourseType::AnotherCourse)
            ->first();
        $courses_id = $course->id;
        $anotherSubjects = Subject::where('courses_id', $course->id)
            ->where('transcript_period', '9-12')
            ->where('status', 0)
            ->get();
        $carnegie_status = Transcript9_12::where('id', $transcript_id)->select('is_carnegie')->first();
        // delete if course already exists
        $refreshCourse = TranscriptCourse9_12::select()->where('courses_id', $courses_id)->where('transcript9_12_id', $transcript_id)->get();
        $refreshCourse->each->delete();
        
        $all_credits = Credits::whereIn('is_carnegia', $carnegie_status)->select('credit')->get()->toArray();
        $transcript_credit = TranscriptCourse9_12::where('transcript9_12_id', $transcript_id)->orderBy('id', 'DESC')->first();
        if (is_null($transcript_credit)) {
            // first course having full credit , so check its country and assign full credit
            $remaining_credit = $carnegie_status->is_carnegie == 1 ? CreditType::NotCaliforniaTotalCredit : CreditType::CaliforniaTotalCredit;
        } else {
            $remaining_credit = $transcript_credit->remaining_credits;
        }
        sort($all_credits);
        array_pop($all_credits);
        $selectedCreditRequired = max($all_credits);
        $total_credits = Credits::whereIn('is_carnegia', $carnegie_status)->select('total_credit')->first();
        /**
         *  transcript table id required if student select yes for another grade creation
         */

        $transData = Transcript9_12::where('id', $transcript_id)->first();
        $trans_id =  $transData->transcript_id;
        return view('transcript9to12_courses.anotherCourse', compact('courses_id', 'anotherSubjects', 'student_id', 'transcript_id', 'all_credits', 'total_credits', 'trans_id', 'selectedCreditRequired', 'remaining_credit'));
    }
    public function store(Request $request)
    {
        /**
         * delete if course already exists 
         * @param  \Illuminate\Http\Request  $request
         */
        $id = $request->get('course_id');
        $refreshCourse = TranscriptCourse9_12::select()->where('courses_id', $request->get('course_id'))->where('transcript9_12_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();

        /**
         * create new course
         */

        foreach ($request->get('anotherCourse', []) as $period) {
            $other_subjects = $period['other_subject'];
            $selectedCredit =  $period['selectedCredit'];
            $total_credits = $period['total_credits'];
            $credit = Credits::where('credit', $selectedCredit)->first();
            if ($other_subjects) {
                $other_sub = Subject::create([
                    'courses_id' => $period['course_id'],
                    'subject_name' => $other_subjects,
                    'transcript_period' => '9-12',
                    'status' => 1,
                ]);
                TranscriptCourse9_12::create([
                    'student_profile_id' => $period['student_id'],
                    'courses_id' => $period['course_id'],
                    'subject_id' => $other_sub->id,
                    'score' =>  isset($period['grade']) ? $period['grade'] : 'In Progress',
                    'remaining_credits' => $request->final_remaining_credit,
                    'credit_id' => $credit->id,
                    'other_subject' => $other_sub->subject_name,
                    'selectedCredit' => $period['selectedCredit'],
                    'transcript9_12_id' => $period['transcript_id'],
                ]);
            } else {
                $subject_name = $period['subject_name'];
                $selectedCredit =  $period['selectedCredit'];
                $credit = Credits::where('credit', $selectedCredit)->first();
                $subject = Subject::where('subject_name', $subject_name)->first();
                TranscriptCourse9_12::create([
                    'student_profile_id' => $period['student_id'],
                    'courses_id' => $period['course_id'],
                    'subject_id' => $subject->id,
                    'score' =>  isset($period['grade']) ? $period['grade'] : 'In Progress',
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
                    'remaining_credits' => $request->final_remaining_credit,
                    'transcript9_12_id' => $period['transcript_id'],
                ]);
            }
        }
    }
}
