<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FeeStructureType;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\StudentProfile;
use App\Models\User;
use App\Models\TransactionsMethod;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Apostille;
use App\Models\EnrollmentPeriods;
use App\Models\UploadDocuments;
use App\Models\CustomLetterPayment;
use App\Models\ConfirmationLetter;
use App\Models\CustomPayment;
use App\Models\Dashboard;
use App\Models\OrderPostage;
use App\Models\FeesInfo;
use App\Models\EnrollmentPayment;
use App\Models\Graduation;
use App\Models\Notarization;
use App\Models\NotarizationPayment;
use App\Models\OrderPersonalConsultation;
use App\Models\ParentProfile;
use App\Models\Notes;
use App\Models\TranscriptPayment;
use Illuminate\Support\Facades\Hash;

use App\Models\RecordTransfer;
use App\Models\RepresentativeGroup;
use App\Models\Transcript;
use Auth;
use Database\Seeders\FeesInfoSeeder;
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

    public function _filter($request)
    {
        $input                  = $request->all();
        $parentProfile          = ParentProfile::select('parent_profiles.*')
            ->leftJoin('student_profiles AS sp', 'sp.parent_profile_id', 'parent_profiles.id')
            ->leftJoin('enrollment_periods AS ep', 'ep.student_profile_id', 'sp.id')
            ->with(['studentProfile', 'address']);
        if ($input['first_name'])
            $parentProfile->where(function ($query) use ($input) {
                $query->where('sp.first_name', $input['first_name']);
                $query->orWhere('parent_profiles.p1_first_name', $input['first_name']);
            });

        if ($input['last_name'])
            $parentProfile->where(function ($query) use ($input) {
                $query->where('sp.last_name', $input['last_name']);
                $query->orWhere('parent_profiles.p1_last_name', $input['last_name']);
            });

        if ($input['email'])
            $parentProfile->where(function ($query) use ($input) {
                $query->where('sp.email', $input['email']);
                $query->orWhere('parent_profiles.p1_email', $input['email']);
            });

        if ($input['dob'])
            $parentProfile->whereRaw('DATE(sp.d_o_b) = "' . \Carbon\Carbon::parse($input['dob'])->format('Y-m-d') . '"');

        if ($input['status'] != '')
            $parentProfile->where('parent_profiles.status', $input['status']);

        if ($input['country'])
            $parentProfile->where('country', $input['country']);

        if ($input['refered_by'])
            $parentProfile->whereRaw('LOWER(reference) = "' . strtolower($input['refered_by'] . '"'));

        if ($input['enroll_date'])
            $parentProfile->whereRaw('DATE(start_date_of_enrollment) = "' . \Carbon\Carbon::parse($input['enroll_date'])->format('Y-m-d') . '"');

        if ($input['grade'])
            $parentProfile->where('grade_level', $input['grade']);

        return $parentProfile->groupBy('parent_profiles.id')->latest()->get();
    }
    public function dataTable(Request $request)
    {
        $query  = $request->query() ? self::_filter($request) : ParentProfile::with(['studentProfile', 'address'])->latest()->get();
        return datatables($query)->toJson();
    }


    public function createParent(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->get('parent1_first_name'),
                'email' => $request->get('parent1_email'),
                'password' => Hash::make('westriveracademy'),
                'email_verified_at' => date("Y-m-d H:i:s"),
            ]);

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
            $billinAddress = Address::updateOrCreate(
                ['parent_profile_id' => $parent->id],
                [
                    'parent_profile_id' => $parent->id,
                    'billing_street_address' => $request->get('parent1_street_address'),
                    'billing_city' => $request->get('parent1_city'),
                    'billing_state' => $request->get('parent1_state'),
                    'billing_zip_code' => $request->get('parent2_zip_code'),
                    'billing_country' => $request->get('parent2_country'),
                    'email' => $request->get('parent1_email'),
                ]
            );

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'success', 'message' => 'Record updated successfully']);
            }
        } catch (\Exception $e) {
            dd($e);
            report($e);
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
        $parent = ParentProfile::where('id', $id)->first();
        $allstudent = StudentProfile::where('parent_profile_id', $id)->get();
        $countries = Country::all();
        $studentData = $parent->studentProfile()->get();
        $studentId = collect($studentData)->pluck('id');
        $transcations =   Cart::where('parent_profile_id', $id)->get();
        $getNotes = Notes::where('parent_profile_id', $id)->get();
        $recordTransfer = RecordTransfer::where('parent_profile_id', $id)->get();
        //$enrollment_periods = StudentProfile::find($id)->enrollmentPeriods()->get();
        $documents = UploadDocuments::where('parent_profile_id', $id)->get();
        $payment_info = DB::table('enrollment_periods')
            ->whereIn('student_profile_id', $studentId)
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

        $parent->rep_status == 'active' ?  $rep_group = RepresentativeGroup::where('id', $parent->representative_group_id)->first() : $rep_group = '';


        $all_rep_groups = RepresentativeGroup::all();
        // $detail_order_lists = Dashboard::where('parent_profile_id',  $parent->id)->get();
        $detail_order_lists = TransactionsMethod::where('parent_profile_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.familyInformation.edit-parent', compact('parent', 'allstudent', 'transcations', 'recordTransfer', 'payment_info', 'documents', 'getNotes', 'payment_nonpaid', 'countries', 'rep_group', 'all_rep_groups', 'detail_order_lists'));
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
                    if ($request->get('status') == 'paid') {
                        $transction = new TransactionsMethod();
                        $transction->transcation_id   = $request->get('enrollment_transction_id');
                        $transction->payment_mode = $request->get('enrollment_pay_mode');
                        $transction->parent_profile_id = $request->get('parent_id');
                        $transction->amount = $request->get('amount');
                        $transction->status = $request->get('status');
                        $transction->save();
                    }

                    $enrollment_period = new EnrollmentPeriods();
                    $enrollment_period->student_profile_id = $request->get('student_id');
                    $enrollment_period->start_date_of_enrollment = \Carbon\Carbon::parse($request->get('start_date'));
                    $enrollment_period->end_date_of_enrollment = \Carbon\Carbon::parse($request->get('end_date'));
                    $enrollment_period->grade_level = $request->get('grade');
                    $enrollment_period->type = $request->get('type');

                    $enrollment_period->save();

                    if ($request->get('status') == 'pending') {
                        $cart = new Cart();
                        $cart->item_type = 'enrollment_period';
                        $cart->item_id = $enrollment_period->id;
                        $cart->parent_profile_id = $request->get('parent_id');
                        $cart->save();
                    }
                    $enroll_payment = new EnrollmentPayment();
                    $enroll_payment->enrollment_period_id  = $enrollment_period->id;
                    $enroll_payment->amount = $request->get('amount');
                    $enroll_payment->status = $request->get('status');
                    if ($enroll_payment->status == 'paid') {
                        $enroll_payment->transcation_id = $request->get('enrollment_transction_id');
                        $enroll_payment->payment_mode =  $enroll_payment->enrollment_pay_mode;
                        $enrollment_period->enrollment_payment_id = $enroll_payment->id;
                    }

                    $enroll_payment->save();
                    // update enrollment period with enrollement payment_id
                    $enrollment_period->enrollment_payment_id = $enroll_payment->id;
                    $enrollment_period->save();

                    // add in confirmation letter

                    $confirmationLetter = new ConfirmationLetter();
                    $confirmationLetter->student_profile_id = $request->get('student_id');
                    $confirmationLetter->status = $request->get('status');
                    $confirmationLetter->enrollment_period_id = $enrollment_period->id;
                    $confirmationLetter->parent_profile_id = $request->get('parent_id');
                    $confirmationLetter->save();
                    break;
                case 'order-detail_transcript':

                    //add one transaction entry if the status is paid
                    if ($request->get('status') == 'paid') {
                        $transction = new TransactionsMethod();
                        $transction->transcation_id   = $request->get('transcript_transaction_id') ? $request->get('transcript_transaction_id')  : substr(uniqid(), 0, 12);
                        $transction->payment_mode = $request->get('transcript_pay_mode') ? $request->get('transcript_pay_mode')  : '';
                        $transction->parent_profile_id = $request->get('parent_id');
                        $transction->amount = $request->get('total_val');
                        $transction->status = $request->get('status');
                        $transction->save();
                    }

                    //create the entry to transcript table according to the quantity 

                    for ($x = 1; $x <= $request->get('quantity'); $x++) {

                        $transcript_type = "transcript";
                        $transcript = new Transcript();
                        $transcript->parent_profile_id   = $request->get('parent_id');
                        $transcript->student_profile_id = $request->get('student_id_val');
                        $transcript->period = $request->get('transcript_period');
                        $transcript->status = $request->get('status');
                        $transcript->save();

                        $transcript_payment = new TranscriptPayment();
                        $transcript_payment->transcript_id   =  $transcript->id;
                        $transcript_payment->amount = $request->get('amount');
                        $transcript_payment->status = $request->get('status');
                        $transcript_payment->transcation_id =  $request->get('status') == 'paid' ? $transction->id  : '';
                        $transcript_payment->payment_mode = $request->get('transcript_pay_mode');
                        $transcript_payment->save();

                        //add transacript to the cart if there are two transcript orderd
                        if ($request->get('status') == 'pending') {
                            if (!Cart::where('item_id', $transcript->id)->where('item_type', $transcript_type)->exists()) {
                                Cart::create([
                                    'item_type' => $transcript_type,
                                    'item_id' => $transcript->id,
                                    'parent_profile_id' => $request->get('parent_id'),
                                ]);
                            }
                        }
                    }

                    break;
                case 'order-detail_CustomLetter':

                    CustomLetterPayment::whereNull('transcation_id')->where('status', 'pending')->where('parent_profile_id', $request->get('parent_id'))->delete();

                    $custom_payment = new CustomLetterPayment();
                    $custom_payment->parent_profile_id = $request->get('parent_id');
                    $custom_payment->amount = $request->get('custom_letter_amount');
                    $custom_payment->paying_for = $request->get('custom_letter_paying');
                    $custom_payment->type_of_payment = 'Custom Letter';
                    $custom_payment->transcation_id = $request->get('custom_letter_transction');
                    $custom_payment->payment_mode = $request->get('custom_letter_payment_mode');
                    $custom_payment->status = $request->get('custom_letter_status');
                    $custom_payment->save();
                    if (
                        !empty($request->get('custom_letter_payment_mode'))
                    ) {

                        $transction = new TransactionsMethod();
                        $transction->transcation_id   = $request->get('custom_letter_transction') ? $request->get('custom_letter_transction')  : substr(uniqid(), 0, 12);
                        $transction->payment_mode =  $request->get('custom_letter_payment_mode') ? $request->get('custom_letter_payment_mode')  : 'pending';
                        $transction->parent_profile_id = $request->get('parent_id');
                        $transction->amount = $request->get('custom_letter_amount');
                        $transction->status = $request->get('custom_letter_status');
                        $transction->save();
                    }
                    if ($request->get('custom_letter_status') == 'pending') {
                        if (!Cart::where('item_type', 'custom_letter')->exists()) {
                            Cart::create([
                                'item_type' => 'custom_letter',
                                'item_id' => $request->get('parent_id'),
                                'parent_profile_id' => $request->get('parent_id'),
                            ]);
                        }
                    }
                    break;

                case 'order-detail_OrderPostage':
                    OrderPostage::whereNull('transcation_id')->where('status', 'pending')->where('parent_profile_id', $request->get('parent_value'))->delete();
                    $charge = Country::where('country', $request->get('postage_country'))->select('postage_charges')->first();
                    $status = ($request->get('paymentDetails') == 'pending') ? 'pending' : 'paid';
                    if ($status == 'paid') {

                        $transction = new TransactionsMethod();
                        $transction->transcation_id   = $request->get('postage_transaction_id');
                        $transction->payment_mode = $request->get('postage_payment_mode');
                        $transction->parent_profile_id = $request->get('parent_value');
                        $transction->amount =  $request->get('postage_total');
                        $transction->status = $status;
                        $transction->save();
                    }
                    $postage_type = "postage";
                    $postage = new OrderPostage();
                    $postage->parent_profile_id   = $request->get('parent_value');
                    $postage->amount =  $request->get('postage_total');
                    $postage->paying_for = $request->get('paying_for');
                    $postage->type_of_payment = 'Postage';
                    $postage->transcation_id   = $request->get('postage_transaction_id');
                    $postage->payment_mode = $request->get('postage_payment_mode');
                    $postage->status = $status;
                    $postage->save();
                    if ($status == 'pending') {
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

                    $clearpendingPayments = NotarizationPayment::whereNull('transcation_id')
                        ->where('pay_for', 'notarization')->where('status', 'pending')
                        ->where('parent_profile_id', $request->get('parent_profile_id'))->first();
                    if ($clearpendingPayments) {
                        $deletedata = Notarization::where('id', $clearpendingPayments->notarization_id)->where('status', 'pending')->where('parent_profile_id', $request->get('parent_profile_id'))->delete();
                        $clearpendingPayments = NotarizationPayment::whereNull('transcation_id')
                            ->where('pay_for', 'notarization')->where('status', 'pending')
                            ->where('parent_profile_id', $request->get('parent_profile_id'))->delete();
                    }

                    $total_notar = $request->get('notar_amount') + $request->get('shipping_amount');
                    $notarization_type = "notarization";
                    $status = ($request->get('noatrization_status') == 'pending') ? 'pending' : 'paid';
                    if ($status == 'paid') {
                        $transction = new TransactionsMethod();
                        $transction->transcation_id   =   $request->get('notar_transaction_id');
                        $transction->payment_mode = $request->get('notar_payment_mode');
                        $transction->parent_profile_id = $request->get('parent_profile_id');
                        $transction->amount = $total_notar;
                        $transction->status = $request->get('noatrization_status');
                        $transction->save();
                    }

                    $notarization = new Notarization();
                    $notarization->parent_profile_id   = $request->get('parent_profile_id');
                    $notarization->additional_message = $request->get('notar_notes');
                    $notarization->postage_option = 'Notarization';
                    $notarization->country = $request->get('shipping_country');
                    $notarization->status = $request->get('noatrization_status');
                    $notarization->save();


                    $notarization_payment = new NotarizationPayment();
                    $notarization_payment->parent_profile_id   = $request->get('parent_profile_id');
                    $notarization_payment->notarization_id =  $notarization->id;
                    $notarization_payment->amount = $total_notar;
                    $notarization_payment->status = $status;
                    $notarization_payment->pay_for = "notarization";
                    $notarization_payment->save();

                    if ($status == 'pending') {
                        Cart::updateOrCreate(
                            [
                                'parent_profile_id' => $request->get('parent_profile_id'),
                                'item_type' => 'notarization',
                            ],
                            [
                                'item_type' => 'notarization',
                                'item_id' => $notarization->id,
                                'parent_profile_id' => $request->get('parent_profile_id'),
                            ]
                        );
                    }
                    break;
                case 'order-detail_ApostilePackage':

                    $clearpendingPayments = NotarizationPayment::whereNull('transcation_id')
                        ->where('pay_for', 'apostille')->where('status', 'pending')
                        ->where('parent_profile_id', $request->get('parent_profile_id'))->first();
                    if ($clearpendingPayments) {
                        $deletedata = Apostille::where('id', $clearpendingPayments->apostille_id)->where('status', 'pending')->where('parent_profile_id', $request->get('parent_profile_id'))->delete();
                        $clearpendingPayments = NotarizationPayment::whereNull('transcation_id')
                            ->where('pay_for', 'apostille')->where('status', 'pending')
                            ->where('parent_profile_id', $request->get('parent_profile_id'))->delete();
                    }





                    // $clearpendingPayments->delete();

                    $apotille_type = "apostille";
                    $status = ($request->get('apostille_status') == 'pending') ? 'pending' : 'paid';
                    $amount_total = $request->get('apostille_amount') + $request->get('ship_amount');

                    if ($status == 'paid') {
                        $transction = new TransactionsMethod();
                        $transction->transcation_id   =   $request->get('apostille_transaction_id');
                        $transction->payment_mode = $request->get('apostille_payment_mode');
                        $transction->parent_profile_id = $request->get('parent_profile_id');
                        $transction->amount = $amount_total;
                        $transction->status = $status;
                        $transction->save();
                    }

                    $apostille = new Apostille();
                    $apostille->parent_profile_id   = $request->get('parent_profile_id');
                    $apostille->additional_message = $request->get('apostille_notes');
                    $apostille->postage_option = 'Apostille';
                    $apostille->country = $request->get('shipp_country');
                    $apostille->apostille_country = $request->get('apostille_country');
                    $apostille->status = $status;
                    $apostille->save();

                    $notarization_payment = new NotarizationPayment();
                    $notarization_payment->parent_profile_id   = $request->get('parent_profile_id');
                    $notarization_payment->apostille_id =  $apostille->id;
                    $notarization_payment->amount = $amount_total;
                    $notarization_payment->status = $status;
                    $notarization_payment->pay_for = "apostille";
                    $notarization_payment->save();

                    if ($status == 'pending') {
                        Cart::updateOrCreate(
                            [
                                'parent_profile_id' => $request->get('parent_profile_id'),
                                'item_type' => 'apostille',
                            ],
                            [
                                'item_type' => 'apostille',
                                'item_id' => $apostille->id,
                                'parent_profile_id' => $request->get('parent_profile_id'),
                            ]
                        );
                    }

                    break;
                case 'order-detail_CustomPayment':
                    CustomPayment::whereNull('transcation_id')->where('status', 'pending')->where('parent_profile_id', $request->get('parent_id'))->delete();
                    $custom_payment = new CustomPayment();
                    $custom_payment->parent_profile_id = $request->get('parent_id');
                    $custom_payment->amount = $request->get('custom_amount');
                    $custom_payment->paying_for = $request->get('custom_paying_for');
                    $custom_payment->type_of_payment = 'Custom Payments';
                    $custom_payment->transcation_id = $request->get('custom_transcation');
                    $custom_payment->payment_mode = $request->get('custom_payment_mode');
                    $custom_payment->status = $request->get('custom_status');
                    $custom_payment->save();
                    if (
                        !empty($request->get('custom_payment_mode'))
                    ) {
                        $transction = new TransactionsMethod();
                        $transction->transcation_id   = $request->get('custom_transcation') ? $request->get('custom_transcation')  : substr(uniqid(), 0, 12);
                        $transction->payment_mode = $request->get('custom_payment_mode') ? $request->get('custom_payment_mode')  : 'pending';
                        $transction->parent_profile_id = $request->get('parent_id');
                        $transction->amount = $request->get('custom_amount');
                        $transction->status = $request->get('custom_status');
                        $transction->save();
                    }
                    if ($request->get('custom_status') == 'pending') {
                        if (!Cart::where('item_type', 'custom')->exists()) {
                            Cart::create([
                                'item_type' => 'custom',
                                'item_id' => $request->get('parent_id'),
                                'parent_profile_id' => $request->get('parent_id'),
                            ]);
                        }
                    }

                    break;
                case 'order-detail_OrderConsultaion':

                    $clearpendingPayments = OrderPersonalConsultation::whereNull('transcation_id')->where('status', 'pending')->where('parent_profile_id', $request->get('p1_profile_id'))->delete();
                    $status = ($request->get('paymentDetails') == 'pending') ? 'pending' : 'paid';
                    if ($status == 'paid') {
                        $transction = new TransactionsMethod();
                        $transction->transcation_id   = $request->get('consul_transaction_id');
                        $transction->payment_mode =  $request->get('consul_payment_mode');
                        $transction->parent_profile_id = $request->get('p1_profile_id');
                        $transction->amount = $request->get('consul_amount');
                        $transction->status = $status;
                        $transction->save();
                    }
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

                    if ($status) {
                        if (!Cart::where('item_type', $consultation_type)->exists()) {
                            Cart::create([
                                'item_type' => $consultation_type,
                                'item_id' =>  $request->get('p1_profile_id'),
                                'parent_profile_id' => $request->get('p1_profile_id'),
                            ]);
                        }
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
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
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
            $transcript_fee = FeesInfo::getFeeAmount('additional_transcript');
            return $transcript_fee;
        } else {
            $transcript_fee = FeesInfo::getFeeAmount('transcript');
            return $transcript_fee;
        }
    }
    public function  calculateType(Request $request)
    {
        $selectedStartDate = \Carbon\Carbon::parse($request->start_date);
        $selectedEndDate = \Carbon\Carbon::parse($request->end_date);
        $type = $selectedStartDate->diffInMonths($selectedEndDate) > 7 ? 'annual' : 'half';
        $amount = $type == 'annual' ? '375' : '50';
        return response()->json(['type' => $type, 'amount' => $amount]);
    }

    public function editAddress(Request $request)
    {
        ParentProfile::where('id', $request->parent_address_id)->updateOrCreate(
            ['id' => $request->parent_address_id],
            [
                'street_address' => $request->billing_street_address,
                'city' => $request->billing_city,
                'state' => $request->billing_state,
                'zip_code' => $request->billing_zip_code,
                'country' => $request->billing_country,
                'p1_email' => $request->parent1_email
            ]
        );
        Address::where('parent_profile_id', $request->parent_address_id)->updateOrCreate(
            ['parent_profile_id' => $request->parent_address_id],
            [
                'billing_street_address' => $request->billing_street_address,
                'billing_city' => $request->billing_city,
                'billing_state' => $request->billing_state,
                'billing_zip_code' => $request->billing_zip_code,
                'billing_country' => $request->billing_country,
                'email' => $request->parent1_email,
                'shipping_street_address' => $request->shipping_street_address2,
                'shipping_city' => $request->shipping_city2,
                'shipping_state' => $request->shipping_state2,
                'shipping_zip_code' => $request->shipping_zip_code2,
                'shipping_country' => $request->shipping_country2,

            ]

        );
    }
    public function addTranscript(Request $request)
    {    //add one transaction entry if the status is paid
        if ($request->get('status') == 'paid') {
            $transction = new TransactionsMethod();
            $transction->transcation_id   = $request->get('transcript_transaction_id') ? $request->get('transcript_transaction_id')  : substr(uniqid(), 0, 12);
            $transction->payment_mode = $request->get('transcript_pay_mode') ? $request->get('transcript_pay_mode')  : '';
            $transction->parent_profile_id = $request->get('parent_id');
            $transction->amount = $request->get('total_val');
            $transction->status = $request->get('status');
            $transction->save();
        }

        //create the entry to transcript table according to the quantity 

        for ($x = 1; $x <= $request->get('quantity'); $x++) {

            $transcript_type = "transcript";
            $transcript = new Transcript();
            $transcript->parent_profile_id   = $request->get('parent_id');
            $transcript->student_profile_id = $request->get('student_id_val');
            $transcript->period = $request->get('transcript_period');
            $transcript->status = $request->get('status');
            $transcript->save();

            $transcript_payment = new TranscriptPayment();
            $transcript_payment->transcript_id   =  $transcript->id;
            $transcript_payment->amount = $request->get('amount');
            $transcript_payment->status = $request->get('status');
            $transcript_payment->transcation_id =  $request->get('status') == 'paid' ? $transction->id  : '';
            $transcript_payment->payment_mode = $request->get('transcript_pay_mode');
            $transcript_payment->save();

            //add transacript to the cart if there are two transcript orderd
            if ($request->get('status') == 'pending') {
                if (!Cart::where('item_id', $transcript->id)->where('item_type', $transcript_type)->exists()) {
                    Cart::create([
                        'item_type' => $transcript_type,
                        'item_id' => $transcript->id,
                        'parent_profile_id' => $request->get('parent_id'),
                    ]);
                }
            }
        }
    }
    public function getDetailedOrders(Request $request)
    {
        $orderDetails = Dashboard::where('transaction_id', $request->transaction_id)->get();

        return response()->json(['orders' => $orderDetails]);
    }

    /**
     * Get search filter data
     * 
     * @param {Request} $request
     * @return
     */
    public function getSearchFilterData(Request $request)
    {
        $input      = $request->all();
        $countries  = [];

        switch ($input['type']) {
            case 'country':

                $country  = Country::orderBy('country')->get();
                if ($country) :
                    foreach ($country as $key => $value) {

                        $selected  = ( $input['keyword'] && $input['keyword'] == $value->country ) ? 'selected' : '';

                        $option  = '<option '.$selected.' value="' . $value->country . '">' . $value->country . '</option>';
                        array_push($countries, $option);
                    }
                    return $countries;
                endif;
                break;

            default:
                # code...
                break;
        }
    }
}
