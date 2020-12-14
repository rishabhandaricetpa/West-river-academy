<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\EnrollmentPeriods;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
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

    protected function create(Request $data)
    {
       $val=$_POST['student_grade'];
    //    $val = implode(",",$val);
       $val1=$_POST['startdate'];
       $val2=$_POST['enddate'];

        $student =  StudentProfile::create([
            'parent_profile_id' => auth()->user()->id,
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'd_o_b' => \Carbon\Carbon::createFromFormat('d-M-Y' , $data['dob'])->format('Y-m-d'),
            'email' => $data['email'],
            'cell_phone' => $data['cell_phone'],
            'student_Id' => $data['student_id'],
            'immunized_status' => $data['immunized_Stat'],
            'student_situation' => $data['student_situation'],
           ]);
        $enrollment=EnrollmentPeriods::create([
            'student_profile_id'=> $student->id,
            'start_date_of_enrollment'=> \Carbon\Carbon::createFromFormat('d-M-Y' , $data['startdate'])->format('Y-m-d'),
            'end_date_of_enrollment'=> \Carbon\Carbon::createFromFormat('d-M-Y' , $data['enddate'])->format('Y-m-d'),
            'grade_level'=> $data['student_grade']
        ]);
        $student->save();
        return redirect('/enroll')->with('success', 'Contact saved!');

    }
}
