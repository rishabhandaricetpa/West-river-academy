<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use App\Models\User;
use App\Models\TransactionsMethod;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Apostille;
use App\Models\EnrollmentPeriods;
use App\Models\UploadDocuments;
use App\Models\CustomLetterPayment;
use App\Models\CustomPayment;
use App\Models\OrderPostage;
use App\Models\EnrollmentPayment;
use App\Models\Graduation;
use App\Models\GraduationPayment;
use App\Models\Notarization;
use App\Models\NotarizationPayment;
use App\Models\Notification;
use App\Models\OrderPersonalConsultation;
use App\Models\ParentProfile;
use App\Models\Notes;
use App\Models\TranscriptPayment;
use Illuminate\Support\Facades\Hash;

use App\Models\RecordTransfer;
use App\Models\Transcript;
use Auth;
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


    public function createParent(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->get('parent1_first_name'),
                'email' => $request->get('parent1_email'),
                'password' => Hash::make($request->get('parent1_cell_phone')),
                'email_verified_at' => now(),
            ]);
            $user->save();
            $parent =  ParentProfile::create([
                'user_id' => $user->id,
                'p1_first_name' => $request->get('parent1_first_name'),
                'p1_middle_name' => $request->get('parent1_middle_name'),
                'p1_last_name' => $request->get('parent1_last_name'),
                'p1_email' => $request->get('parent1_email'),
                'p1_cell_phone' => $request->get('parent1_cell_phone'),
                'p1_home_phone' =>  $request->get('parent1_home_phone'),
                'p2_first_name' => $request->get('parent2_first_name'),
                'p2_middle_name' => $request->get('parent2_middle_name'),
                'p2_last_name' => $request->get('parent2_last_name'),
                'p2_email' => $request->get('parent2_email'),
                'p2_cell_phone' => $request->get('parent2_cell_phone'),
                'p2_home_phone' =>  $request->get('parent2_home_phone'),
                'street_address' => $request->get('parent1_street_address'),
                'city' => $request->get('parent1_city'),
                'state' =>  $request->get('parent1_state'),
                'zip_code' =>  $request->get('parent2_zip_code'),
                'country' => $request->get('parent2_country'),
                'reference' =>  $request->get('reference'),
                'immunized' => $request->get('parent_status'),
            ]);
            $parent->save();

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'success', 'message' => 'Record updated successfully']);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            report($e);
            if ($request->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Failed to update Record']);
            }
        }
    }
    public function deactive(Request $request)
    {
        $parent = ParentProfile::find($request->get('parent_id'));
        $parent->status = $request->get('parent_status');
        $parent->save();
        $notification = [
            'message' => 'Parent Record is Inactive!',
            'alert-type' => 'Success',
        ];
        return redirect()->back()->with($notification);
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
        $student_ids = StudentProfile::where('parent_profile_id', $id)->select('id')->get()->toArray();
        $countries = Country::all();

        $transcations =   TransactionsMethod::where('parent_profile_id', $id)->get();
        $getNotes = Notes::where('parent_profile_id', $id)->get();
        $recordTransfer = RecordTransfer::where('parent_profile_id', $id)->get();
        //$enrollment_periods = StudentProfile::find($id)->enrollmentPeriods()->get();
        $documents = UploadDocuments::where('parent_profile_id', $id)->get();
        $payment_info = DB::table('enrollment_periods')
            ->whereIn('student_profile_id', $student_ids)
            ->join('enrollment_payments', 'enrollment_payments.id', 'enrollment_periods.enrollment_payment_id')
            ->select(
                'enrollment_periods.created_at',
                'enrollment_periods.enrollment_payment_id',
                'enrollment_payments.amount',
                'enrollment_payments.status',
                'enrollment_payments.transcation_id',
                'enrollment_payments.payment_mode',
                'enrollment_periods.start_date_of_enrollment',
                'enrollment_periods.end_date_of_enrollment',
                'enrollment_periods.grade_level',
                'enrollment_payments.id',
                'enrollment_periods.student_profile_id'
            )
            ->get();
        $payment_nonpaid = $payment_info->where('status', 'pending');
        return view('admin.familyInformation.edit-parent', compact('parent', 'allstudent', 'transcations', 'recordTransfer', 'payment_info', 'documents', 'getNotes', 'payment_nonpaid', 'countries'));
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
            $parent = ParentProfile::find($id);
            $userdata = User::find($parent->user_id);
            $userdata->name = $request->get('p1_first_name');
            $userdata->email = $request->get('p1_email');
            $userdata->save();
            $parent = ParentProfile::find($id);
            $parent->p1_first_name = $request->get('p1_first_name');
            $parent->p1_middle_name = $request->get('p1_middle_name');
            $parent->p1_last_name = $request->get('p1_last_name');
            $parent->p1_email = $request->get('p1_email');
            $parent->zip_code = $request->get('zip_code');
            $parent->p1_cell_phone = $request->get('p1_cell_phone');
            $parent->p1_home_phone = $request->get('p1_home_phone');

            $parent->street_address = $request->get('street_address');
            $parent->city = $request->get('city');
            $parent->state = $request->get('state');
            $parent->country = $request->get('country');
            $parent->reference = $request->get('reffered');
            $parent->immunized = $request->get('immunized');


            $parent->p2_first_name = $request->get('p2_first_name');
            $parent->p2_last_name = $request->get('p2_last_name');
            $parent->p2_middle_name = $request->get('p2_middle_name');
            $parent->p2_email = $request->get('p2_email');
            $parent->p2_cell_phone = $request->get('p2_cell_phone');
            $parent->p2_home_phone = $request->get('p2_home_phone');
            $parent->p2_street_address = $request->get('p2_street_address');
            $parent->p2_city = $request->get('p2_city');
            $parent->p2_state = $request->get('p2_state');
            $parent->p2_country = $request->get('p2_country');
            $parent->p2_zip_code = $request->get('p2_zip_code');

            $parent->status = 0;
            $parent->save();
            DB::commit();
            $notification = [
                'message' => 'parent Record is updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            report($e);
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

            ParentProfile::where('id', $id)->delete();
            User::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.view.parent');
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            $notification = [
                'message' => 'Failed to delete Record!',
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

    //create orders in family enrollments
    public function createOrders(Request $request)
    {
        try {
            DB::beginTransaction();
            switch ($request->get('order_detail_val')) {
                case 'order-detail_enrollment':
                    $transction = new TransactionsMethod();
                    $transction->transcation_id   = substr(uniqid(), 0, 12);
                    $transction->payment_mode = "admin created";
                    $transction->parent_profile_id = $request->get('parent_id');
                    $transction->amount = $request->get('amount');
                    $transction->status = $request->get('enrollment_status');
                    $transction->save();

                    $enroll_payment = new EnrollmentPayment();
                    $enroll_payment->enrollment_period_id = $request->get('enrollment_for');
                    $enroll_payment->payment_mode = "admin created";
                    $enroll_payment->transcation_id = $transction->transcation_id;
                    $enroll_payment->status = $request->get('enrollment_status');
                    $enroll_payment->amount = $request->get('amount');
                    $enroll_payment->save();

                    $enroll = EnrollmentPeriods::whereId($request->get('enrollment_for'))->first();
                    $enroll->enrollment_payment_id = $enroll_payment->id;
                    $enroll->save();
                    break;

                case 'graduation':

                    break;
                case 'order-detail_transcript':
                    for ($x = 1; $x <= $request->get('quantity'); $x++) {
                        $transcript_type = "transcript";
                        $transcript = new Transcript();
                        $transcript->parent_profile_id   = $request->get('parent_id');
                        $transcript->student_profile_id = $request->get('student_id_val');
                        $transcript->period = $request->get('transcript_period');
                        $transcript->status = $request->get('status');
                        $transcript->save();

                        $transction = new TransactionsMethod();
                        $transction->transcation_id   = substr(uniqid(), 0, 12);
                        $transction->payment_mode = "admin created";
                        $transction->parent_profile_id = $request->get('parent_id');
                        $transction->amount = $request->get('amount');
                        $transction->status = $request->get('status');
                        $transction->save();

                        $transcript_payment = new TranscriptPayment();
                        $transcript_payment->transcript_id   =  $transcript->id;
                        $transcript_payment->amount = $request->get('amount');
                        $transcript_payment->status = $request->get('status');
                        $transcript_payment->transcation_id = $transction->transcation_id;
                        $transcript_payment->payment_mode = "admin created";
                        $transcript_payment->save();

                        if (!Cart::where('item_id', $transcript->id)->where('item_type', $transcript_type)->exists()) {
                            Cart::create([
                                'item_type' => $transcript_type,
                                'item_id' => $transcript->id,
                                'parent_profile_id' => $request->get('parent_id'),
                            ]);
                        }
                    }
                    break;
                case 'custom_payments':

                    break;

                case 'order-detail_OrderPostage':
                    $charge = Country::where('country', $request->get('postage_country'))->select('postage_charges')->first();
                    $status = ($request->get('paymentDetails') == 'pending') ? 'pending' : 'paid';
                    for ($x = 1; $x <= $request->get('postage_quantity'); $x++) {
                        $postage_type = "postage";
                        $postage = new OrderPostage();
                        $postage->parent_profile_id   = $request->get('parent_value');
                        $postage->amount = $charge->postage_charges;
                        $postage->paying_for = $request->get('paying_for');
                        $postage->type_of_payment = 'Postage';
                        $postage->transcation_id   = $request->get('postage_transaction_id');
                        $postage->payment_mode = $request->get('postage_payment_mode');
                        $postage->status = $status;
                        $postage->save();

                        $transction = new TransactionsMethod();
                        if ($status == 'paid') {
                            $transction->transcation_id   = $postage->transcation_id;
                        }
                        $transction->transcation_id   = substr(uniqid(), 0, 12);
                        $transction->payment_mode = $request->get('postage_payment_mode');
                        $transction->parent_profile_id = $request->get('parent_value');
                        $transction->amount = $charge->postage_charges;
                        $transction->status = $status;
                        $transction->save();

                        if (!Cart::where('item_id', $request->get('parent_value'))->where('item_type', $postage_type)->exists()) {
                            Cart::create([
                                'item_type' => $postage_type,
                                'item_id' =>  $request->get('parent_value'),
                                'parent_profile_id' => $request->get('parent_value'),
                            ]);
                        }
                    }
                    break;
                case 'order-detail_Notarization':
                    $notarization_type = "notarization";
                    $status = ($request->get('noatrization_status') == 'pending') ? 'pending' : 'paid';
                    $notarization = new Notarization();
                    $notarization->parent_profile_id   = $request->get('parent_profile_id');
                    $notarization->additional_message = $request->get('notar_notes');
                    $notarization->postage_option = 'Notarization';
                    $notarization->country = $request->get('shipping_country');
                    $notarization->status = $request->get('noatrization_status');
                    $notarization->save();

                    $transction = new TransactionsMethod();
                    if ($status == 'paid') {
                        $transction->transcation_id   =   $request->get('notar_transaction_id');
                    } else {
                        $transction->transcation_id   = substr(uniqid(), 0, 12);
                    }
                    $transction->payment_mode = $request->get('notar_payment_mode');
                    $transction->parent_profile_id = $request->get('parent_profile_id');
                    $transction->amount = $request->get('notar_total');
                    $transction->status = $request->get('noatrization_status');
                    $transction->save();
                    $notarization_payment = new NotarizationPayment();
                    $notarization_payment->parent_profile_id   = $request->get('parent_profile_id');
                    $notarization_payment->notarization_id =  $notarization->id;
                    $notarization_payment->amount = $request->get('notar_total');
                    $notarization_payment->status = $status;
                    $notarization_payment->pay_for = "notarization";
                    $notarization_payment->save();

                    if (!Cart::where('item_type', 'notarization')->exists()) {
                        Cart::create([
                            'item_type' => 'notarization',
                            'item_id' => $notarization->id,
                            'parent_profile_id' => $request->get('parent_profile_id'),
                        ]);
                    }

                    break;
                case 'order-detail_ApostilePackage':

                    $apotille_type = "apostille";
                    $status = ($request->get('apostille_status') == 'pending') ? 'pending' : 'paid';
                    $apostille = new Apostille();
                    $apostille->parent_profile_id   = $request->get('parent_profile_id');
                    $apostille->additional_message = $request->get('apostille_notes');
                    $apostille->postage_option = 'Apostille';
                    $apostille->country = $request->get('shipp_country');
                    $apostille->apostille_country = $request->get('apostille_country');
                    $apostille->status = $status;
                    $apostille->save();

                    $transction = new TransactionsMethod();
                    if ($status == 'paid') {
                        $transction->transcation_id   =   $request->get('apostille_transaction_id');
                    } else {
                        $transction->transcation_id   = substr(uniqid(), 0, 12);
                    }
                    $transction->payment_mode = $request->get('apostille_payment_mode');
                    $transction->parent_profile_id = $request->get('parent_profile_id');
                    $transction->amount = $request->get('apostille_total');
                    $transction->status = $status;
                    $transction->save();

                    $notarization_payment = new NotarizationPayment();
                    $notarization_payment->parent_profile_id   = $request->get('parent_profile_id');
                    $notarization_payment->notarization_id =  $apostille->id;
                    $notarization_payment->amount = $request->get('apostille_total');
                    $notarization_payment->status = $status;
                    $notarization_payment->pay_for = "apostille";
                    $notarization_payment->save();

                    if (!Cart::where('item_type', 'apostille')->exists()) {
                        Cart::create([
                            'item_type' => 'apostille',
                            'item_id' => $apostille->id,
                            'parent_profile_id' => $request->get('parent_profile_id'),
                        ]);
                    }

                    break;
                case 'custom_letter':

                    break;
                case 'order-detail_OrderConsultaion':
                    $status = ($request->get('paymentDetails') == 'pending') ? 'pending' : 'paid';
                    $consultation_type = "order_consultation";
                    $consultation = new OrderPersonalConsultation();
                    $consultation->parent_profile_id   = $request->get('p1_profile_id');
                    $consultation->preferred_language = $request->get('language');
                    $consultation->amount = $request->get('consul_amount');
                    $consultation->consulting_about = $request->get('consul_paying_for');
                    $consultation->paying_for = $request->get('consul_paying_for');
                    $consultation->type_of_payment = 'Order a personal consultation';
                    $consultation->transcation_id   = $request->get('consul_transaction_id');
                    $consultation->payment_mode = $request->get('consul_payment_mode');
                    $consultation->status = $status;
                    $consultation->save();
                    $transction = new TransactionsMethod();
                    if ($status == 'paid') {
                        $transction->transcation_id   = $consultation->transcation_id;
                    }
                    $transction->transcation_id   = substr(uniqid(), 0, 12);
                    $transction->payment_mode =  $request->get('consul_payment_mode');
                    $transction->parent_profile_id = $request->get('p1_profile_id');
                    $transction->amount = $request->get('consul_amount');
                    $transction->status = $status;
                    $transction->save();

                    if (!Cart::where('item_id', $request->get('p1_profile_id'))->where('item_type', $consultation_type)->exists()) {
                        Cart::create([
                            'item_type' => $consultation_type,
                            'item_id' =>  $request->get('p1_profile_id'),
                            'parent_profile_id' => $request->get('p1_profile_id'),
                        ]);
                    }

                    break;
                default:
                    break;
            }
            DB::commit();
            $notification = [
                'message' => 'parent Record is order Successfully!',
                'alert-type' => 'warning',
            ];
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            dd($e);
            report($e);
            DB::rollBack();

            return redirect()->back();
        }
    }

    //fetch postage charges according to the country
    public function getCountryVal(Request $request)
    {
        $charge = Country::where('country', $request->get('countryname'))->select('postage_charges')->first();
        return $charge->postage_charges;
    }
    public function getTranscriptval(Request $request)
    {
        $getPaidData = Transcript::where('student_profile_id', $request->get('student_id'))->whereIn('status', ['approved', 'paid', 'completed', 'canEdit'])->get();
        if (count($getPaidData) > 0) {
            return 85;
        } else {
        }
        return 25;
    }
}
