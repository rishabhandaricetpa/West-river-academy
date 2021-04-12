<?php

namespace App\Http\Controllers\TranscriptController;

use App\Http\Controllers\Controller;
use App\Models\AdvancePlacement;
use App\Models\CollegeCourse;
use App\Models\Country;
use App\Models\Credits;
use App\Models\StudentProfile;
use App\Models\Transcript;
use App\Models\Transcript9_12;
use App\Models\TranscriptCourse9_12;
use App\Models\ParentProfile;
use DB;
use Illuminate\Http\Request;

class Transcript9to12 extends Controller
{
    public function selectCountry($student_id, $transcript_id)
    {
        /**
         * select the country for transcript
         *
         */
        try {
            DB::beginTransaction();
            $transcript = Transcript9_12::create([
                'student_profile_id' => $student_id,
                'transcript_id' => $transcript_id,
            ]);
            $countries = Country::all();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Failed to insert Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        return view('transcript9to12.Is_California', compact('student_id', 'transcript', 'countries'));
    }
    public function selectGrade(Request $request, $student_id)
    {
        $transcript = Transcript9_12::find($request->input('transcript_id'));
        // dd($transcript);
        if ($request->is_united_states == 'Yes' && $request->is_california == 'Yes') {
            /**  is carnegia means all country expect california not carnegia  */
            /** 0 means no carnegia -i.e belongs to california so  credits are mutiplied by 10 */
            try {
                DB::beginTransaction();
                $transcript->is_carnegie = 0;
                $transcript->country = "";
                $transcript->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $notification = [
                    'message' => 'Failed to insert Record!',
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }
            return view('transcript9to12.grade', compact('student_id', 'transcript'));
        } else {
            try {
                DB::beginTransaction();
                $transcript->country = $request->get('select_country');
                $transcript->is_carnegie = 1;
                $transcript->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $notification = [
                    'message' => 'Failed to insert Record!',
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }
            return view('transcript9to12.grade', compact('student_id', 'transcript'));
        }
    }
    public function enrollSchool(Request $request, $student_id)
    {
        try {
            DB::beginTransaction();
            $transcript_id = $request->get('transcript_id');
            $transcript = Transcript9_12::find($transcript_id);
            $transcript->grade = $request->get('student_grade');

            if ($request->get('school_name') == 'West River Academy') {
                $transcript->school_name = $request->get('school_name');
            } elseif ($request->get('school_name') == 'Others') {
                $transcript->school_name = $request->get('other_school');
            }
            $transcript->save();

            $enrollment_periods = StudentProfile::find($student_id)->enrollmentPeriods()->get();
            $items = [];
            foreach ($enrollment_periods as $key => $enrollment_period) {
                $items[] = \Carbon\Carbon::parse($enrollment_period->start_date_of_enrollment)->format('Y');
            }
            $result = array_unique($items);
            DB::commit();

            return view('transcript9to12.year-grade', compact('transcript', 'result', 'student_id'));
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
    public function enrollYear(Request $request, $student_id)
    {
        try {
            DB::beginTransaction();
            $transcript_id = $request->get('transcript_id');
            $transcript = Transcript9_12::find($transcript_id);
            if ($request->get('enrollment_year')) {
                $transcript->enrollment_year = $request->get('enrollment_year');
            } elseif ($request->get('other_year')) {
                $transcript->enrollment_year = $request->get('other_year');
            }
            $transcript->save();
            DB::commit();
            $is_carnegie = Transcript9_12::where('id', $transcript_id)->select('is_carnegie')->first();
            // if output is 0 then they belongs to california
            $all_credits = Credits::whereIn('is_carnegia', $is_carnegie)->select('credit')->get();
            return view('transcript9to12.Ap-courses', compact('student_id', 'transcript_id', 'all_credits'));
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
    public function storeApCourses(Request $request)
    {
        $student_id = $request->get('student_id');
        $courses = $request->get('apCourses');
        foreach ($courses as $course) {
            AdvancePlacement::create([
                'student_profile_id' => $student_id,
                'ap_course_name' => $course['course_name'],
                'ap_course_grade' => $course['grade'],
                'ap_course_credits' => $course['credit'],
            ]);
        }
    }
    public function anotherGrade($student_id, $trans_id, $transcript9_12_id)
    {
        return view('transcript9to12.another-grade-level', compact('student_id', 'trans_id', 'transcript9_12_id'));
    }
    public function getAnotherGradeStatus(Request $request)
    {
        $trans_id = $request->get('trans_id');
        $transcript9_12id = $request->get('transcript9_12id');
        $student_id = $request->get('student_id');
        if ($request->get('another_grade') == 'Yes') {
            return redirect()->route('transcript.create', [$trans_id, $student_id]);
        } else {

            return view('transcript9to12.Is-college', compact('student_id', 'trans_id', 'transcript9_12id'));
        }
    }
    public function displayAllGrades($student_id, $transcript_id)
    {
        $student_transcripts = TranscriptCourse9_12::where('student_profile_id', $student_id)->select('transcript9_12_id')->groupBy('transcript9_12_id')->get();
        $transcriptCourses = StudentProfile::find($student_id)->transcriptCourses9_12()->get();
        $details9_12 = StudentProfile::find($student_id)->Transcript912()->get();

        $student = StudentProfile::find($student_id);
        $transcriptDatas = Transcript9_12::where('transcript_id', $transcript_id)
            ->with(['TranscriptCourse9_12', 'TranscriptCourse9_12.subjects', 'TranscriptCourse9_12.course', 'transcript'])
            ->get();
        return view('transcript9to12.transcript-wizard', compact('student', 'transcriptDatas', 'transcript_id'));
    }

    public function deleteSchool($transcript_id)
    {
        try {
            $transcriptDetails = Transcript9_12::find($transcript_id)->delete();
            $notification = [
                'message' => 'School Record Deleted Successfully!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function showCourseDetails($transcript_id, $student_id)
    {
        $transcriptData9_12 = Transcript9_12::where('id', $transcript_id)->first();

        $transcript = Transcript::where('id', $transcriptData9_12->transcript_id)->first();
        if ($transcript->status == 'approved') {
            dd('To edit this school course please pay $25 since this transcript is approved by WRA.');
        } else {
            $courses = TranscriptCourse9_12::where('transcript9_12_id', $transcript_id)
                ->join('transcript9_12', 'transcript9_12.id', 'transcript_course9_12s.transcript9_12_id')
                ->join('courses', 'courses.id', 'transcript_course9_12s.courses_id')
                ->join('subjects', 'subjects.id', 'transcript_course9_12s.subject_id')
                ->get();
            $studentInfo = StudentProfile::find($student_id);
            $school = Transcript9_12::find($transcript_id);

            return view('transcript9to12.show-course-details', compact('courses', 'transcript_id', 'student_id', 'studentInfo', 'school'));
        }
    }


    /**
     *Preview the transcript befor submission
     *
     * @return \Illuminate\Http\Response
     */

    public function previewTranscript($student_id, $transcript_id)
    {
        // dd($transcript_id);
        $parentId = ParentProfile::getParentId();
        $address = ParentProfile::where('id', $parentId)->first();
        $student = StudentProfile::find($student_id);

        $year = Transcript9_12::where('transcript_id', $transcript_id)->orderBy('enrollment_year', 'ASC')->get(['enrollment_year'])->unique('enrollment_year');

        $grades_data  = Transcript9_12::where('transcript_id', $transcript_id)->orderBy('grade', 'ASC')->get(['grade']);

        // START: Transcript data for rendring course data in tabluar format.

        $transcriptDatas = Transcript9_12::select()->where('transcript_id', $transcript_id)
            ->with(['TranscriptCourse9_12', 'TranscriptCourse9_12.subject', 'TranscriptCourse9_12.course', 'TranscriptCourse9_12.credit', 'collegeCourses'])
            ->get();


        // $collegeCourses = CollegeCourse::where('transcript9_12_id',)
        $courses = collect([]);
        $transcriptData = $transcriptDatas->each(function ($transcript_courses) use ($courses) {
            $transcript_courses->TranscriptCourse9_12->map(function ($course) use ($transcript_courses, $courses) {
                $courses->push(
                    (object)[
                        'id' => $course->id,
                        'score' => $course->score,
                        'name' => $course->subject->subject_name,
                        'credit' => $course->credit->credit,
                        'year' => $transcript_courses->enrollment_year,
                        'grade' => $transcript_courses->grade,
                    ]
                );
            });
        });
        //  dd($courses);



        // dd($transcriptData);
        // $transcript_11_12 = $transcriptDatas->whereIn("grade", config('constants.GRADES.11_12'))->sortBy("grade")->toArray();

        // $transcriptData = [
        //     $transcript_9_10,
        //     $transcript_11_12
        // ];

        // END: Transcript data for rendring course data in tabluar format.

        $transcript_course_id = Transcript9_12::select('id')->where('transcript_id', $transcript_id)->get();

        $groupCourses = TranscriptCourse9_12::with(['subject'])->whereIn('transcript9_12_id', $transcript_course_id)->get()->unique('subject_id');
        if ($transcript_id) {
            $enrollment_periods = Transcript9_12::where('transcript_id', $transcript_id)->get();
            $items = [];
            foreach ($enrollment_periods as $key => $enrollment_period) {
                $items[] = $enrollment_period->enrollment_year;
            }

            $maxYear =  max($items);
            $minYear = min($items);

            return view('transcript9to12.transcript-pdf', compact('student', 'transcriptData', 'grades_data', 'groupCourses', 'transcript_id', 'address', 'year', 'minYear', 'maxYear', 'courses'));
        } else {
            $enrollment_periods = Transcript9_12::where('transcript_id', $transcript_id)->get();
            $items = [];
            foreach ($enrollment_periods as $key => $enrollment_period) {
                $items[] = $enrollment_period->enrollment_year;
            }
            $maxYear =  max($items);
            $minYear = min($items);

            $transcript_id = Transcript::select()->where('student_profile_id', $student_id)->whereStatus('completed')->orWhere('status', 'paid')->first();
            return view('transcript9to12.transcript-pdf', compact('student', 'transcriptData', 'grades_data', 'groupCourses', 'transcript_id', 'address', 'year', 'minYear', 'maxYear', 'courses'));
        }
    }
}
