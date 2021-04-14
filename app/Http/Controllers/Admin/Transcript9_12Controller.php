<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\Subject;
use App\Models\Transcript;
// use App\Models\TranscriptCourse;
// use App\Models\TranscriptK8;
use App\Models\TranscriptPayment;
use App\Models\TranscriptPdf;
use App\Models\Transcript9_12;
use App\Models\TranscriptCourse9_12;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Storage;

class Transcript9_12Controller extends Controller
{

    public function viewtranscripts9_12()
    {
        $students = StudentProfile::all();
        $type = "9-12";
        return view('admin.transcript.view-student', compact('students', 'type'));
    }
    //fetch all the transcript data with completed and approved and paid status
    //whereIn('status', ['paid', 'approved', 'completed'])

    public function edit9_12($id)
    {
        $type = "9-12";

        $transcript = Transcript::whereIn('status', ['paid', 'approved', 'completed'])->with('transcript9_12')
            ->Join('transcript9_12', 'transcript9_12.transcript_id', 'transcripts.id')->where('transcript9_12.student_profile_id', $id)
            ->get()->unique('transcript_id');

        $transcriptData = Transcript9_12::where('student_profile_id', $id)
            ->with(['TranscriptCourse9_12', 'TranscriptCourse9_12.subjects', 'TranscriptCourse9_12.course'])
            ->get();
        $student = StudentProfile::find($id);

        return view('admin.transcript.all-transcript', compact('student', 'transcriptData', 'transcript', 'type'));
    }

    //9_12 view all data
    public function editTranscript9_12($student_id, $transcript_id)
    {
        $transcriptData = Transcript9_12::Where('transcript_id', $transcript_id)
            ->with(['TranscriptCourse9_12', 'TranscriptCourse9_12.subjects', 'TranscriptCourse9_12.course'])
            ->get();

        $student = StudentProfile::whereId($student_id)->with('ParentProfile')->first();
        return view('admin.transcript.view-transcript9_12', compact('student', 'transcriptData', 'transcript_id'));
    }

    public function editSubGrades9_12($subject_id, $transcript_id, $grade_value)
    {
        $schoolDetails = Transcript9_12::Where('transcript_id', $transcript_id)
            ->where('grade', $grade_value)->first();
        $subjectDeatils = TranscriptCourse9_12::where('transcript9_12_id', $schoolDetails->id)
            ->where('subject_id', $subject_id)
            ->first();

        $subjects = Subject::whereId($subject_id)->first();
        return view('admin.transcript.edit_subject_grade9_12', compact('subjects', 'subjectDeatils', 'subject_id', 'transcript_id', 'grade_value'));
    }
    //updateScore
    public function updateScore9_12(Request $request, $subject_id, $transcript_id)
    {
        $schoolDetails = Transcript9_12::where('transcript_id', $transcript_id)
            ->where('grade', $request->get('grade_value'))
            ->first();
        $subjectDeatils = TranscriptCourse9_12::where('transcript9_12_id', $schoolDetails->id)
            ->where('subject_id', $subject_id)
            ->update(['score' => $request['grade']]);
        $notification = [
            'message' => 'score update Successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function genrateTranscript($id, $transcript_id)
    {

        $parentId = ParentProfile::getParentId();
        $address = ParentProfile::where('id', $parentId)->first();
        $student = StudentProfile::find($student_id);

        $year = Transcript9_12::where('transcript_id', $transcript_id)->orderBy('enrollment_year', 'ASC')->get(['enrollment_year'])->unique('enrollment_year');

        $grades_data  = Transcript9_12::where('transcript_id', $transcript_id)->orderBy('grade', 'ASC')->get(['grade']);

        // START: Transcript data for rendring course data in tabluar format.

        $transcriptDatas = Transcript9_12::select()->where('transcript_id', $transcript_id)
            ->with(['TranscriptCourse9_12', 'TranscriptCourse9_12.subject', 'TranscriptCourse9_12.course', 'TranscriptCourse9_12.credit', 'collegeCourses', 'apCourses'])
            ->get();

        $courses = collect([]);
        // for academic years and courses
        $transcriptDatas->each(function ($transcript_courses) use ($courses) {
            $transcript_courses->TranscriptCourse9_12->map(function ($course) use ($transcript_courses, $courses) {
                $courses->push(
                    (object)[
                        'id' => $course->id,
                        'score' => $course->score,
                        'name' => $course->subject->subject_name,
                        'credit' => $course->credit->credit,
                        'groupBy' => $transcript_courses->enrollment_year,
                        'grade' => $transcript_courses->grade,
                        'type' => 'year'
                    ]
                );
            });
        });

        /** for college courses */
        $collegeCourses = collect([]);
        $transcriptDatas->each(function ($college_courses) use ($collegeCourses) {
            $college_courses->collegeCourses->map(function ($cllg_course) use ($collegeCourses) {
                $collegeCourses->push(
                    (object)[
                        'id' => $cllg_course->id,
                        'groupBy' => $cllg_course->name,
                        'course_name' => $cllg_course->course_name,
                        'grade' => $cllg_course->grade,
                        'course_grade'  => $cllg_course->course_grade,
                        'selectedCredit' => $cllg_course->selectedCredit,
                        'type' => 'college'
                    ]
                );
            });
        });
        $courses =  $courses->merge($collegeCourses);


        // END: Transcript data for rendring course data in tabluar format.

        $transcript_9_12_id = Transcript9_12::select('id')->where('transcript_id', $transcript_id)->get();
        $course = TranscriptCourse9_12::whereIn('transcript9_12_id', $transcript_9_12_id)->with('subject')->get();


        /** collected sum for annual year  */
        $collectSelectedGrade = collect($course->pluck('selectedCredit'));
        $sumOfSeletedEnrollmentGrade = $collectSelectedGrade->sum();

        /** collected sum for college course if exits */
        $college_course = CollegeCourse::whereIn('transcript9_12_id', $transcript_9_12_id)->get();
        if (count($college_course) > 0) {
            $collectSelectedGradeCollege = collect($college_course)->pluck('selectedCredit');
            $sumOfSeletedCollegeGrade = $collectSelectedGradeCollege->sum();
            // $totalSelectedGrades = floatval($sumOfSeletedEnrollmentGrade) + floatval($sumOfSeletedCollegeGrade);
        } else {
            $sumOfSeletedCollegeGrade = 0;
        }


        /** collected sum for ap courses course if exits */

        $apCourses = AdvancePlacement::whereIn('transcript9_12_id', $transcript_9_12_id)->get();
        if (count($apCourses) > 0) {
            $collectSelectedGradeApCourse = collect($apCourses)->pluck('ap_course_credits');
            $sumOfSeletedApCourseGrade = $collectSelectedGradeApCourse->sum();
        } else {
            $sumOfSeletedApCourseGrade = 0;
        }

        /** getting total credit from sum of annual year course , college grade courses and ap courses*/
        $totalSelectedGrades = floatval($sumOfSeletedEnrollmentGrade) + floatval($sumOfSeletedCollegeGrade) + floatval($sumOfSeletedApCourseGrade);

        $groupCourses = TranscriptCourse9_12::with(['subject'])->whereIn('transcript9_12_id', $transcript_9_12_id)->get()->unique('subject_id');
        if ($transcript_id) {
            $enrollment_periods = Transcript9_12::where('transcript_id', $transcript_id)->get();
            $items = [];
            foreach ($enrollment_periods as $key => $enrollment_period) {
                $items[] = $enrollment_period->enrollment_year;
            }

            $maxYear =  max($items);
            $minYear = min($items);

            return view('transcript9to12.transcript-preview', compact('student', 'grades_data', 'groupCourses', 'transcript_id', 'address', 'year', 'minYear', 'maxYear', 'courses', 'collegeCourses', 'totalSelectedGrades'));
        } else {

            $enrollment_years = Transcript9_12::where('transcript_id', $transcript_id)->get();
            $years = collect($enrollment_years)->pluck('enrollment_year');
            $maxYear = $years->max();
            $minYear = $years->min();

            $transcript_id = Transcript::select()->where('student_profile_id', $student_id)->whereStatus('completed')->orWhere('status', 'paid')->first();
            return view('transcript9to12.transcript-preview', compact('student',  'grades_data', 'groupCourses', 'transcript_id', 'address', 'year', 'minYear', 'maxYear', 'courses', 'collegeCourses', 'totalSelectedGrades'));
        }
    }
        $data = [
            'student' => $student,
            'transcriptData' => $transcriptData,
            'grades' => $grades,
            'groupCourses' => $groupCourses,
            'transcript_id' => $transcript_id,
            'address' => $address,
            'enrollment' => $enrollment_periods,
            'title' => 'transcript',
            'date' => date('m/d/Y'),
        ];

        $pdf = PDF::loadView('admin.transcript.pdf', $data);

        return $pdf->download($pdfname . '.pdf');
    }

    // //genrate signed transcript
    // public function genrateSignedTranscript($id, $transcript_id)
    // {
    //     try {
    //         DB::beginTransaction();
    //         //fetch data for the transcript pdf
    //         $parentId = StudentProfile::select('parent_profile_id')->whereId($id)->first();
    //         $address = ParentProfile::where('id', $parentId->parent_profile_id)->first();

    //         $student = StudentProfile::find($id);

    //         $grades = TranscriptK8::where('transcript_id', $transcript_id)->orderBy('grade', 'ASC')->get(['grade']);

    //         $transcriptData = TranscriptK8::select()->where('transcript_id', $transcript_id)
    //             ->with(['TranscriptDetails', 'TranscriptCourse.subject', 'TranscriptCourse.course'])
    //             ->get();

    //         $groupCourses = TranscriptCourse::with(['subject'])->where('student_profile_id', $id)->get()->unique('subject_id');

    //         $pdfname = $student->fullname . '_' . $student->d_o_b->format('M_d_Y') . '_' . $transcript_id . '_' . 'signed_transcript_letter';

    //         $enrollment_periods = StudentProfile::find($student->id)->enrollmentPeriods()->get();

    //         $data = [
    //             'student' => $student,
    //             'transcriptData' => $transcriptData,
    //             'grades' => $grades,
    //             'groupCourses' => $groupCourses,
    //             'transcript_id' => $transcript_id,
    //             'address' => $address,
    //             'enrollment' => $enrollment_periods,
    //             'title' => 'transcript',
    //             'date' => date('m/d/Y'),
    //         ];

    //         $pdf = PDF::loadView('admin.transcript.signed_pdf', $data);

    //         Storage::disk('local')->put('public/pdf/' . $pdfname . '.pdf', $pdf->output());

    //         //store pdf link
    //         $storetranscript = TranscriptPdf::where('transcript_id', $transcript_id)
    //             ->where('status', 'completed')->first();
    //         if ($storetranscript != null) {
    //             $storetranscript->pdf_link = $pdfname . '.pdf';
    //             $storetranscript->save();
    //         }

    //         //MOVE CODE FROM HERE TO UPLOAD SIGNED CODE CHANGE THE STATUS TO UPLOAD IN UPLOAD SIGNED
    //         $updateTranscriptStatus = Transcript::whereId($transcript_id)
    //             ->where('status', 'completed')->first();
    //         if ($updateTranscriptStatus != null) {
    //             $updateTranscriptStatus->status = 'approved';
    //             $updateTranscriptStatus->save();
    //         }
    //         $paymentsTranscriptStatus = TranscriptPayment::where('transcript_id', $transcript_id)
    //             ->where('status', 'completed')->first();
    //         if ($paymentsTranscriptStatus != null) {
    //             $paymentsTranscriptStatus->status = 'approved';
    //             $paymentsTranscriptStatus->save();
    //         }
    //         DB::commit();

    //         return $pdf->download($pdfname . '.pdf');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         $notification = [
    //             'message' => 'Data Missmatch',
    //             'alert-type' => 'error',
    //         ];

    //         return redirect()->back()->with($notification);
    //     }
    // }

    // //delete subject from transcript

    // public function deleteSubGrades($subject_id, $transcript_id)
    // {
    //     // dd($transcript_id);
    // }

    // /* *
    //  *view all the payments of the transcript methods
    //  *
    //  * @return \Illuminate\Http\Response
    //  * 
    //  */
    // public function viewAllPayments()
    // {
    //     $getAlltranscriptPayments = TranscriptPayment::with('transcript', 'transcript.student')->get();
    //     return view('admin.transcript.transcript_payments', compact('getAlltranscriptPayments'));
    // }
    // public function editAllPayments($transpay_id)
    // {
    //     $geteachtranscriptPayments = TranscriptPayment::with('transcript', 'transcript.student')->whereId($transpay_id)->first();
    //     return view('admin.transcript.edit-transcript_payments', compact('geteachtranscriptPayments'));
    // }

    // public function  destroyeachPayments($transpay_id)
    // {
    //     try {
    //         DB::beginTransaction();

    //         TranscriptPayment::where('id', $transpay_id)->delete();
    //         DB::commit();
    //         $notification = [
    //             'message' => 'Trannscript Payment is Deleted Successfully!',
    //             'alert-type' => 'warning',
    //         ];
    //         return redirect()->back()->with($notification);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         $notification = [
    //             'message' => 'Failed to update Record!',
    //             'alert-type' => 'error',
    //         ];
    //         return redirect()->back()->with($notification);
    //     }
    // }
}
