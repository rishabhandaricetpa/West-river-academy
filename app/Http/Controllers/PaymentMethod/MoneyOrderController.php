<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\TransactionsMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MoneyOrder;
use App\Models\Cart;
use App\Models\EnrollmentPayment;
use App\Models\User;
use Auth;


class MoneyOrderController extends Controller
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

    $id = Auth::user()->id;
    $user =  User::find($id)->first();
    $email = Auth::user()->email;
    //update cart status active 
    $parentProfileData = User::find($id)->parentProfile()->first();

    $enroll_fees = Cart::getCartAmount($this->parent_profile_id, true);
    $coupon_code = session('applied_coupon', null);
    $coupon_amount = session('applied_coupon_amount', 0);
    $amount = $enroll_fees->amount;
    $final_amount = $coupon_amount > $amount ? 0 : $amount - $coupon_amount;

    $type='Check or Money Order';
    //store transactions

    $saveTransaction= TransactionsMethod::storeTransactionData($this->parent_profile_id,$amount,$coupon_code,$coupon_amount,$type);
   
    //update cart status active 

    Cart::emptyCartAfterPayment($type, 'active');

    Mail::to($email)->send(new MoneyOrder($user));

    return view('mail.moneyorder-review', compact('email'));
  }
}
