<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\CustomLetterPayment;
use App\Models\CustomPayment;
use App\Models\EnrollmentPayment;
use App\Models\EnrollmentPeriods;
use App\Models\Graduation;
use App\Models\GraduationPayment;
use App\Models\Notarization;
use App\Models\NotarizationPayment;
use App\Models\Notification;
use App\Models\OrderPersonalConsultation;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\Transcript;
use App\Models\UploadDocuments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    private $parent_profile_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $Userid = Auth::user()->id;
            $parentProfileData = User::find($Userid)->parentProfile()->first();
            $this->parent_profile_id = $parentProfileData->id;

            return $next($request);
        });
    }

    public function address($id)
    {
        // $parentdata = ParentProfile::getParentId();
        $parent = ParentProfile::where('id', ParentProfile::getParentId())->first();
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id, true);

        if (is_null($enroll_fees->amount) || empty($enroll_fees->amount) || $enroll_fees->amount == 0) {
            $notification = [
                'message' => 'Cart is Empty! Please add atleast one item.',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $is_valid = Cart::isCartValid($this->parent_profile_id);

        if (!$is_valid) {
            $notification = [
                'message' => 'Cart is Invalid! Fee for the first Student enrollment is not paid. ',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $coupons = Coupon::getParentCoupons();

        $country_list = Country::select('country')->get();
        $coupon_code = session('applied_coupon', null);

        return view('Billing/cart-billing', compact('parent', 'country_list', 'enroll_fees', 'coupons', 'coupon_code'));
    }

    /**
     * This function is used to store billing and shipping address.
     */
    protected function saveaddress(Request $request)
    {
        try {
            DB::beginTransaction();
            $address = new Address();
            $billing_data = $request->input('billing_address');
            $shipping_data = $request->input('shipping_address');
            $payment_type = $request->input('paymentMethod');
            $Userid = Auth::user()->id;
            $parentProfileData = User::find($Userid)->parentProfile()->first();
            $id = $parentProfileData->id;
            $billinAddress = Address::updateOrCreate(
                ['parent_profile_id' => $id],
                [
                    'parent_profile_id' => $id,
                    'billing_street_address' => $billing_data['street_address'],
                    'billing_city' => $billing_data['city'],
                    'billing_state' => $billing_data['state'],
                    'billing_zip_code' => $billing_data['zip_code'],
                    'billing_country' => $billing_data['country'],
                    'shipping_street_address' => $shipping_data['street_address'],
                    'shipping_city' => $shipping_data['city'],
                    'shipping_state' => $shipping_data['state'],
                    'shipping_zip_code' => $shipping_data['zip_code'],
                    'shipping_country' => $shipping_data['country'],
                    'email' => $request['email'],
                ]
            );
            $parentaddress = ParentProfile::find($Userid);
            $parentaddress->fill([
                'street_address' => $billing_data['street_address'],
                'city' => $billing_data['city'],
                'state' => $billing_data['state'],
                'zip_code' => $billing_data['zip_code'],
                'country' => $billing_data['country'],
            ]);
            $parentaddress->save();
            DB::commit();

            if ($payment_type['payment_type'] == 'Credit Card') {
                return route('stripe.payment');
            } elseif ($payment_type['payment_type'] == 'PayPal') {
                return route('paywithpaypal');
            } elseif ($payment_type['payment_type'] == 'Bank Transfer') {
                return route('order.review');
            } elseif ($payment_type['payment_type'] == 'MoneyGram') {
                return route('money.gram');
            } elseif ($payment_type['payment_type'] == 'Check or Money Order') {
                return route('money.order');
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    //Parent accounts edit information
    public function mysettings()
    {
        $user_id = Auth::user()->id;
        $parent = ParentProfile::where('user_id', $user_id)->first();
        /** Receiving payment history data for transcript*/
        $studentData = $parent->studentProfile()->get();

        $studentId = collect($studentData)->pluck('id');
        $transcript_payments = Transcript::with('student', 'transcriptPayment')->whereIn('student_profile_id', $studentId)->whereIn('status', ['paid', 'completed', 'approved', 'canEdit'])->get();

        /** Receiving payment history data for custom payment*/
        $customPayments = CustomPayment::with('ParentProfile')->where('parent_profile_id', $user_id)->where('status', 'paid')->get();

        /** Receiving payment history data for enrollments*/

        $enrollmentPayments = DB::table('enrollment_periods')->whereIn('student_profile_id', $studentId)
            ->join('enrollment_payments', 'enrollment_payments.id', 'enrollment_periods.enrollment_payment_id')
            ->join('student_profiles', 'student_profiles.id', 'enrollment_periods.student_profile_id')
            ->whereIn('enrollment_payments.status', ['active', 'paid'])
            ->get();
        /** Receiving payment history data for graduation*/

        $graduationPayments = Graduation::join('graduation_payments', 'graduation_payments.graduation_id', 'graduations.id')
            ->whereIn('graduations.student_profile_id', $studentId)
            ->whereIn('graduations.status', ['paid', 'approved', 'completed'])
            ->join('student_profiles', 'student_profiles.id', 'graduations.student_profile_id')
            ->get();

        /** Receiving payment history data for notirization*/
        $notirizationPayments = NotarizationPayment::with('notarization', 'ParentProfile')->where('parent_profile_id', $user_id)->get();

        /** Receiving payment history data for order personal consultation*/

        $orderConsulationPayments = OrderPersonalConsultation::with('parent')->where('parent_profile_id', $user_id)->get();

        $customLetter = CustomLetterPayment::with('ParentProfile')
            ->where('parent_profile_id', $user_id)
            ->where('status', 'paid')
            ->get();
        return view('MyAccounts/myaccount', compact('parent', 'user_id', 'transcript_payments', 'customPayments', 'enrollmentPayments', 'graduationPayments', 'notirizationPayments', 'orderConsulationPayments', 'customLetter'));
    }

    public function editmysettings($user_id)
    {
        $parent = ParentProfile::where('user_id', $user_id)->first();

        return view('MyAccounts/edit-account', compact('parent', 'user_id'));
    }

    public function updatemysettings(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $user_id = Auth::user()->id;
            $userdata = User::find($user_id);
            $userdata->name = $request->get('first_name');
            $userdata->email = $request->get('email');
            // $Userdata->email_verified_at='';
            $userdata->save();

            $user = User::find($id)->parentProfile()->first();
            $parent_id = $user->id;
            $parent = ParentProfile::find($parent_id);
            $parent->p1_first_name = $request->get('first_name');
            $parent->p1_last_name = $request->get('last_name');
            $parent->p1_email = $request->get('email');
            $parent->p1_cell_phone = $request->get('phone');
            $parent->save();

            DB::commit();

            $notification = [
                'message' => 'User Record is updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Failed to update My account']);
            }
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'old_password'     => 'required',
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        $data = $request->all();
        $user = User::find($id);
        if (!Hash::check($data['old_password'], $user->password)) {
            $notification = [
                'message' => 'Please enter Correct Previous Password!',
                'alert-type' => 'Error',
            ];

            return redirect()->back()->with($notification);
        } else {
            $user->password = Hash::make($data['new_password']);
            $user->save();
            $notification = [
                'message' => 'Password Updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function getBankTransferDetails()
    {
        $tranferwise = DB::table('transfer_wise_deatils')->where('status', '1')->first();
        $banktransfer = DB::table('bank_transfer_details')->where('status', '1')->first();

        return view('Billing/bank-transfer', compact('tranferwise', 'banktransfer'));
    }

    public function getMoneyGramDetails()
    {
        $moneyGram = DB::table('money_gram_details')->where('status', '1')->first();

        return view('Billing/moneygram-transfer', compact('moneyGram'));
    }
    public function removeNotification($notification_id)
    {
        return Notification::removeParentNotifications($notification_id);
    }

    public function welcomeVideo(){
     

        $parent_id=ParentProfile::getParentId();
        $parent_data=ParentProfile::whereId($parent_id)->first();
        if($parent_data->welcome_video_status===0)
        {
        return view('welcome-video',compact('parent_data'));
        }
        else{
            $parentId = ParentProfile::getParentId();
            $parentData = ParentProfile::whereId($parentId)->first();
            $student = StudentProfile::where('parent_profile_id', $parentId)->get();
    
            $student_data = StudentProfile::where('parent_profile_id', $parentId)->with('parentProfile')->first();
            $transcript = Transcript::where('parent_profile_id', $parentId)
                ->whereIn('status', ['approved', 'paid', 'completed', 'canEdit'])
                ->with('student')->get();
            $record_transfer = ParentProfile::find($parentId)->schoolRecord()->get();
            $confirmLetter = StudentProfile::where('student_profiles.parent_profile_id', $parentId)
                ->join('confirmation_letters', 'confirmation_letters.student_profile_id', 'student_profiles.id')
                ->with('enrollmentPeriods')->get();
            $personal_consultation = OrderPersonalConsultation::where('status', 'paid')->where('parent_profile_id', $parentId)->with('parent')->get();
    
            $uploadedDocuments = UploadDocuments::select()
                ->whereIn('parent_profile_id', [$parentId])->where('is_upload_to_student', 1)->get();
            return view('SignIn.dashboard', compact('student', 'transcript', 'parentId', 'record_transfer', 'student_data', 'confirmLetter', 'personal_consultation', 'uploadedDocuments', 'parentData'));        }

    }


    public function  updatewelcomestatus($parent_id){

            $parent_data = ParentProfile::find($parent_id)->first();
            $parent_data->welcome_video_status='1';
            $parent_data->save();
            $notification = [
                'message' => 'Password Updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
    }
}
