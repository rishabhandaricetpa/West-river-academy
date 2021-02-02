<?php

namespace App\Http\Controllers\PaymentMethod;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\BankTranferEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Cart;
use App\Models\EnrollmentPayment;
use Auth;


class BankTranferController extends Controller
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
    public function index(){
      $id = Auth::user()->id;
      $user=  User::find($id)->first();
      $email= Auth::user()->email; 

     $address = User::find($id)->parentProfile()->first();
     $date = \Carbon\Carbon::now()->format('Y-m-d');
     
     //update cart status active 
     $payment= Cart::getCartAmount($this->parent_profile_id,true);
     $cartItems=Cart::select('item_id')->where('parent_profile_id',$id)->get();
     foreach ($cartItems as $cart) 
     {
       $enrollemtpayment=EnrollmentPayment::select()->where('enrollment_period_id',$cart->item_id)->first();
       $enrollemtpayment->status='active';
       $enrollemtpayment->payment_mode='Bank Transfer';
       $enrollemtpayment->save();
     }

     $refreshCart=Cart::select()->where('parent_profile_id',$id)->get();
     $refreshCart->each->delete();
     Mail::to($email)->send(new BankTranferEmail($user));
     return view('mail.banktransfer',compact('email','date'));
    }
}
