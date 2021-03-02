<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Mail\BankTranferEmail;
use App\Models\Cart;
use App\Models\TransactionsMethod;
use App\Models\EnrollmentPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
  public function index($amount)
  {
    $id = Auth::user()->id;
    $user =  User::find($id)->first();
    $email = Auth::user()->email;

    $address = User::find($id)->parentProfile()->first();
    $date = \Carbon\Carbon::now()->format('Y-m-d');

    $enroll_fees = Cart::getCartAmount($this->parent_profile_id, true);
    $coupon_code = session('applied_coupon', null);
    $coupon_amount = session('applied_coupon_amount', 0);
    $amount = $enroll_fees->amount;
    $final_amount = $coupon_amount > $amount ? 0 : $amount - $coupon_amount;
    $type = 'Bank Transfer';
    //store transactions
    $saveTransaction = TransactionsMethod::storeTransactionData($this->parent_profile_id, $amount, $coupon_code, $coupon_amount, $type);
    //update cart status active 

    Cart::emptyCartAfterPayment($type, 'active');

    Mail::to($email)->send(new BankTranferEmail($user, $amount));
    return view('mail.banktransfer', compact('email', 'date'));
  }
}
