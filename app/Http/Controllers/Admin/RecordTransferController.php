<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SchoolRecordTransfer;
use App\Models\RecordTransfer;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Mail;
use PDF;

class RecordTransferController extends Controller
{
    public function index()
    {
        $schoolRecords = RecordTransfer::all();

        return view('admin.recordTransfer.adminRecord', compact('schoolRecords'));
    }

    public function viewStudentRecord($id)
    {
        $studentRecord = RecordTransfer::where('student_profile_id', $id)->first();
        $studentEnrollmentYear = StudentProfile::find($id)->enrollmentPeriods()->get();
        return view('admin.recordTransfer.viewStudentRecord', compact('studentRecord', 'studentEnrollmentYear'));
    }

    public function sendRecordToSchool(Request $request, $student_id)
    {
        //dd($request->all());
        $record = RecordTransfer::find($request->record_id);
        $studentData = StudentProfile::find($student_id);
        $data['email'] = $request->get('email');
        $data['title'] = 'West River Academy';
        $data['name'] = $request->input('name');
        $data['date'] = \Carbon\Carbon::now()->format('M d Y');
        $data['grade'] = $request->get('enrollmentyear');
        $data['dob'] = \Carbon\Carbon::parse($studentData->d_o_b)->format('M d Y');
        $pdf = PDF::loadView('schoolRecord', $data);
        Mail::send('admin.recordTransfer.sendSchoolRecord', $data, function ($message) use ($data, $pdf) {
            $message->to($data['email'], $data['email'])
                ->subject($data['title'])
                ->attachData($pdf->output(), 'RecordTransferRequest.pdf');
        });
        $record->status = 'Request Sent';
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
        // dd($studentData);
        $data['email'] = $record->email;
        $data['title'] = 'West River Academy';
        $data['name'] = $studentData->first_name;
        $data['date'] = \Carbon\Carbon::now()->format('M d Y');
        $data['dob'] = \Carbon\Carbon::parse($studentData->d_o_b)->format('M d Y');
        $pdf = PDF::loadView('schoolRecord', $data);
        Mail::send('admin.recordTransfer.sendSchoolRecord', $data, function ($message) use ($data, $pdf) {
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
}
