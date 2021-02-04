<?php

namespace App\Http\Controllers\PaymentMethod;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
use Session;
use Redirect;
use App\Models\TransactionsMethod;
use App\Models\User;
use App\Models\Cart;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\EnrollmentPayment;
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
     * payment view
     */
    public function index()
    {
        return view('Billing/creditcard');
    }
  
    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {   
        try {
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);
        $amount=$enroll_fees->amount;
        if(empty($amount)){
            return view('Billing.invalid');
        }
        else{
        $paymentinfo = new TransactionsMethod;
        $user=Auth::user();
        $email=$user->email;
        $userId = Auth::user()->id;
        $parentProfileData = User::find($userId)->parentProfile()->first();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $charges = \Stripe\Charge::create ([
                    "amount" => 100 * $amount,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "receipt_email"=>$email,
                    "description" =>$request->description
            ]);
            $parentProfileData = User::find($userId)->parentProfile()->first();
            $paymentinfo = $parentProfileData->TransactionsMethod()->create([
                'parent_profile_id'=>$parentProfileData,
                'transcation_id' => $charges->id,
                'payment_mode'=>'Credit Card',
                'amount'=> $charges->amount/100,
                'status'=>$charges->status,
            ]);
            
            if($charges->status=='succeeded'){
            $cartItems=Cart::select('item_id')->where('parent_profile_id',$parentProfileData->id)->get();
            foreach ($cartItems as $cart) 
            {
            $enrollemtpayment=EnrollmentPayment::select()->where('enrollment_period_id',$cart->item_id)->first();
            $enrollemtpayment->status='paid';
            $enrollemtpayment->transcation_id=$charges->id;
            $enrollemtpayment->payment_mode='Credit Card';
            $enrollemtpayment->save();
            }

            $refreshCart=Cart::select()->where('parent_profile_id',$parentProfileData->id)->get();
            $refreshCart->each->delete();
            }
            else{
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
        }
        } 
        catch (\Stripe\Exception\CardException $e) {
            echo 'Status is:' . $e->getHttpStatus() . '\n';
            echo 'Type is:' . $e->getError()->type . '\n';
            echo 'Code is:' . $e->getError()->code . '\n';
            echo 'Param is:' . $e->getError()->param . '\n';
            echo 'Message is:' . $e->getError()->message . '\n';
    }
    }
}