<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConfirmationLetter;
use App\Models\EnrollmentPeriods;
use App\Models\RecordTransfer;
use App\Models\StudentProfile;
use App\Models\TransactionsMethod;
use App\Models\Transcript;
use Illuminate\Support\Facades\File;
use App\Models\UploadDocuments;
use DB;
use Illuminate\Http\Request;
use PDF;
use Storage;
use Str;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.familyInformation.view-student');
    }

    public function dataTable()
    {
        return datatables(StudentProfile::with(['parentProfile', 'enrollmentPeriods', 'transcriptCourses', 'TranscriptK8', 'graduation', 'recordTransfers'])->latest()->get())->toJson();
    }

    public function selected($parent_profile_id)
    {
        return datatables(StudentProfile::where('parent_profile_id', $parent_profile_id)->with(['parentProfile', 'enrollmentPeriods', 'transcriptCourses', 'TranscriptK8', 'graduation'])->latest()->get())->toJson();
    }
    public function studentInformation($id)
    {
        $students = StudentProfile::where('parent_profile_id', $id)->with(['parentProfile', 'enrollmentPeriods', 'transcriptCourses', 'TranscriptK8', 'graduation', 'recordTransfers', 'uploadDocuments'])->latest()->get();
        return view('admin.familyInformation.student', compact('students', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.familyInformation.edit-student', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = StudentProfile::find($id);
        // information for enrollement tab
        $enrollment_periods = StudentProfile::find($id)->enrollmentPeriods()->get();

        $payment_info = DB::table('enrollment_periods')
            ->where('student_profile_id', $id)
            ->join('enrollment_payments', 'enrollment_payments.enrollment_period_id', 'enrollment_periods.id')
            ->select(
                'enrollment_periods.enrollment_payment_id',
                'enrollment_payments.amount',
                'enrollment_payments.status',
                'enrollment_payments.transcation_id',
                'enrollment_payments.payment_mode',
                'enrollment_periods.start_date_of_enrollment',
                'enrollment_periods.end_date_of_enrollment',
                'enrollment_periods.grade_level',
                'enrollment_payments.id'
            )
            ->get();

        // information for record trasnsfer tab
        $schoolRecords = RecordTransfer::where('student_profile_id', $id)->get();

        // for transcript k-8
        $transcript = Transcript::whereIn('status', ['paid', 'approved', 'completed'])->with('transcriptk8')
            ->Join('k8transcript', 'k8transcript.transcript_id', 'transcripts.id')->where('k8transcript.student_profile_id', $id)
            ->get()->unique('transcript_id');

        // for transcript 9-12
        $transcript9_12s = Transcript::whereIn('status', ['paid', 'approved', 'completed'])->with('transcript9_12')
            ->Join('transcript9_12', 'transcript9_12.transcript_id', 'transcripts.id')->where('transcript9_12.student_profile_id', $id)
            ->get()->unique('transcript_id');
        $uploadedDocuments = UploadDocuments::where('student_profile_id', $id)->get();
        return view('admin.familyInformation.edit-student', compact('student', 'enrollment_periods', 'payment_info', 'schoolRecords', 'transcript', 'transcript9_12s', 'uploadedDocuments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $student = StudentProfile::find($id);
            $enrollment_periods = StudentProfile::find($id)->enrollmentPeriods()->get();
            $student->first_name = $request->get('first_name');
            $student->middle_name = $request->get('first_name');
            $student->last_name = $request->get('last_name');
            $student->d_o_b = \Carbon\Carbon::parse($request->get('dob'))->format('M d Y');
            $student->email = $request->get('email');
            $student->cell_phone = $request->get('cell_phone');
            $student->student_Id = $request->get('student_id');
            $student->immunized_status = $request->get('immunized_status');
            $student->student_situation = $request->get('student_situation');
            $enrollupdate = EnrollmentPeriods::select('id')->where('student_profile_id', $id)->get();

            foreach ($enrollupdate as $key => $en) {
                $enroll = EnrollmentPeriods::whereId($en->id)->first();
                $startDates = $request->get('start_date');
                $endDates = $request->get('end_date');
                $grade_level = $request->get('grade');
                $enroll->start_date_of_enrollment = \Carbon\Carbon::parse($startDates[$key])->format('Y/m/d');
                $enroll->end_date_of_enrollment = \Carbon\Carbon::parse($endDates[$key])->format('Y/m/d');
                $enroll->grade_level = $grade_level[$key];
                $enroll->save();
            }
            $student->save();

            $cover = $request->file('file');
            if ($request->file('file')) {
                foreach ($request->file as $cover) {
                    $extension = $cover->getClientOriginalExtension();
                    $path = Str::random(40) . '.' . $extension;
                    Storage::put(UploadDocuments::UPLOAD_DIR . '/' . $path,  File::get($cover));

                    $uploadDocument = new UploadDocuments();
                    $uploadDocument->student_profile_id = $id;
                    $uploadDocument->parent_profile_id = $request->parent_id;
                    $uploadDocument->original_filename = $cover->getClientOriginalName();
                    $uploadDocument->is_upload_to_student = 1;
                    $uploadDocument->filename = $path;
                    $uploadDocument->save();
                }
            }
            DB::commit();
            $notification = [
                'message' => 'Student Record is updated Successfully!',
                'alert-type' => 'success',
            ];
            return  redirect()->back()->with($notification);
            // return view('admin.edit-student',$student->id)->with($notification);
        } catch (\Exception $e) {
            dd($e);
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $notification = [
                'message' => 'Student Record is Deleted Successfully!',
                'alert-type' => 'warning',
            ];
            StudentProfile::where('id', $id)->delete();
            DB::commit();

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
    public function generateConfirmation($student_id)
    {
        try {
            $parent_id = StudentProfile::select('parent_profile_id')->whereId($student_id)->first();
            $studentProfileData = StudentProfile::whereId($student_id)->first();

            $pdfname = $studentProfileData->first_name . '_' . $studentProfileData->last_name . '_' . $studentProfileData->last_name . '_' . $studentProfileData->d_o_b->format('M_d_Y') . '_' . 'Confirmation_letter';
            $enrollment_periods = StudentProfile::where('confirmation_letters.parent_profile_id', $parent_id->parent_profile_id)
                ->join('confirmation_letters', 'confirmation_letters.student_profile_id', 'student_profiles.id')->where('confirmation_letters.status', 'paid')
                ->join('enrollment_periods', 'enrollment_periods.student_profile_id', 'student_profiles.id')
                ->with('enrollmentPeriods')->get();
            $data = [
                'student' => $studentProfileData,
                'enrollment' => $enrollment_periods,
                'title' => 'Confirmation of Enrollment',
                'date' => date('M j, Y'),
            ];

            $pdf = PDF::loadView('confirmationLetter', $data);
            Storage::put(ConfirmationLetter::UPLOAD_DIR_ADMIN . '/' . $pdfname . '.' . Str::random(10), $pdf->output());
            return $pdf->download($pdfname . '.pdf');
        } catch (\Exception $e) {
            dd($e);
            $notification = [
                'message' => 'Failed!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
    /**
     * view the parent order history
     *
   
     */

    public function viewParentOrders($parent_id)
    {
        $transcations =   TransactionsMethod::where('parent_profile_id', $parent_id)->get();
        return view(
            'admin.familyInformation.orders',
            compact('transcations')
        );
    }
}
