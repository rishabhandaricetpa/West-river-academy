<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'transcation_id', 'payment_mode', 'parent_profile_id', 'amount', 'status', 'coupon_code', 'coupon_amount', 'item_type', 'student_profile_id'
    ];
    protected $table = 'transaction_methods';

    public function parentProfile()
    {
        return $this->belongsTo('App\Models\ParentProfile');
    }

    public static function storeTransactionData($parent_profile_id, $amount, $coupon_code, $coupon_amount, $type, $cartItems)
    {
        $items = collect($cartItems)->pluck('item_type')->toArray();
        $item_type = implode(",", $items);
        //pluck student id for the payment history tab added later
        $student_data = collect($cartItems)->pluck('student_profile_id')->toArray();
        $student_id = implode(",", (array_unique($student_data)));
        $id = Auth::user()->id;
        $parentProfileData = User::find($id)->parentProfile()->first();
        $paymentinfo = new self;
        $paymentinfo = $parentProfileData->TransactionsMethod()->create([
            'parent_profile_id' => $parentProfileData,
            'transcation_id' => substr(uniqid(), 0, 8),
            'payment_mode' => $type,
            'amount' => $amount,
            'status' => 'pending',
            'coupon_code' => $coupon_code,
            'coupon_amount' => $coupon_amount,
            'item_type' =>  $item_type,
            'student_profile_id' => $student_id,
        ]);
        $payment_id = $paymentinfo->transcation_id;
        Cart::emptyCartAfterPayment($type, 'pending', $payment_id);
    }
}
