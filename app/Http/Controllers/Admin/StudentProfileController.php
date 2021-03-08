<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EnrollmentPeriods;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use DB;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.familyInformation.view-student');
    }

    public function dataTable()
    {
        return datatables(StudentProfile::with(['parentProfile', 'enrollmentPeriods', 'transcriptCourses', 'TranscriptK8', 'graduation'])->get())->toJson();
    }

    public function studentInformation($id)
    {
        $student = StudentProfile::where('parent_profile_id', $id)->get();

        return view('admin.familyInformation.view-student', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.familyInformation.edit-student', compact('student'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = StudentProfile::find($id);
        $enrollment_periods = StudentProfile::find($id)->enrollmentPeriods()->get();

        return view('admin.familyInformation.edit-student', compact('student', 'enrollment_periods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $student = StudentProfile::find($id);
            $enrollment_periods = StudentProfile::find($id)->enrollmentPeriods()->get();
            $student->first_name = $request->get('first_name');
            $student->middle_name = $request->get('first_name');
            $student->last_name = $request->get('last_name');
            $student->d_o_b = \Carbon\Carbon::parse($request->get('d_o_b'))->format('M d Y');
            $student->email = $request->get('email');
            $student->cell_phone = $request->get('cell_phone');
            $student->student_Id = $request->get('student_id');
            $student->immunized_status = $request->get('immunized_status');
            $enrollupdate = EnrollmentPeriods::select('id')->where('student_profile_id', $id)->get();

            foreach ($enrollupdate as $key => $en) {
                $enroll = EnrollmentPeriods::whereId($en->id)->first();
                $startDates = $request->get('start_date');
                $endDates = $request->get('end_date');
                $grade_level = $request->get('grade');
                $enroll->start_date_of_enrollment = \Carbon\Carbon::parse($startDates[$key])->format('M d Y');
                $enroll->end_date_of_enrollment = \Carbon\Carbon::parse($startDates[$key])->format('M d Y');
                $enroll->grade_level = $grade_level[$key];
                $enroll->save();
            }
            $student->save();
            DB::commit();
            $notification = [
                'message' => 'Student Record is updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect('admin/view-student')->with($notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $notification = [
                'message' => 'Student Record is Deleted Successfully!',
                'alert-type' => 'warning',
            ];
            StudentProfile::where('id', $id)->delete();
            DB::commit();

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
}
