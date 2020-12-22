<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Auth;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\EnrollmentPeriods;
use App\Providers\RouteServiceProvider;
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
        $id = auth()->user()->id;
        $parentProfileData = User::find($id)->parentProfile()->first();
        $country = $parentProfileData->country;
        $countryData = Country::where('country', $country)->first();
        $countryId = $countryData->id;
        $semesters_dates = Country::find($countryId)->semesters()->get();
        if ($request->expectsJson()) {
            return response()->json($semesters_dates);
        }
        return view('enrollstudent', compact('semesters_dates'));
    }

    protected function store(Request $data)
    {

        $Userid = auth()->user()->id;
        $parentProfileData = User::find($Userid)->parentProfile()->first();
        $id = $parentProfileData->id;
        $student =  StudentProfile::create([

            'parent_profile_id' => $id,
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'd_o_b' => \Carbon\Carbon::parse($data['d_o_b'])->format('Y-m-d'),
            'email' => $data['email'],
            'cell_phone' => $data['cell_phone'],
            'student_Id' => $data['studentID'],
            'immunized_status' => $data['immunized_status'],
            'student_situation' => $data['student_situation'],
        ]);
        foreach ($data->get('enrollPeriods', []) as $period) {
            $enrollPeriods = EnrollmentPeriods::create([
                'student_profile_id' => $student->id,
                'start_date_of_enrollment' => $period['selectedStartDate'],
                'end_date_of_enrollment' => $period['selectedEndDate'],
                'grade_level' => $period['grade']
            ]);
        }
        if ($data->expectsJson()) {
            return response()->json($student);
        }
        // return view('reviewstudent', compact('enrollPeriods'));
    }
    public function reviewStudent($id)
    {

        $studentData = StudentProfile::find($id);
        $enrollPeriods =  StudentProfile::find($id)->enrollmentPeriods()->get();
        return view('reviewstudent', compact('studentData', 'enrollPeriods'));
    }
    public function edit($id)
    {
        $studentData = StudentProfile::find($id);
        $enrollPeriods =  StudentProfile::find($id)->enrollmentPeriods()->get();
        //  dd($enrollPeriods);
        return view('edit-enrollstudent', compact('studentData', 'enrollPeriods'));
    }
}
