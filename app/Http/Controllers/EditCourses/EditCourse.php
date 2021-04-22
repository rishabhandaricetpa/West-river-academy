<?php

namespace App\Http\Controllers\EditCourses;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\TranscriptCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditCourse extends Controller
{
    public function editEnglish($student_id, $transcript_id)
    {
        $course = Course::select('id',)
            ->where('course_name', 'English / Language Arts')
            ->first();
        $englishCourse = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->where('status', 0)
            ->get();
        $courses_id = $course->id;

        $transcripts = TranscriptCourse::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('k8transcript_id', $transcript_id)->get();
        return view('editCourses.english-course', compact('englishCourse', 'transcripts', 'student_id', 'transcript_id', 'courses_id'));
    }

    public function storeEnglish(Request $request)
    {
        DB::beginTransaction();
        $refreshCourse = TranscriptCourse::select()->where('courses_id', $request->get('courses_id'))->where('k8transcript_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();
        foreach ($request->get('englishCourse', []) as $period) {
            $other_subjects = $period['other_subject'];
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
                $subject_name = $period['subject_name'];

                $subject = Subject::where('subject_name', $subject_name)->first();
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
        //  dd($refreshCourse);
    }

    public function editSocialStudies($student_id, $transcript_id)
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
        $transcripts = TranscriptCourse::with('subject')->where('student_profile_id', $student_id)
            ->where('courses_id', $courses_id)->where('k8transcript_id', $transcript_id)->get();

        return view('editCourses.social-studies', compact('socialStudiesCourse', 'transcripts', 'student_id', 'transcript_id', 'courses_id'));
    }

    public function storeSocial(Request $request)
    {
        DB::beginTransaction();
        $refreshCourse = TranscriptCourse::select()->where('courses_id', $request->get('courses_id'))->where('k8transcript_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();
        foreach ($request->get('Course', []) as $period) {
            $other_subjects = $period['other_subject'];
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
                $subject_name = $period['subject_name'];

                $subject = Subject::where('subject_name', $subject_name)->first();
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

    public function editMaths($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'Mathematics')
            ->first();
        $courses_id = $course->id;
        $maths_course = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->where('status', 0)
            ->get();
        $transcripts = TranscriptCourse::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('k8transcript_id', $transcript_id)->get();

        return view('editCourses.maths-course', compact('maths_course', 'student_id', 'courses_id', 'transcript_id', 'transcripts'));
    }

    public function storeMaths(Request $request)
    {
        DB::beginTransaction();
        $refreshCourse = TranscriptCourse::select()->where('courses_id', $request->get('courses_id'))->where('k8transcript_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();
        foreach ($request->get('Course', []) as $period) {
            $other_subjects = $period['other_subject'];
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
                $subject_name = $period['subject_name'];

                $subject = Subject::where('subject_name', $subject_name)->first();
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

    public function editScience($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'Science')
            ->first();
        $courses_id = $course->id;
        $science_course = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->where('status', 0)
            ->get();
        $transcripts = TranscriptCourse::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('k8transcript_id', $transcript_id)->get();

        return view('editCourses.science-course', compact('science_course', 'student_id', 'courses_id', 'transcript_id', 'transcripts'));
    }

    public function storeScience(Request $request)
    {
        DB::beginTransaction();
        $refreshCourse = TranscriptCourse::select()->where('courses_id', $request->get('courses_id'))->where('k8transcript_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();
        foreach ($request->get('Course', []) as $period) {
            $other_subjects = $period['other_subject'];
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
                $subject_name = $period['subject_name'];

                $subject = Subject::where('subject_name', $subject_name)->first();
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

    public function editPhysicalEducation($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'Physical Education')
            ->first();
        $courses_id = $course->id;
        $physical_education = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->where('status', 0)
            ->get();
        $transcripts = TranscriptCourse::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('k8transcript_id', $transcript_id)->get();

        return view('editCourses.physical_education', compact('physical_education', 'student_id', 'courses_id', 'transcript_id', 'transcripts'));
    }

    public function storePhysicalEducation(Request $request)
    {
        DB::beginTransaction();
        $refreshCourse = TranscriptCourse::select()->where('courses_id', $request->get('courses_id'))->where('k8transcript_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();
        foreach ($request->get('Course', []) as $period) {
            $other_subjects = $period['other_subject'];
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
                $subject_name = $period['subject_name'];

                $subject = Subject::where('subject_name', $subject_name)->first();
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

    public function editHealth($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'Health')
            ->first();
        $courses_id = $course->id;
        $health_course = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->where('status', 0)
            ->get();
        $transcripts = TranscriptCourse::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('k8transcript_id', $transcript_id)->get();

        return view('editCourses.health-course', compact('health_course', 'student_id', 'courses_id', 'transcript_id', 'transcripts'));
    }

    public function storeHealth(Request $request)
    {
        DB::beginTransaction();
        $refreshCourse = TranscriptCourse::select()->where('courses_id', $request->get('courses_id'))->where('k8transcript_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();
        foreach ($request->get('Course', []) as $period) {
            $other_subjects = $period['other_subject'];
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
                $subject_name = $period['subject_name'];

                $subject = Subject::where('subject_name', $subject_name)->first();
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

    public function editForeign($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'Foreign Language')
            ->first();
        $courses_id = $course->id;
        $foreign_course = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->where('status', 0)
            ->get();
        $transcripts = TranscriptCourse::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('k8transcript_id', $transcript_id)->get();

        return view('editCourses.foreign-course', compact('foreign_course', 'student_id', 'courses_id', 'transcript_id', 'transcripts'));
    }

    public function storeForeign(Request $request)
    {
        DB::beginTransaction();
        $refreshCourse = TranscriptCourse::select()->where('courses_id', $request->get('courses_id'))->where('k8transcript_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();
        foreach ($request->get('Course', []) as $period) {
            $other_subjects = $period['other_subject'];
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
                $subject_name = $period['subject_name'];

                $subject = Subject::where('subject_name', $subject_name)->first();
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

    public function editAnother($student_id, $transcript_id)
    {
        $course = Course::select('id', DB::raw('count(*) as total'))
            ->groupBy('id')
            ->where('course_name', 'Another')
            ->first();
        $courses_id = $course->id;
        $another_course = Subject::where('courses_id', $course->id)
            ->where('transcript_period', 'K-8')
            ->where('status', 0)
            ->get();
        $transcripts = TranscriptCourse::with('subject')->where('student_profile_id', $student_id)->where('courses_id', $courses_id)->where('k8transcript_id', $transcript_id)->get();

        return view('editCourses.another-course', compact('another_course', 'student_id', 'courses_id', 'transcript_id', 'transcripts'));
    }

    public function storeAnother(Request $request)
    {
        DB::beginTransaction();
        $refreshCourse = TranscriptCourse::select()->where('courses_id', $request->get('courses_id'))->where('k8transcript_id', $request->get('transcript_id'))->get();
        $refreshCourse->each->delete();
        foreach ($request->get('Course', []) as $period) {
            $other_subjects = $period['other_subject'];
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
                $subject_name = $period['subject_name'];

                $subject = Subject::where('subject_name', $subject_name)->first();
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
