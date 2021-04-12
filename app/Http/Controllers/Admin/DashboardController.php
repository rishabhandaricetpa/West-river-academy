<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Auth;
use DB;


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
}
