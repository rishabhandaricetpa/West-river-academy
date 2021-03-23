<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $adminid = Auth::guard('admin')->user()->id;
        $admin_data = DB::table('admins')->where('id', $adminid)->first();
        $dateS = Carbon::now()->startOfMonth()->subMonth(6);
        if ($admin_data->name === "Administrator") {
            dd('here');
            $dashboardData = Dashboard::select()->with('student')->orderBy('id', 'DESC')->where('created_at', '>', $dateS)->get();
            return view('admin.dashboard-screen', compact('dashboardData'));
        } else {
            $dashboardData = Dashboard::select()->with('student')->where('assigned_to', $admin_data->name)->where('created_at', '>', $dateS)->orderBy('id', 'DESC')->get();
            return view('admin.dashboard-screen', compact('dashboardData'));
        }
    }


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
}
