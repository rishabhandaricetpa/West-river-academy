<?php

namespace App\Http\Controllers;

use App\Models\FeesInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\Graduation;
use App\Models\GraduationDetail;
use App\Models\GraduationPayment;

class GraduationController extends Controller
{
    public function index()
    {
        $parent_id = ParentProfile::getParentId();
        $students = StudentProfile::select('id','first_name','last_name','gender')
                                    ->selectRaw('DATE(d_o_b) as dob')
                                    ->where('parent_profile_id',$parent_id)
                                    ->with('graduation')
                                    ->get();

        return view('graduation.index',compact('students'));
    }

    public function gradutaionApplication(Request $request)
    {
        $student_id = $request->query('student');
        $student = StudentProfile::whereId($student_id)->where('parent_profile_id',ParentProfile::getParentId())->with('graduation')->first();

        if($student === null){
            return redirect()->back()->with([
                'message' => 'Student not found!',
                'alert-type' => 'error',
            ]);
        }else if($student->graduation !== null){
            return redirect()->back()->with([
                'message' => 'Graduation is already applied for this student!',
                'alert-type' => 'error',
            ]);
        }

        return view('graduation.application',compact('student'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $inputs = $request->all();

            $fee = FeesInfo::where('type','graduation')->pluck('amount')->first();

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
            GraduationPayment::updateOrInsert(['graduation_id' => $graduation->id],[ 'amount' => $fee]);
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
            
            Graduation::find($id)->update(['status' => $inputs['status']]);

            unset($inputs['_method']);
            unset($inputs['_token']);
            unset($inputs['status']);

            GraduationDetail::where('graduation_id',$id)->update($inputs);

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
        return datatables(Graduation::with(['details','student','parent'])->get())->toJson();
    }

    public function edit(Request $request, $id)
    {
        $graduation = Graduation::whereId($id)->with(['details','student','parent'])->first();

        return view('admin.graduation.edit',compact('graduation'));
    }

    public function purchase(Request $request, $id)
    {
        $student = StudentProfile::find($id)->with(['graduationAddress', 'graduation', 'graduationPayment'])->first();

        return view('graduation.purchase',compact('student'));
    }
}
