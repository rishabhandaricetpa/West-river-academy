<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Auth;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\EnrollmentPeriods;
use App\Models\EnrollmentPayment;
use App\Models\FeesInfo;
use App\Providers\RouteServiceProvider;
use Faker\Calculator\Ean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:strict', 'max:255', 'unique:users'],
            'd_o_b' => ['required'],
        ]);
    }
    public function index(Request $request)
    {
        return view('enrollstudent');
    }

    protected function store(Request $data)
    {
        try{
            DB::beginTransaction();
            $Userid = auth()->user()->id;
            $parentProfileData = User::find($Userid)->parentProfile()->first();
            $id = $parentProfileData->id;
            
            if(!StudentProfile::where('parent_profile_id',$id)->exists()){
                $student_type = 'first_student';
            }else{
                $student_type = 'additional_student';
            }
            
            $student =  StudentProfile::create([
                'parent_profile_id' => $id,
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'd_o_b' => \Carbon\Carbon::parse($data['dob'])->format('Y-m-d'),
                'email' => $data['email'],
                'cell_phone' => $data['cell_phone'],
                'student_Id' => $data['studentID'],
                'immunized_status' => $data['immunized_status'],
                'student_situation' => $data['student_situation'],
                'status' => 0,
            ]);

            foreach ($data->get('enrollPeriods', []) as $period) {
                $selectedStartDate = \Carbon\Carbon::parse($period['selectedStartDate']);
                $selectedEndDate = \Carbon\Carbon::parse($period['selectedEndDate']);
                $type = $selectedStartDate->diffInMonths($selectedEndDate) > 7 ? 'annual' : 'half';

                $enrollPeriod = EnrollmentPeriods::create([
                    'student_profile_id' => $student->id,
                    'start_date_of_enrollment' =>  $selectedStartDate->format('Y-m-d'),
                    'end_date_of_enrollment' => $selectedEndDate->format('Y-m-d'),
                    'grade_level' => $period['grade'],
                    'type' => $type
                ]);

                $fee_type = $student_type.'_'.$type;
                $fee = FeesInfo::select('amount')->where('type',$fee_type)->first();

                $enrollmentPayment = EnrollmentPayment::create([
                    'enrollment_period_id' => $enrollPeriod->id,
                    'status' => 'pending',
                    'amount' => $fee->amount
                ]);

                $enrollPeriod->enrollment_payment_id = $enrollmentPayment->id;
                $enrollPeriod->save();
            }
            DB::commit();

            if ($data->expectsJson()) {
                return response()->json(['status' => 'success' ,'messgae' => 'Student added successfully', 'data' => $student]);
            }
        }catch (\Exception $e) {
            DB::rollBack();

            if ($data->expectsJson()) {
                return response()->json(['status' => 'error' ,'messgae' => 'Failed to add student']);
            }
        }
    }
    public function reviewStudent($id)
    {
        $user_id = Auth::user()->id;
        $students = ParentProfile::find($user_id)->studentProfile()->get();
        $enrollPeriods =  StudentProfile::find($id)->enrollmentPeriods()->get();

        $fees = ParentProfile::getParentPendingFees($user_id);

        return view('reviewstudent', compact('enrollPeriods', 'students', 'fees'));
    }
    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();

            $student = StudentProfile::find($id);
            $student->first_name = $request->input('first_name');
            $student->middle_name = $request->input('middle_name');
            $student->last_name = $request->input('last_name');
            $student->email = $request->input('email');
            $student->d_o_b = \Carbon\Carbon::parse($request->input('dob'))->format('Y-m-d');
            $student->cell_phone = $request->input('cell_phone');
            $student->student_Id = $request->input('student_Id');
            $student->immunized_status = $request->input('immunized_status');
            $student->student_situation = $request->input('student_situation');
            $student->save();
            $periods = collect($request->get('periods'));

            $periods->whereNull('id')->each(function ($period) use ($student) {
                $enrollPeriod = new EnrollmentPeriods();
                $enrollPeriod->fill([
                    'student_profile_id' => $student->id,
                    'start_date_of_enrollment' =>  \Carbon\Carbon::parse($period['selectedStartDate'])->format('Y-m-d'),
                    'end_date_of_enrollment' => \Carbon\Carbon::parse($period['selectedEndDate'])->format('Y-m-d'),
                    'grade_level' => $period['grade']
                ]);
                $enrollPeriod->save();
            });
            $periods->whereNotNull('id')->each(function ($period) use ($student) {
                $enrollPeriod = EnrollmentPeriods::find($period['id']);
                $enrollPeriod->fill([
                    'student_profile_id' => $student->id,
                    'start_date_of_enrollment' =>  \Carbon\Carbon::parse($period['selectedStartDate'])->format('Y-m-d'),
                    'end_date_of_enrollment' => \Carbon\Carbon::parse($period['selectedEndDate'])->format('Y-m-d'),
                    'grade_level' => $period['grade']
                ]);
                $enrollPeriod->save();
            });

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'success' ,'messgae' => 'Student updated successfully']);
            }
        }catch (\Exception $e) {
            DB::rollBack();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'error' ,'messgae' => 'Failed to update student']);
            }
        }
    }
    public function edit($id)
    {
        $studentData = StudentProfile::find($id);
        $enrollPeriods =  StudentProfile::find($id)->enrollmentPeriods()->get();
        return view('edit-enrollstudent', compact('studentData', 'enrollPeriods'));
    }
    public function delete(Request $request, $id)
    {

        $periods_id = collect($request->get('periods'))->pluck('id');
        $enrollPeriods =  StudentProfile::find($id)->enrollmentPeriods()->get();
        $enrollPeriodId = collect($enrollPeriods)->pluck('id');

        $diff = $enrollPeriodId->diff($periods_id);

        EnrollmentPeriods::whereIn('id', $diff)->delete();
    }
}
