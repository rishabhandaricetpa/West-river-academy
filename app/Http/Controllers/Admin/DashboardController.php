<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminType;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Dashboard;
use App\Models\FeesInfo;
use App\Models\Graduation;
use App\Models\GraduationDetail;
use App\Models\GraduationPayment;
use App\Models\RecordTransfer;
use App\Models\StudentProfile;
use App\Models\UploadDocuments;
use App\Models\TransactionsMethod;
use Illuminate\Http\Request;
use Auth;
use DB;
use Exception;
use File;
use Illuminate\Support\Carbon;
use Storage;
use Str;

class DashboardController extends Controller
{
    /** Display all records to the admin */
    public function index()
    {
        $adminid = Auth::guard('admin')->user()->id;
        $admin_data = DB::table('admins')->where('id', $adminid)->first();
        if ($admin_data->name == AdminType::SuperAdmin) {
            //$dashboardData = Dashboard::select()->with('student', 'recordTransfer')->where('is_archieved', 0)->orderBy('id', 'DESC')->get();
            $dashboardData = TransactionsMethod::select()->with('parentProfile')->where('is_archieved', null)->orderBy('id', 'DESC')->get();
            $isAdmin = true;
            return view('admin.dashboard-admin', compact('dashboardData', 'isAdmin'));
            // return admin dashboard screen
        } else {
            $isAdmin = false;
            $dashboardData = TransactionsMethod::select()->with('student')->where('assigned_to', $admin_data->name)->orderBy('id', 'DESC')->get();
            return view('admin.dashboard-sub-admin', compact('dashboardData', 'isAdmin'));
        }
    }
    /** Update the dashboard of sub admin which is provided by super admin stacey */
    public function updateDashboard(Request $request)
    {
        $record = TransactionsMethod::where('id', $request->id)->first();
        $record->assigned_to = $request->assigned;
        $record->notes = $request->notes;
        $record->save();

        return response()->json(['code' => 200, 'message' => 'Assigned successfully', 'data' => $record], 200);
    }

    public function assignRecord(Request $request)
    {
        $record = TransactionsMethod::find($request->get('assign_id'));
        return response()->json($record);
    }
    public function assignRecordStatus(Request $request)
    {
        $record = TransactionsMethod::find($request->get('assign_id'));

        return response()->json($record);
    }
    public function updateRecordStatus(Request $request)
    {
        $record = TransactionsMethod::where('id', $request->id)->first();
        $record->task_status = $request->assigned;
        $record->save();

        return response()->json(['code' => 200, 'message' => 'Task status updated successfully', 'data' => $record], 200);
    }
    public function archieveRecord(Request $request)
    {
        $dashboard = TransactionsMethod::whereIn('id', $request->id)->update(array('is_archieved' => 1));
        return response()->json(['code' => 200, 'message' => 'Task status updated successfully', 'data' => $dashboard], 200);
    }
    public function ArchievedTasks()
    {
        $adminid = Auth::guard('admin')->user()->id;
        $admin_data = DB::table('admins')->where('id', $adminid)->first();
        if ($admin_data->name == AdminType::SuperAdmin) {
            $dashboardData = TransactionsMethod::select()->with('student')->where('is_archieved', 1)->orderBy('id', 'DESC')->get();
            return view('admin.archieved', compact('dashboardData'));
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
        if ($request->is_upload == 1) {
            $uploadDocument->is_upload_to_student = 1;
        } else {
            $uploadDocument->is_upload_to_student = 0;
        }
        $uploadDocument->document_type = $request->doc_type;
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
        $recordTransfer->street_address = $request->get('record_street_address');
        $recordTransfer->city = $request->get('record_city');
        $recordTransfer->state = $request->get('record_state');
        $recordTransfer->zip_code = $request->get('record_zip_code');
        $recordTransfer->country = $request->get('record_country');
        $recordTransfer->last_grade = $request->get('last_grade');
        $recordTransfer->save();
    }
    public function addGraduation(Request $request)
    {
        try {
            DB::beginTransaction();
            $graduation =   Graduation::updateOrCreate(
                [
                    'student_profile_id' => $request->input('student_id')
                ],
                [
                    'parent_profile_id' => $request->input('parent_id'),
                    'student_profile_id' => $request->input('student_id'),
                    'grade_9_info' => $request->input('grade_9'),
                    'grade_10_info' => $request->input('grade_10'),
                    'grade_11_info' => $request->input('grade_11'),
                    'status' => $request->input('status'),
                    'apostille_country' => $request->input('apostille_country_gard')
                ]
            );


            $graduation_details =   GraduationDetail::updateOrCreate(
                [
                    'graduation_id' => $graduation->id
                ],
                [
                    'grad_date' => $graduation->created_at,
                ]
            );

            if ($request->input('apostille_country_gard')) {
                $graduation_payment =   GraduationPayment::updateOrCreate(
                    [
                        'graduation_id' => $graduation->id
                    ],
                    [
                        'graduation_id' => $graduation->id,
                        'amount' => FeesInfo::getFeeAmount('graduation') + FeesInfo::getFeeAmount('apostille'),

                    ]
                );
            } else {
                $graduation_payment =   GraduationPayment::updateOrCreate(
                    [
                        'graduation_id' => $graduation->id
                    ],
                    [
                        'graduation_id' => $graduation->id,
                        'amount' => FeesInfo::getFeeAmount('graduation'),

                    ]
                );
            }



            if ($request->get('status') == 'paid') {
                $graduation_payment->transcation_id = $request->get('grad_transction_id');
                $graduation_payment->payment_mode = $request->get('custom_payment_mode');
                $graduation_payment->save();
            }
            if ($request->get('status') == 'pending') {
                Cart::create([
                    'item_type' => 'graduation',
                    'item_id' => $graduation->id,
                    'parent_profile_id' => $request->get('parent_id')
                ]);
            }

            if (
                $request->input('status') == 'paid'

            ) {
                $transction = new TransactionsMethod();
                $transction->transcation_id   = $request->get('grad_transction_id') ? $request->get('grad_transction_id')  : substr(uniqid(), 0, 12);
                $transction->payment_mode = $request->get('custom_payment_mode') ? $request->get('custom_payment_mode')  : 'pending';
                $transction->parent_profile_id = $request->get('parent_id');
                $transction->amount = 395;
                $transction->status = 'succeeded';
                $transction->item_type = 'graduation';
                $transction->student_profile_id = $request->get('student_id');
                $transction->save();

                //adding graduation in dashboard
                $student = StudentProfile::where('id', $request->get('student_id'))->first();
                $dashboard = new Dashboard();
                $dashboard->amount = 395;
                $dashboard->linked_to = $student->first_name;
                $dashboard->related_to = 'Graduation Ordered';
                $dashboard->student_profile_id = $request->get('student_id');
                $dashboard->transaction_id =      $transction->transcation_id;
                $dashboard->parent_profile_id = $request->get('parent_id');
                $dashboard->item_type_id = $graduation->id;
                $dashboard->save();
            }


            DB::commit();
        } catch (Exception $e) {
            report($e);
            DB::rollBack();
        }
    }
    public function alertRecordTransfer(Request $request)
    {

        $records = RecordTransfer::where('request_status', 'pending')
            ->orWhere('request_status', null)
            ->join('student_profiles', 'student_profiles.id', 'record_transfers.student_profile_id')
            ->select(
                'student_profiles.first_name',
                'student_profiles.last_name',
                'record_transfers.school_name',
                'student_profiles.id as studentid',
                'record_transfers.firstRequestDate',
                'record_transfers.resendCount',
                'record_transfers.id'
            )
            ->get()->toArray();

        return response()->json($records);
    }
}
