<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\Course;
use App\Models\StudentProfile;
use App\Models\TranscriptK8;
use App\Models\Subject;
use App\Models\TranscriptCourse;
use App\Models\Transcript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TranscriptPdf;
use PDF;
use Auth;
use Storage;
class TranscriptController extends Controller
{
    public function index()
    {
        $students = StudentProfile::all();
        return view('admin.transcript.view-student', compact('students'));
    }

    //fetch all the transcript data with completed and approved and paid status

    public function edit($id)
    {
        $transcript=Transcript::whereIn('status',['paid','approved','completed'])
                                ->Join('k8transcript', 'k8transcript.transcript_id', 'transcripts.id')
                                ->get();
        $transcriptData = TranscriptK8::where('student_profile_id', $id)
            ->with(['TranscriptCourse', 'TranscriptCourse.subjects', 'TranscriptCourse.course'])
            ->get();
        $student = StudentProfile::find($id);
         return view('admin.transcript.all-transcript', compact('student', 'transcriptData','transcript'));

    }

  //fetch all the transcript data and Genrate the unsigned transcript

    public function editTranscript($student_id,$transcript_id)
    {
        $transcriptData = TranscriptK8::Where('transcript_id',$transcript_id)
            ->with(['TranscriptCourse', 'TranscriptCourse.subjects', 'TranscriptCourse.course'])
            ->get();
        $student = StudentProfile::find($student_id);
            return view('admin.transcript.view-transcript', compact('student', 'transcriptData','transcript_id'));

    }


    public function editSubGrades($subject_id)
    {
        $subjects=Subject::find($subject_id)->first();
        return view('admin.transcript.edit_subject_grade', compact('subjects'));

    }
//     public function fetchfile($id){
//         // if(isEmpty($id)){
//         //     alert('the user has not submitted the transcript!');
//         // }else{
//        $data= TranscriptPdf::where('student_profile_id',$id)->first();
//        $pdflink=$data->pdf_link ;
//        $pdf = PDF::loadView('transcript.pdf', $data);

//         return $pdf->download('storage/pdf/'.$pdflink);
//         // }
//    }
    public function genrateTranscript($id,$transcript_id)
    {
        //fetch data for the transcript pdf
        $parentId=ParentProfile::getParentId();
        $address=ParentProfile::where('id',$parentId)->first(); 

        $student = StudentProfile::find($id);

        $grades  =TranscriptK8::where('transcript_id',$transcript_id)->orderBy('grade','ASC')->get(['grade']);

        $transcriptData = TranscriptK8::select()->where('transcript_id',$transcript_id)
        ->with(['TranscriptDetails', 'TranscriptCourse.subject', 'TranscriptCourse.course'])
        ->get();
        $groupCourses = TranscriptCourse::with(['subject'])->where('student_profile_id', $id)->get()->unique('subject_id'); 

        $pdfname = $student->fullname. '_' . $student->d_o_b->format('M_d_Y').'_'.$transcript_id . '_' . 'unsigned_transcript_letter';

        $enrollment_periods = StudentProfile::find($student->id)->enrollmentPeriods()->get();

        $data = [
            'student' => $student,
            'transcriptData'=>$transcriptData,
            'grades'=>$grades,
            'groupCourses'=>$groupCourses,
            'transcript_id'=> $transcript_id,
            'address'=> $address,
            'enrollment' => $enrollment_periods,
            'title' => 'transcript',
            'date' => date('m/d/Y'),
        ];

        $pdf = PDF::loadView('admin.transcript.pdf', $data);

        Storage::disk('local')->put('public/pdf/' . $pdfname . '.pdf', $pdf->output());

        //store pdf link
        $storetranscript =  TranscriptPdf::where('transcript_id',$transcript_id)
                            ->where('status','completed')->first();
        if($storetranscript != null){
            $storetranscript->pdf_link = $pdfname . '.pdf';
        }
        $storetranscript->save();
        
        return $pdf->download($pdfname . '.pdf');
    }

}
