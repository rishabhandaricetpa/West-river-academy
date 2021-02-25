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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TranscriptPdf;
use PDF;
class TranscriptController extends Controller
{
    public function index()
    {
        $students = StudentProfile::all();
        return view('admin.transcript.view-student', compact('students'));
    }


    public function edit($id)
    {
        $transcriptData = TranscriptK8::where('student_profile_id', $id)
            ->with(['TranscriptCourse', 'TranscriptCourse.subjects', 'TranscriptCourse.course'])
            ->get();

        $student = StudentProfile::find($id);
            return view('admin.transcript.view-transcript', compact('student', 'transcriptData'));
        
    }
    public function editSubGrades($subject_id)
    {
        $subjects=Subject::find($subject_id)->first();
        return view('admin.transcript.edit_subject_grade', compact('subjects'));

    }
    public function fetchfile($id){

        // if(isEmpty($id)){
        //     alert('the user has not submitted the transcript!');
        // }else{
       $data= TranscriptPdf::where('student_profile_id',$id)->first();
       $pdflink=$data->pdf_link ;
       $pdf = PDF::loadView('transcript.pdf', $data);

        return $pdf->download('storage/pdf/'.$pdflink);
        // }
   }
}
