<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\ParentProfile;
use App\Models\RecordTransfer;
use App\Models\StudentProfile;
use Auth;
use DB;
use Illuminate\Http\Request;

class RecordTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parentId)
    {
        $students = ParentProfile::find($parentId)->studentProfile()->get();

        return view('recordTransfer.studentDetails', compact('students', 'parentId'));
    }
    public function getStudents()
    {
        return redirect()->route('record.transfer', Auth::user()->id);
    }
    public function sendRecordRequest($student_id, $parent_id)
    {
        $enrollment_ids =   getEnrollmetForStudents($student_id);
        $enroll_student = StudentProfile::find($student_id);
        $payment_info = getPaymentInformation($enrollment_ids);

        if (count($payment_info) == 0) {
            return view('transcript.dashboard-notify-record', compact('enroll_student'));
        } else {
            return view('recordTransfer.previous-school', compact('student_id', 'parent_id'));
        }
    }

    public function storeRecordRequest(Request $request, $student_id, $parent_id)
    {
        try {
            DB::beginTransaction();
            $recordTransfer = new RecordTransfer();
            $recordTransfer->student_profile_id = $student_id;
            $recordTransfer->parent_profile_id = $parent_id;
            $recordTransfer->school_name = $request->get('school_name');
            $recordTransfer->email = $request->get('email');
            $recordTransfer->fax_number = $request->get('fax_number');
            $recordTransfer->phone_number = $request->get('phone_number');
            $recordTransfer->street_address = $request->get('street_address');
            $recordTransfer->city = $request->get('city');
            $recordTransfer->state = $request->get('state');
            $recordTransfer->zip_code = $request->get('zip_code');
            $recordTransfer->country = $request->get('country');
            $recordTransfer->last_grade = $request->get('last_grade');
            $recordTransfer->save();
            Dashboard::create([
                'parent_profile_id' => $parent_id,
                'student_profile_id' => $student_id,
                'linked_to' => $recordTransfer->id,
                'item_type_id' => $recordTransfer->id,
                'related_to' => 'record_transfer',

                'created_date' => \Carbon\Carbon::now()->format('M d Y'),
            ]);
            DB::commit();
            $notification = [
                'message' => 'Record Transfer Request Sent Successfully!',
                'alert-type' => 'success',
            ];

            return view('recordTransfer.thankyou', compact('parent_id'));
        } catch (\Exception $e) {

            DB::rollback();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function editRecordRequest($id)
    {
        $school_record = RecordTransfer::find($id);

        return view('recordTransfer.edit-record', compact('school_record'));
    }

    public function updateStoreRecordRequest(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $recordTransfer = RecordTransfer::find($id);
            $recordTransfer->student_profile_id = $request->get('student_id');
            $recordTransfer->parent_profile_id = $request->get('parent_id');
            $recordTransfer->school_name = $request->get('school_name');
            $recordTransfer->email = $request->get('email');
            $recordTransfer->fax_number = $request->get('fax_number');
            $recordTransfer->phone_number = $request->get('phone_number');
            $recordTransfer->street_address = $request->get('street_address');
            $recordTransfer->city = $request->get('city');
            $recordTransfer->state = $request->get('state');
            $recordTransfer->zip_code = $request->get('zip_code');
            $recordTransfer->country = $request->get('country');
            $recordTransfer->last_grade = $request->get('last_grade');
            $recordTransfer->save();
            DB::commit();
            $notification = [
                'message' => 'Record Transfer Request Updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
}
