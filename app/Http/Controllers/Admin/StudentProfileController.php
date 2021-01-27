<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\EnrollmentPeriods;
class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = StudentProfile::all();
        return view('admin.familyInformation.view-student',compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.familyInformation.edit-student',compact('student'));
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
        $student= StudentProfile::find($id);
        $enrollment_periods= StudentProfile::find($id)->enrollmentPeriods()->get();
        return view('admin.familyInformation.edit-student',compact('student','enrollment_periods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {  
        $student = StudentProfile::find($id);
        $enrollment_periods= StudentProfile::find($id)->enrollmentPeriods()->get();
        $student->first_name   =  $request->get('first_name');
        $student->middle_name  =  $request->get('first_name');
        $student->last_name    =  $request->get('last_name');
        $student->d_o_b        =  $request->get('d_o_b');
        $student->email        =  $request->get('email');
        $student->cell_phone   =  $request->get('cell_phone');
        $student->student_Id	=  $request->get('student_id');
        $student->immunized_status	= $request->get('immunized_status');
       $enrollupdate=EnrollmentPeriods::select('id')->where('student_profile_id',$id)->get();
 
         foreach($enrollupdate as $key => $en){
            $enroll     = EnrollmentPeriods::whereId($en->id)->first();
            $startDates      = $request->get('start_date');
            $endDates        = $request->get('end_date');
            $enroll->start_date_of_enrollment=\Carbon\Carbon::parse($startDates[$key])->format('M d Y');
            $enroll->end_date_of_enrollment=\Carbon\Carbon::parse($startDates[$key])->format('M d Y');
            $enroll->save();
         }       
        $student->save();
        $notification = array(
            'message' => 'Student Record is updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect('admin/view-student')->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = array(
            'message' => 'Student Record is Deleted Successfully!',
            'alert-type' => 'warning'
        );
        StudentProfile::where('id',$id)->delete();
        return redirect()->back()->with($notification);
    }
}
