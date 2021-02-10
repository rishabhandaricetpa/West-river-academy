<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {

        $courses = Course::all();
        return view('admin.transcript.view-courses', compact('courses'));   
    
    }

    public function edit($id)
    {
        $subjects=Subject::where('courses_id',$id)
                        ->get();  
        return view('admin.transcript.edit-courses', compact('subjects'));
    }

}
