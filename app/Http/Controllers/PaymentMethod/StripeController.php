<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use Stripe;
use Session;
use Redirect;
use App\Models\Coupon;
use App\Models\Cart;
use App\Models\EnrollmentPayment;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\TransactionsMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
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

    /**
     * payment view.
     */
    public function index()
    {
        return view('Billing/creditcard');
    }

    /**
     * handling payment with POST.
     */
    public function handlePost(Request $request)
    {
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id, true);
        $coupon_code = session('applied_coupon', null);

        $amount = $enroll_fees->amount;
        if (empty($amount)) {
            return view('Billing.invalid');
        } else {
            $coupon_amount = session('applied_coupon_amount', 0);
            $final_amount = $coupon_amount > $amount ? 0 : $amount - $coupon_amount;

            $paymentinfo = new TransactionsMethod;
            $user = Auth::user();
            $email = $user->email;
            $userId = Auth::user()->id;
            $parentProfileData = User::find($userId)->parentProfile()->first();
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            try {
                $charges = \Stripe\Charge::create([
                    "amount" => 100 * $final_amount,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "receipt_email" => $email,
                    "description" => $request->description
                ]);
                $parentProfileData = User::find($userId)->parentProfile()->first();
                $paymentinfo = $parentProfileData->TransactionsMethod()->create([
                    'parent_profile_id' => $parentProfileData,
                    'transcation_id' => $charges->id,
                    'payment_mode' => 'Credit Card',
                    'amount' => $amount,
                    'status' => $charges->status,
                    'coupon_code' => $coupon_code,
                    'coupon_amount' => $coupon_amount,
                ]);

                Coupon::removeAppliedCoupon();

                if ($charges->status == 'succeeded') {
                    Cart::emptyCartAfterPayment('Credit Card', 'paid', $charges->id);
                } else {
                    $notification = array(
                        'message' => 'Payment not processed!Please check with your bank!',
                        'alert-type' => 'error'
                    );
                    return Redirect::route('payment.info')->with($notification);
                }

                $paymentinfo->save();

                $notification = array(
                    'message' => 'Payment has been successfully processed!',
                    'alert-type' => 'success'
                );
                return Redirect::route('payment.info')->with($notification);
            } catch (\Stripe\Exception\CardException $e) {
                echo 'Status is:' . $e->getHttpStatus() . '\n';
                echo 'Type is:' . $e->getError()->type . '\n';
                echo 'Code is:' . $e->getError()->code . '\n';
                echo 'Param is:' . $e->getError()->param . '\n';
                echo 'Message is:' . $e->getError()->message . '\n';
            }
        }
    }
}
