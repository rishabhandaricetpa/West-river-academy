<?php

namespace App\Http\Controllers;

use App\Mail\GraduationApproved;
use App\Models\Country;
use App\Models\FeesInfo;
use App\Models\Graduation;
use App\Models\GraduationDetail;
use App\Models\GraduationPayment;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class GraduationController extends Controller
{
    public function index()
    {
        $parent_id = ParentProfile::getParentId();
        $students = StudentProfile::select('id', 'first_name', 'last_name', 'gender')
            ->selectRaw('DATE(d_o_b) as dob')
            ->where('parent_profile_id', $parent_id)
            ->with('graduation')
            ->get();

        return view('graduation.index', compact('students'));
    }

    public function gradutaionApplication(Request $request)
    {
        $student_id = $request->query('student');
        $student = StudentProfile::whereId($student_id)->where('parent_profile_id', ParentProfile::getParentId())->with('graduation')->first();

        if ($student === null) {
            return redirect()->back()->with([
                'message' => 'Student not found!',
                'alert-type' => 'error',
            ]);
        } elseif ($student->graduation !== null) {
            return redirect()->back()->with([
                'message' => 'Graduation is already applied for this student!',
                'alert-type' => 'error',
            ]);
        }

        return view('graduation.application', compact('student'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $inputs = $request->all();

            $fee = FeesInfo::getFeeAmount('graduation');

            $data = [
                'parent_profile_id' => ParentProfile::getParentId(),
                'student_profile_id' => $inputs['student_id'],
                'grade_9_info' => $inputs['grade_nine_option'] === 'other' ? $inputs['grade_nine_other'] : $inputs['grade_nine_option'],
                'grade_10_info' => $inputs['grade_ten_option'] === 'other' ? $inputs['grade_ten_other'] : $inputs['grade_ten_option'],
                'grade_11_info' => $inputs['grade_eleven_option'] === 'other' ? $inputs['grade_eleven_other'] : $inputs['grade_eleven_option'],
                'status' => 'pending',
            ];

            StudentProfile::whereId($inputs['student_id'])->update(['email' => $inputs['email']]);
            $graduation = Graduation::create($data);
            GraduationPayment::updateOrInsert(['graduation_id' => $graduation->id], ['amount' => $fee]);
            GraduationDetail::updateOrInsert(['graduation_id' => $graduation->id], []);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'success', 'message' => 'Record added successfully']);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Failed to add record']);
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $inputs = $request->all();

            $graduation = Graduation::whereId($id);
            $old_status = $graduation->pluck('status')->first();

            $graduation->update(['status' => $inputs['status']]);

            if ($inputs['status'] === 'approved' && $inputs['status'] != $old_status) {
                $data = $graduation->with(['parent', 'student'])->first();
                if ($data->parent->p1_email) {
                    $graduation_fee = FeesInfo::getFeeAmount('graduation');

                    if ($data->apostille_country) {
                        $apostille_fee = FeesInfo::getFeeAmount('apostille');
                        $total_fee = $graduation_fee + $apostille_fee;
                        $message = 'final transcript and Apostille.';
                    } else {
                        $total_fee = $graduation_fee;
                        $message = 'and final transcript.';
                    }

                    $data->total_fee = $total_fee;
                    $data->message = $message;

                    Mail::to($data->parent->p1_email)->send(new GraduationApproved($data));
                }
            }

            unset($inputs['_method']);
            unset($inputs['_token']);
            unset($inputs['status']);

            GraduationDetail::where('graduation_id', $id)->update($inputs);

            DB::commit();

            return redirect()->route('admin.view.graduation')->with([
                'message' => 'Details updated successfully!',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Failed to update details!',
                'alert-type' => 'error',
            ]);
        }
    }

    public function graduations()
    {
        return view('admin.graduation.view');
    }

    public function dataTable()
    {
        return datatables(Graduation::with(['details', 'student', 'parent'])->get())->toJson();
    }

    public function edit(Request $request, $id)
    {
        $graduation = Graduation::whereId($id)->with(['details', 'student', 'parent'])->first();

        return view('admin.graduation.edit', compact('graduation'));
    }

    public function purchase(Request $request, $id)
    {
        $student = StudentProfile::whereId($id)->with(['graduationAddress', 'graduation', 'graduationPayment', 'parentProfile'])->first();
        $countries = Country::select('country')->where('country', '!=', 'United States')->get();
        $apostille_fee = FeesInfo::getFeeAmount('apostille');
        $graduation_fee = FeesInfo::getFeeAmount('graduation');

        return view('graduation.purchase', compact('student', 'countries', 'apostille_fee', 'graduation_fee'));
    }
}
