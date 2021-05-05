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
            $dateofGraduation=Transcript::whereId($transcript_id)->first();
        $student = StudentProfile::whereId($student_id)->with('ParentProfile')->first();
        return view('admin.transcript.view-transcript9_12', compact('student', 'transcriptData', 'transcript_id','dateofGraduation'));
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
        //fetch data for the transcript pdf
        $parentId = StudentProfile::select('parent_profile_id')->whereId($id)->first();
        $address = ParentProfile::where('id', $parentId->parent_profile_id)->first();
        $student = StudentProfile::find($id);
    }

    //genrate signed transcript
    public function genrateSignedTranscript($id, $transcript_id)
    {
        try {
            DB::beginTransaction();
            //fetch data for the transcript pdf
            $parentId = StudentProfile::select('parent_profile_id')->whereId($id)->first();
            $address = ParentProfile::where('id', $parentId->parent_profile_id)->first();
            $student = StudentProfile::find($id);
            $dateofGraduation=Transcript::whereId($transcript_id)->first();
            $grades_data  = Transcript9_12::where('transcript_id', $transcript_id)->orderBy('grade', 'ASC')->get(['grade']);

            $transcriptData = Transcript9_12::select()->where('transcript_id', $transcript_id)
                ->with(['TranscriptCourse9_12', 'TranscriptCourse9_12.subject', 'TranscriptCourse9_12.course', 'TranscriptCourse9_12.credit', 'collegeCourses', 'apCourses'])
                ->get();

            $courses = fetchTranscript9_12Details($transcriptData);
            $transcript_9_12_id = Transcript9_12::select('id')->where('transcript_id', $transcript_id)->get();
            $totalSelectedGrades = getTotalCredits($transcript_id, $transcript_9_12_id);
            if ($transcript_id) {
                $enrollment_periods = Transcript9_12::where('transcript_id', $transcript_id)->get();
                $years = collect($enrollment_periods)->pluck('enrollment_year');
                $maxYear = $years->max();
                $minYear = $years->min();
            } else {

                $enrollment_years = Transcript9_12::where('transcript_id', $transcript_id)->get();
                $years = collect($enrollment_years)->pluck('enrollment_year');
                $maxYear = $years->max();
                $minYear = $years->min();

                $transcript_id = Transcript::select()->where('student_profile_id', $student->id)->whereStatus('completed')->orWhere('status', 'paid')->first();
            }
            $pdfname = $student->fullname . '_' . $student->d_o_b->format('M_d_Y') . '_' . $transcript_id . '_' . 'Signed_transcript_letter';
            $data = [
                'student' => $student,
                'transcript_id' => $transcript_id,
                'grades_data' => $grades_data,
                'address' => $address,
                'minYear' => $minYear,
                'maxYear' => $maxYear,
                'courses' => $courses,
                'totalSelectedGrades' => $totalSelectedGrades,
                'date' => date('m/d/Y'),
                'dateofGraduation'=>$dateofGraduation,
            ];

            $pdf = PDF::loadView('admin.transcript.signed_pdf9_12', $data);

            Storage::disk('local')->put('public/pdf/' . $pdfname . '.pdf', $pdf->output());

            //store pdf link
            $storetranscript = TranscriptPdf::where('transcript_id', $transcript_id)
                ->where('status', 'completed')->first();
            if ($storetranscript != null) {
                $storetranscript->pdf_link = $pdfname . '.pdf';
                $storetranscript->save();
            }

            //MOVE CODE FROM HERE TO UPLOAD SIGNED CODE CHANGE THE STATUS TO UPLOAD IN UPLOAD SIGNED
            $updateTranscriptStatus = Transcript::whereId($transcript_id)
                ->where('status', 'completed')->first();
            if ($updateTranscriptStatus != null) {
                $updateTranscriptStatus->status = 'approved';
                $updateTranscriptStatus->save();
            }
            $paymentsTranscriptStatus = TranscriptPayment::where('transcript_id', $transcript_id)
                ->where('status', 'completed')->first();
            if ($paymentsTranscriptStatus != null) {
                $paymentsTranscriptStatus->status = 'approved';
                $paymentsTranscriptStatus->save();
            }
            DB::commit();

            return $pdf->download($pdfname . '.pdf');
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Data Missmatch',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function updateDateofGraduation(Request $request,$student_id, $transcript_id)
    {
        try {
            $transcript = Transcript::whereId($transcript_id)->first();
            if ($transcript) {
                $transcript->date_of_graduation = $request->get('graduation_date');
            }
            $transcript->save();   
            $notification = [
                'message' => 'Graduation Date Updated',
                'alert-type' => 'success',
            ];  
            return redirect()->back()->with($notification);
        }  
        catch(\Exception $e) {
            dd($e);
            DB::rollback();
            $notification = [
                'message' => 'Data Missmatch',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
}
