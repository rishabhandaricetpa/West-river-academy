<?php

namespace App\Http\Controllers\EditTranscript9_12Courses;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\TranscriptCourse9_12;
use App\Models\TranscriptCourse;
use App\Models\Credits;
use App\Models\Transcript9_12;
use Illuminate\Http\Request;

class EditCourse extends Controller
{
    public function editEnglish($student_id, $transcript9_12id)
    {
        $course = Course::select('id',)
            ->where('course_name', 'English / Language Arts')
            ->first();
        $englishCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', '9-12')
            ->where('status', 0)
            ->get();
        $courses_id = $course->id;
        $carnegia_status = Transcript9_12::whereId($transcript9_12id)->select('is_carnegie')->first();
        $credits = Credits::whereIn('is_carnegia', $carnegia_status)->select('credit')->get();
        $outOfCredit = Credits::where('is_carnegia', $carnegia_status)->select('total_credit')->first();
        $transcripts = TranscriptCourse9_12::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('transcript9_12_id', $transcript9_12id)->get();
        return view('editTranscript9_12Courses.english-course', compact('englishCourse', 'credits', 'transcripts', 'student_id', 'transcript9_12id', 'courses_id', 'outOfCredit'));
    }
    public function storeEnglish(Request $request)
    {
        // delete if course already exists
        $id = $request->get('course_id');
        $refreshCourse = TranscriptCourse9_12::select()->where('courses_id', $request->get('course_id'))->where('transcript9_12_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();

        //create new course
        foreach ($request->get('englishCourse', []) as $period) {
            $other_subjects = $period['other_subject'];
            $selectedCredit =  $period['selectedCredit'];
            $total_credits = $period['total_credits'];
            $credit = Credits::where('credit', $selectedCredit)->first();
            if ($other_subjects) {
                $other_sub = Subject::create([
                    'courses_id' => $period['courses_id'],
                    'subject_name' => $other_subjects,
                    'transcript_period' => '9-12',
                    'status' => 1,
                ]);
                TranscriptCourse9_12::create([
                    'student_profile_id' => $period['student_id'],
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $other_sub->id,
                    'score' => $period['grade'],
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
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
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $subject->id,
                    'score' => $period['grade'],
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
                    'transcript9_12_id' => $period['transcript_id'],
                ]);
            }
        }
    }
    public function editMathematics($student_id, $transcript9_12id)
    {
        $course = Course::select('id',)
            ->where('course_name', 'Mathematics')
            ->first();
        $mathsCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', '9-12')
            ->where('status', 0)
            ->get();
        $courses_id = $course->id;
        $carnegia_status = Transcript9_12::whereId($transcript9_12id)->select('is_carnegie')->first();
        $credits = Credits::whereIn('is_carnegia', $carnegia_status)->select('credit')->get();
        $outOfCredit = Credits::where('is_carnegia', $carnegia_status)->select('total_credit')->first();
        $transcripts = TranscriptCourse9_12::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('transcript9_12_id', $transcript9_12id)->get();
        return view('editTranscript9_12Courses.mathematics-course', compact('mathsCourse', 'credits', 'transcripts', 'student_id', 'transcript9_12id', 'courses_id', 'outOfCredit'));
    }
    public function storeMathematics(Request $request)
    {
        // delete if course already exists
        $id = $request->get('course_id');
        $refreshCourse = TranscriptCourse9_12::select()->where('courses_id', $request->get('course_id'))->where('transcript9_12_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();

        //create new course
        foreach ($request->get('mathsCourse', []) as $period) {
            $other_subjects = $period['other_subject'];
            $selectedCredit =  $period['selectedCredit'];
            $total_credits = $period['total_credits'];
            $credit = Credits::where('credit', $selectedCredit)->first();
            if ($other_subjects) {
                $other_sub = Subject::create([
                    'courses_id' => $period['courses_id'],
                    'subject_name' => $other_subjects,
                    'transcript_period' => '9-12',
                    'status' => 1,
                ]);
                TranscriptCourse9_12::create([
                    'student_profile_id' => $period['student_id'],
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $other_sub->id,
                    'score' => $period['grade'],
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
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
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $subject->id,
                    'score' => $period['grade'],
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
                    'transcript9_12_id' => $period['transcript_id'],
                ]);
            }
        }
    }

    //health course edit

    public function editHealth($student_id, $transcript9_12id)
    {
        $course = Course::select('id',)
            ->where('course_name', 'Health')
            ->first();
        $healthCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', '9-12')
            ->where('status', 0)
            ->get();
        $courses_id = $course->id;
        $carnegia_status = Transcript9_12::whereId($transcript9_12id)->select('is_carnegie')->first();
        $credits = Credits::whereIn('is_carnegia', $carnegia_status)->select('credit')->get();
        $outOfCredit = Credits::where('is_carnegia', $carnegia_status)->select('total_credit')->first();
        $transcripts = TranscriptCourse9_12::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('transcript9_12_id', $transcript9_12id)->get();
        return view('editTranscript9_12Courses.health-course', compact('healthCourse', 'credits', 'transcripts', 'student_id', 'transcript9_12id', 'courses_id', 'outOfCredit'));
    }
    public function storeHealth(Request $request)
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
                    'courses_id' => $period['courses_id'],
                    'subject_name' => $other_subjects,
                    'transcript_period' => '9-12',
                    'status' => 1,
                ]);
                TranscriptCourse9_12::create([
                    'student_profile_id' => $period['student_id'],
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $other_sub->id,
                    'score' => $period['grade'],
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
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
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $subject->id,
                    'score' => $period['grade'],
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
                    'transcript9_12_id' => $period['transcript_id'],
                ]);
            }
        }
    }


    //Foreign language course edit

    public function editForeign($student_id, $transcript9_12id)
    {
        $course = Course::select('id',)
            ->where('course_name', 'Foriegn Language')
            ->first();
        $foreignCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', '9-12')
            ->where('status', 0)
            ->get();
        $courses_id = $course->id;
        $carnegia_status = Transcript9_12::whereId($transcript9_12id)->select('is_carnegie')->first();
        $credits = Credits::whereIn('is_carnegia', $carnegia_status)->select('credit')->get();
        $outOfCredit = Credits::where('is_carnegia', $carnegia_status)->select('total_credit')->first();
        $transcripts = TranscriptCourse9_12::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('transcript9_12_id', $transcript9_12id)->get();
        return view('editTranscript9_12Courses.foreign-course', compact('foreignCourse', 'credits', 'transcripts', 'student_id', 'transcript9_12id', 'courses_id', 'outOfCredit'));
    }
    public function storeForeign(Request $request)
    {
        // delete if course already exists
        $id = $request->get('course_id');
        $refreshCourse = TranscriptCourse9_12::select()->where('courses_id', $request->get('course_id'))->where('transcript9_12_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();

        //create new course
        foreach ($request->get('foreignCourse', []) as $period) {
            $other_subjects = $period['other_subject'];
            $selectedCredit =  $period['selectedCredit'];
            $total_credits = $period['total_credits'];
            $credit = Credits::where('credit', $selectedCredit)->first();
            if ($other_subjects) {
                $other_sub = Subject::create([
                    'courses_id' => $period['courses_id'],
                    'subject_name' => $other_subjects,
                    'transcript_period' => '9-12',
                    'status' => 1,
                ]);
                TranscriptCourse9_12::create([
                    'student_profile_id' => $period['student_id'],
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $other_sub->id,
                    'score' => $period['grade'],
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
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
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $subject->id,
                    'score' => $period['grade'],
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
                    'transcript9_12_id' => $period['transcript_id'],
                ]);
            }
        }
    }



    //Elective course edit

    public function editElective($student_id, $transcript9_12id)
    {
        $course = Course::select('id',)
            ->where('course_name', 'Another')
            ->first();
        $electiveCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', '9-12')
            ->where('status', 0)
            ->get();
        $courses_id = $course->id;
        $carnegia_status = Transcript9_12::whereId($transcript9_12id)->select('is_carnegie')->first();
        $credits = Credits::whereIn('is_carnegia', $carnegia_status)->select('credit')->get();
        $outOfCredit = Credits::where('is_carnegia', $carnegia_status)->select('total_credit')->first();
        $transcripts = TranscriptCourse9_12::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('transcript9_12_id', $transcript9_12id)->get();
        return view('editTranscript9_12Courses.elective-course', compact('electiveCourse', 'credits', 'transcripts', 'student_id', 'transcript9_12id', 'courses_id', 'outOfCredit'));
    }
    public function storeElective(Request $request)
    {
        // delete if course already exists
        $id = $request->get('course_id');
        $refreshCourse = TranscriptCourse9_12::select()->where('courses_id', $request->get('course_id'))->where('transcript9_12_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();

        //create new course
        foreach ($request->get('electiveCourse', []) as $period) {
            $other_subjects = $period['other_subject'];
            $selectedCredit =  $period['selectedCredit'];
            $total_credits = $period['total_credits'];
            $credit = Credits::where('credit', $selectedCredit)->first();
            if ($other_subjects) {
                $other_sub = Subject::create([
                    'courses_id' => $period['courses_id'],
                    'subject_name' => $other_subjects,
                    'transcript_period' => '9-12',
                    'status' => 1,
                ]);
                TranscriptCourse9_12::create([
                    'student_profile_id' => $period['student_id'],
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $other_sub->id,
                    'score' => $period['grade'],
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
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
                    'courses_id' => $period['courses_id'],
                    'subject_id' => $subject->id,
                    'score' => $period['grade'],
                    'credit_id' => $credit->id,
                    'selectedCredit' => $period['selectedCredit'],
                    'remaining_credits' => $total_credits - $period['selectedCredit'],
                    'transcript9_12_id' => $period['transcript_id'],
                ]);
            }
        }
    }
}
