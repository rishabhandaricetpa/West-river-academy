<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EnrollmentPayment;
use App\Models\EnrollmentPeriods;
use App\Models\StudentProfile;
use App\Models\ConfirmationLetter;
use App\Models\TransactionsMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function view()
    {
        $students = StudentProfile::all();

        return view('admin.payment.view-payment', compact('students'));
    }

    public function edit($id)
    {
        $student = StudentProfile::find($id);
        $enrollment_periods = StudentProfile::find($id)->enrollmentPeriods()->get();

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

        return view('admin.payment.edit-payment', compact('payment_info', 'student'));
    }

    public function editPaymentStatus(Request $request, $id)
    {
        $enroll_payment = EnrollmentPayment::find($id);
        $enrollment_periods = EnrollmentPayment::find($id)->enrollment_period()->first();
        $student = StudentProfile::whereId($enrollment_periods->student_profile_id)->first();
        return view('admin.payment.edit-payment-status', compact('enroll_payment', 'enrollment_periods', 'student'));
    }

    public function update(Request $request, $payment_id)
    {
        // update enrollment payment
        try {
            DB::beginTransaction();
            $enrollment_payment = EnrollmentPayment::find($payment_id);
            $enrollment_payment->amount = $request->input('amount');
            $enrollment_payment->status = $request->input('paymentStatus');
            $enrollment_payment->transcation_id = $request->input('transcation_id');
            $enrollment_payment->payment_mode = $request->input('payment_mode');
            $enrollment_payment->save();

            // update enrollment period
            $enrollment_periods = EnrollmentPayment::find($payment_id)->enrollment_period()->first();
            $enrollment_periods->grade_level = $request->input('grade_level');
            $enrollment_periods->start_date_of_enrollment = \Carbon\Carbon::parse($request->input('start_date_of_enrollment'))->format('M d Y');
            $enrollment_periods->end_date_of_enrollment = \Carbon\Carbon::parse($request->input('end_date_of_enrollment'))->format('M d Y');
            $enrollment_payment->grade_level = $request->input('grade_level');
            $enrollment_periods->save();

             // update enrollment period in confirmation
             $transaction_data = TransactionsMethod::where('transcation_id',$enrollment_payment->transcation_id)->first();
             if($transaction_data){
                $transaction_data->status = $request->input('paymentStatus');
                $transaction_data->save();
             }
            

             // update enrollment period in confirmation
             $confirmation_letter = ConfirmationLetter::where('enrollment_period_id',$enrollment_periods->id)->first();
             $confirmation_letter->status = $request->input('paymentStatus');
             $confirmation_letter->save();
             DB::commit();

            $notification = [
                'message' => 'Record Updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
}
