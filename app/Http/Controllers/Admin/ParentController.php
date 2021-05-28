<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use App\Models\User;
use App\Models\TransactionsMethod;
use App\Models\EnrollmentPeriods;
use App\Models\UploadDocuments;
use App\Models\CustomLetterPayment;
use App\Models\CustomPayment;
use App\Models\EnrollmentPayment;
use App\Models\Graduation;
use App\Models\GraduationPayment;
use App\Models\Notarization;
use App\Models\NotarizationPayment;
use App\Models\Notification;
use App\Models\OrderPersonalConsultation;
use App\Models\ParentProfile;
use App\Models\TranscriptPayment;

use App\Models\RecordTransfer;

use DB;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the Parent dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.familyInformation.view-parent');
    }
    public function viewStudentParent($parent_id)
    {
        $parent = ParentProfile::find($parent_id);
        $allstudent = StudentProfile::where('parent_profile_id', $parent_id)->get();
        return view('admin.familyInformation.view-student-parent', compact('parent', 'allstudent'));
    }
    public function dataTable()
    {
        return datatables(ParentProfile::with(['studentProfile', 'address'])->latest()->get())->toJson();
    }
    public function deactive($id)
    {
        $parent = ParentProfile::find($id);
        if ($parent->status === 1) {
            $notification = [
                'message' => 'Parent Record is already Deactivated!',
                'alert-type' => 'Error',
            ];
            return redirect()->back()->with($notification);
        } else {
            $studentProfileData = StudentProfile::find($parent)->first();
            $parent->status = '1';
            $parent->save();
            // $studentProfileData->status = '1';
            // $studentProfileData->save();
            $notification = [
                'message' => 'Parent Record is Deactivated Successfully!',
                'alert-type' => 'Success',
            ];

            return redirect()->back()->with($notification);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.familyInformation.edit-parent', compact('parent'));
    }


    public function edit($id)
    {
        $parent = ParentProfile::find($id);
        $allstudent = StudentProfile::where('parent_profile_id', $id)->get();
        $transcations =   TransactionsMethod::where('parent_profile_id', $id)->get();
        $recordTransfer = RecordTransfer::where('parent_profile_id', $id)->get();
        //$enrollment_periods = StudentProfile::find($id)->enrollmentPeriods()->get();
        $documents = UploadDocuments::where('parent_profile_id', $id)->get();
        $payment_info = DB::table('enrollment_periods')
            ->where('student_profile_id', $id)
            ->join('enrollment_payments', 'enrollment_payments.enrollment_period_id', 'enrollment_periods.id')
            ->select(
                'enrollment_periods.enrollment_payment_id',
                'enrollment_payments.amount',
                'enrollment_payments.status',
                'enrollment_payments.transcation_id',
                'enrollment_payments.payment_mode',
                'enrollment_periods.start_date_of_enrollment',
                'enrollment_periods.end_date_of_enrollment',
                'enrollment_periods.grade_level',
                'enrollment_payments.id'
            )
            ->get();
        return view('admin.familyInformation.edit-parent', compact('parent', 'allstudent', 'transcations', 'recordTransfer', 'payment_info', 'documents'));
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
            $userdata = User::find($id);
            $userdata->name = $request->get('p1_first_name');
            // $userdata->email = $request->get('p1_email');
            $userdata->save();
            $parent = ParentProfile::find($id);
            $parent->p1_first_name = $request->get('p1_first_name');
            $parent->p1_middle_name = $request->get('p1_middle_name');
            $parent->p1_last_name = $request->get('p1_last_name');
            // $parent->p1_email = $request->get('p1_email');
            $parent->p1_cell_phone = $request->get('p1_cell_phone');
            $parent->p1_home_phone = $request->get('p1_home_phone');
            $parent->p2_first_name = $request->get('p2_first_name');
            $parent->p2_middle_name = $request->get('p2_middle_name');
            $parent->p2_email = $request->get('p2_email');
            $parent->p2_cell_phone = $request->get('p2_cell_phone');
            $parent->p2_home_phone = $request->get('p2_home_phone');
            $parent->street_address = $request->get('street_address');
            $parent->city = $request->get('city');
            $parent->state = $request->get('state');
            $parent->country = $request->get('country');
            $parent->reference = $request->get('reference');
            $parent->immunized = $request->get('immunized');
            $parent->status = $request->get('status');
            $parent->save();
            DB::commit();
            $notification = [
                'message' => 'parent Record is updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect('admin/view')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
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
                'message' => 'parent Record is Deleted Successfully!',
                'alert-type' => 'warning',
            ];
            parentProfile::where('id', $id)->delete();
            DB::commit();

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
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
    public function viewAllOrders($transcation_id, $parent_id)
    {

        $transcript_payments = TranscriptPayment::where('transcation_id', $transcation_id)->whereIn('status', ['paid', 'completed', 'approved', 'canEdit'])->get();
        /** Receiving payment history data for custom payment*/
        $customPayments = CustomPayment::with('ParentProfile')->where('transcation_id', $transcation_id)->where('status', 'paid')->get();

        /** Receiving payment history data for enrollments*/

        $enrollmentPayments = DB::table('enrollment_periods')->where('transcation_id', $transcation_id)
            ->join('enrollment_payments', 'enrollment_payments.id', 'enrollment_periods.enrollment_payment_id')
            ->join('student_profiles', 'student_profiles.id', 'enrollment_periods.student_profile_id')
            ->whereIn('enrollment_payments.status', ['active', 'paid'])
            ->get();
        /** Receiving payment history data for graduation*/

        $graduationPayments = Graduation::join('graduation_payments', 'graduation_payments.graduation_id', 'graduations.id')
            ->where('graduations.parent_profile_id', $parent_id)
            ->where('graduation_payments.transcation_id', $transcation_id)
            ->whereIn('graduations.status', ['paid', 'approved', 'completed'])
            ->join('student_profiles', 'student_profiles.id', 'graduations.student_profile_id')
            ->get();

        /** Receiving payment history data for notirization*/
        $notirizationPayments = NotarizationPayment::with('notarization', 'ParentProfile')->where('transcation_id', $transcation_id)->get();

        /** Receiving payment history data for order personal consultation*/

        $orderConsulationPayments = OrderPersonalConsultation::with('parent')->where('transcation_id', $transcation_id)->get();

        $customLetter = CustomLetterPayment::with('ParentProfile')
            ->where('transcation_id', $transcation_id)
            ->where('status', 'paid')
            ->get();
        return view('admin.familyInformation.view-all-orders', compact('transcript_payments', 'customPayments', 'enrollmentPayments', 'graduationPayments', 'notirizationPayments', 'orderConsulationPayments', 'customLetter'));
    }
}
