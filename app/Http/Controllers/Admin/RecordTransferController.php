<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SchoolRecordTransfer;
use App\Models\RecordTransfer;
use App\Models\StudentProfile;
use App\Models\UploadDocuments;
use File;
use Illuminate\Http\Request;
use Mail;
use PDF;
use Storage;
use Str;

class RecordTransferController extends Controller
{
    public function index()
    {
        $schoolRecords = RecordTransfer::select()->orderBy('id', 'DESC')->get();
        return view('admin.recordTransfer.adminRecord', compact('schoolRecords'));
    }
    public function studentRecords($record_id)
    {
        $record = RecordTransfer::where('id', $record_id)->first();
        $studentRecords = RecordTransfer::whereIn('student_profile_id', [$record->student_profile_id])->get();
        return view('admin.recordTransfer.adminStudentRecord', compact('studentRecords'));
    }

    public function viewStudentRecord($student_id, $record_id)
    {
        $studentRecord = RecordTransfer::where('student_profile_id', $student_id)->where('id', $record_id)->first();
        $studentEnrollmentYear = StudentProfile::find($student_id)->enrollmentPeriods()->get();
        return view('admin.recordTransfer.viewStudentRecord', compact('studentRecord', 'studentEnrollmentYear'));
    }

    public function sendRecordToSchool(Request $request, $student_id)
    {
        $record = RecordTransfer::find($request->record_id);
        $studentData = StudentProfile::find($student_id);
        $data['email'] = $request->get('email');
        $data['title'] = 'West River Academy';
        $data['name'] = $request->input('name');
        $data['date'] = \Carbon\Carbon::now()->format('M d Y');


        $data['grade'] = $request->input('last_grade');
        $data['dob'] = \Carbon\Carbon::parse($studentData->d_o_b)->format('M d Y');
        $pdf = PDF::loadView('schoolRecordRequest', $data);
        Mail::send('admin.recordTransfer.sendSchoolRecord', ['data' => $data], function ($message) use ($data, $pdf) {
            $message->to($data['email'], $data['email'])
                ->subject($data['title'])
                ->attachData($pdf->output(), 'RecordTransferRequest.pdf');
        });
        $record->save();
        $notification = [
            'message' => 'Record Request Sent Successfully To School',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function resendRecordToSchool($record_id, $student_id)
    {
        $record = RecordTransfer::find($record_id);


        if (empty($record->resendCount)) {
            $record->resendCount = 1;
        } else {
            $lastRequestValue = $record->resendCount;
            $record->resendCount = $lastRequestValue + 1;
        }
        switch ($record->resendCount) {
            case 1:
                $record->firstRequestDate = \Carbon\Carbon::now()->format('M d Y');
                break;
            case 2:
                $record->secondRequestDate = \Carbon\Carbon::now()->format('M d Y');
                break;
            case 3:
                $record->thirdRequest = \Carbon\Carbon::now()->format('M d Y');
                break;
        }

        $studentData = StudentProfile::where('id', $record->student_profile_id)->first();

        $data['email'] = $record->email;
        $data['title'] = 'Request for Student Records';
        $data['name'] = $studentData->first_name;
        $data['date'] = \Carbon\Carbon::now()->format('M d Y');
        $data['dob'] = \Carbon\Carbon::parse($studentData->d_o_b)->format('M d Y');
        $data['grade'] = $record->last_grade;
        $pdf = PDF::loadView('schoolResendRecord', $data);
        Mail::send('admin.recordTransfer.sendSchoolRecord', ['data' => $data], function ($message) use ($data, $pdf) {
            $message->to($data['email'], $data['email'])
                ->subject($data['title'])
                ->attachData($pdf->output(), 'RecordTransferRequest.pdf');
        });
        $record->save();
        $notification = [
            'message' => 'Record Request ReSent Successfully To School',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
    public function downloadRecord($record_id, $student_id)
    {
        $record = RecordTransfer::find($record_id);
        $studentData = StudentProfile::where('id', $record->student_profile_id)->first();
        $data['email'] = $record->email;
        $data['title'] = 'West River Academy';
        $data['name'] = $studentData->first_name;
        $data['date'] = \Carbon\Carbon::now()->format('M d Y');
        $data['dob'] = \Carbon\Carbon::parse($studentData->d_o_b)->format('M d Y');
        $data['grade'] = $record->last_grade;
        $pdf = PDF::loadView('schoolResendRecord', $data);
        return $pdf->download();
    }
    public function receivedRecord(Request $request, $record_id)
    {
        $record = RecordTransfer::find($record_id);
        $record->request_status = 'Record Received';
        $record->medium_of_transfer = $request->mediumOfDelivery;
        $record->save();
        // upload document 
        $cover = $request->file('file');
        if ($request->file('file')) {
            foreach ($request->file as $cover) {
                $extension = $cover->getClientOriginalExtension();
                $path = Str::random(40) . '.' . $extension;
                Storage::put(UploadDocuments::UPLOAD_DIR . '/' . $path,  File::get($cover));

                $uploadDocument = new UploadDocuments();
                $uploadDocument->student_profile_id = $request->student_id;
                $uploadDocument->parent_profile_id = $request->parent_id;
                $uploadDocument->original_filename = $cover->getClientOriginalName();
                $uploadDocument->is_upload_to_student = 1;
                $uploadDocument->filename = $path;
                $uploadDocument->save();
            }
        }
        $notification = [
            'message' => 'Record Received Successfully From School',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
