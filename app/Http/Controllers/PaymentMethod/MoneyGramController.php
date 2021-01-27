<?php

namespace App\Http\Controllers\PaymentMethod;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MoneyGram;
use App\Models\User;
use Auth;
use App\Models\Cart;
use App\Models\EnrollmentPayment;


class MoneyGramController extends Controller
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
    public function index(){
       $id =Auth::user()->id;
       $user=  User::find($id)->first();
       $email= Auth::user()->email;
     //update cart status active 
     $address = User::find($id)->parentProfile()->first();
     $date = \Carbon\Carbon::now()->format('Y-m-d');
       $payment= Cart::getCartAmount($this->parent_profile_id,true);
       $cartItems=Cart::select('item_id')->where('parent_profile_id',$id)->get();
       foreach ($cartItems as $cart) 
       {
         $enrollemtpayment=EnrollmentPayment::select()->where('enrollment_period_id',$cart->item_id)->first();
         $enrollemtpayment->status='active';
         $enrollemtpayment->payment_mode='MoneyGram';
         $enrollemtpayment->save();
       }

    //    $refreshCart=Cart::select()->where('parent_profile_id',$id)->get();
    //    $refreshCart->each->delete();

        Mail::to($email)->send(new MoneyGram($user));
        return view('mail.moneygram-review',compact('email','date'));

    }
}
