<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboardData = Dashboard::all();
        return view('admin.dashboard-screen', compact('dashboardData'));
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
