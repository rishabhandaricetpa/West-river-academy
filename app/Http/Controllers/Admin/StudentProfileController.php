<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ParentProfile;
use App\Models\StudentProfile;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = StudentProfile::all();
        return view('admin.familyInformation.view-student',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.familyInformation.edit-student',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data= StudentProfile::find($id);
        return view('admin.familyInformation.edit-student',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id)
    {
        $data->validate([
            'first_name'=>'required',
            'first_name'=>'required',
            'email'=>'required'
        ]);
        $data = StudentProfile::find($id);
        $data->first_name   =  $data->get('first_name');
        $data->middle_name  =  $data->get('first_name');
        $data->last_name    =  $data->get('last_name');
        $data->d_o_b        =  $data->get('dob');
        $data->email        =  $data->get('email');
        $data->cell_phone   =  $data->get('cell_phone');
        $data->student_Id	=  $data->get('student_Id');
        $data->immunized_status	= $data->get('immunized_Stat');
        $data->save();

        return redirect('admin.familyInformation.edit-student')->with('success', 'Student Information updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StudentProfile::where('id',$id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
