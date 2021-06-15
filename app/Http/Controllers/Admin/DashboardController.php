<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\RecordTransfer;
use App\Models\UploadDocuments;
use Illuminate\Http\Request;
use Auth;
use DB;
use File;
use Storage;
use Str;

class DashboardController extends Controller
{
    /** Display all records to the admin */
    public function index()
    {
        $adminid = Auth::guard('admin')->user()->id;
        $admin_data = DB::table('admins')->where('id', $adminid)->first();
        if ($admin_data->name == "Stacey") {
            $dashboardData = Dashboard::select()->with('student', 'recordTransfer')->where('is_archieved', 0)->orderBy('id', 'DESC')->get();
            $isAdmin = true;
            return view('admin.dashboard-screen', compact('dashboardData', 'isAdmin'));
        } else {
            $isAdmin = false;
            $dashboardData = Dashboard::select()->with('student')->where('assigned_to', $admin_data->name)->orderBy('id', 'DESC')->get();
            return view('admin.dashboard-screen', compact('dashboardData', 'isAdmin'));
        }
    }
    /** Update the dashboard of sub admin which is provided by super admin stacey */
    public function updateDashboard(Request $request)
    {
        $record = Dashboard::where('id', $request->id)->first();
        $record->assigned_to = $request->assigned;
        $record->notes = $request->notes;
        $record->save();

        return response()->json(['code' => 200, 'message' => 'Assigned successfully', 'data' => $record], 200);
    }

    public function assignRecord(Request $request)
    {
        $record = Dashboard::find($request->get('assign_id'));
        return response()->json($record);
    }
    public function assignRecordStatus(Request $request)
    {
        $record = Dashboard::find($request->get('assign_id'));

        return response()->json($record);
    }
    public function updateRecordStatus(Request $request)
    {
        $record = Dashboard::where('id', $request->id)->first();
        $record->status = $request->assigned;
        $record->save();

        return response()->json(['code' => 200, 'message' => 'Task status updated successfully', 'data' => $record], 200);
    }
    public function archieveRecord(Request $request)
    {
        $dashboard = Dashboard::whereIn('id', $request->id)->update(array('is_archieved' => 1));
        return response()->json(['code' => 200, 'message' => 'Task status updated successfully', 'data' => $dashboard], 200);
    }
    public function ArchievedTasks()
    {
        $adminid = Auth::guard('admin')->user()->id;
        $admin_data = DB::table('admins')->where('id', $adminid)->first();
        if ($admin_data->name == "Stacey") {
            $dashboardData = Dashboard::select()->with('student')->where('is_archieved', 1)->orderBy('id', 'DESC')->get();
            $isAdmin = true;
            return view('admin.archieved', compact('dashboardData', 'isAdmin'));
        }
    }
    public function uploadDocument(Request $request)
    {
        $extension = $request->file->getClientOriginalExtension();
        $path = Str::random(40) . '.' . $extension;
        Storage::put(UploadDocuments::UPLOAD_DIR . '/' . $path,  File::get($request->file));

        $uploadDocument = new UploadDocuments();
        $uploadDocument->student_profile_id = $request->student_id;
        $uploadDocument->parent_profile_id = $request->parent_id;
        $uploadDocument->original_filename = $request->file->getClientOriginalName();
        $uploadDocument->filename = $path;
        $uploadDocument->save();
        if ($request->expectsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Student updated successfully']);
        }
    }

    public function uploadRecordTransfer(Request $request)
    {
        $recordTransfer = new RecordTransfer();
        $recordTransfer->student_profile_id = $request->get('student_id');
        $recordTransfer->parent_profile_id = $request->get('parent_id');
        $recordTransfer->school_name = $request->get('school_name');
        $recordTransfer->email = $request->get('email_add');
        $recordTransfer->fax_number = $request->get('fax_number');
        $recordTransfer->phone_number = $request->get('phone_number');
        $recordTransfer->street_address = $request->get('street_address');
        $recordTransfer->city = $request->get('city');
        $recordTransfer->state = $request->get('state');
        $recordTransfer->zip_code = $request->get('zipcode');
        $recordTransfer->country = $request->get('country');
        $recordTransfer->last_grade = $request->get('last_grade');
        $recordTransfer->save();
    }
}
