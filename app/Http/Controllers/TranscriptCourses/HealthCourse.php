<?php

namespace App\Http\Controllers\TranscriptCourses;

use App\Enums\CourseType;
use App\Enums\CreditType;
use App\Enums\MaximumCreditType;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Transcript9_12;
use DB;
use App\Models\TranscriptCourse9_12;
use App\Models\Credits;
use Illuminate\Http\Request;

class HealthCourse extends Controller
{
    public function index($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', CourseType::HealthCourse)
            ->first();
        $courses_id = $course->id;
        $healthEducation = Subject::where('courses_id', $course->id)
            ->where('transcript_period', '9-12')
            ->where('status', 0)
            ->get();
        $carnegie_status = Transcript9_12::where('id', $transcript_id)->select('is_carnegie')->first();
        $all_credits = Credits::whereIn('is_carnegia', $carnegie_status)->select('credit')->get()->toArray();

        // delete if course already exists
        $refreshCourse = TranscriptCourse9_12::select()->where('courses_id', $courses_id)->where('transcript9_12_id', $transcript_id)->get();
        $refreshCourse->each->delete();

        $transcript_credit = TranscriptCourse9_12::where('transcript9_12_id', $transcript_id)->orderBy('id', 'DESC')->first();
        if (is_null($transcript_credit)) {
            // first course having full credit , so check its country and assign full credit
            $remaining_credit = $carnegie_status->is_carnegie == 1 ? CreditType::NotCaliforniaTotalCredit : CreditType::CaliforniaTotalCredit;
        } else {
            $remaining_credit = $transcript_credit->remaining_credits;
        }
        $selectedCreditRequired = $carnegie_status->is_carnegie == 1 ? MaximumCreditType::MaxCreditForSubjectsNotInCalifornia : MaximumCreditType::MaxCreditForSubjectsInCalifornia;
        $total_credits = Credits::whereIn('is_carnegia', $carnegie_status)->select('total_credit')->first();
        $transData = Transcript9_12::where('id', $transcript_id)->first();
        $trans_id =  $transData->transcript_id;
        return view('transcript9to12_courses.healthCourse', compact('courses_id', 'healthEducation', 'student_id', 'transcript_id', 'all_credits', 'total_credits', 'selectedCreditRequired', 'remaining_credit', 'trans_id'));
    }
    public function store(Request $request)
    {
        // delete if course already exists
        $id = $request->get('course_id');
        $refreshCourse = TranscriptCourse9_12::select()->where('courses_id', $request->get('course_id'))->where('transcript9_12_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();

        //create new course
        foreach ($request->get('healthCourse', []) as $period) {
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
                    'selectedCredit' => $period['selectedCredit'],
                    'credit_id' => $credit->id,
                    'other_subject' => $other_sub->subject_name,
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
                    'selectedCredit' => $period['selectedCredit'],
                    'credit_id' => $credit->id,
                    'remaining_credits' =>   $request->final_remaining_credit,
                    'transcript9_12_id' => $period['transcript_id'],
                ]);
            }
        }
    }
}
