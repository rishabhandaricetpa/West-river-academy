<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\StudentProfile;
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

    protected function create(Request $data)
    {
        $user = Auth::user();
        $student =  StudentProfile::create([
             'parent_profile_id' => $user->id,
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'd_o_b' => \Carbon\Carbon::createFromFormat('d-m-Y', $data['dob'])->format('d/m/Y'),
            'email' => $data['email'],
            'cell_phone' => $data['cell_phone'],
            'student_Id' => $data['student_id'],
            // 'start_date_of_enrollment' => $data['p2_nickname'],
            // 'end_date_of_enrollment' => $data['p2_email'],
            'grade_level' => $data['student_grade'],
            'immunized_status' => $data['immunized_Stat'],
            'student_situation' => $data['student_situation'],
           ]);
        $student->save();
        return redirect('/enroll')->with('success', 'Contact saved!');

    }
}
