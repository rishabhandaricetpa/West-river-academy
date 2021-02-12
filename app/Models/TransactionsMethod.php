<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'transcation_id', 'payment_mode', 'parent_profile_id','amount','status','coupon_code','coupon_amount'
       ];
    protected $table = 'transaction_methods';

    public function parentProfile()
    {
        return $this->belongsTo('App\Models\ParentProfile');
    }

    public static function storeTransactionData($parent_profile_id,$amount,$coupon_code,$coupon_amount,$type){
        $id = Auth::user()->id;
        $parentProfileData = User::find($id)->parentProfile()->first();
        $paymentinfo = new TransactionsMethod;
        $paymentinfo = $parentProfileData->TransactionsMethod()->create([
          'parent_profile_id' => $parentProfileData,
          'transcation_id' => substr(uniqid(), 0, 8),
          'payment_mode' => $type,
          'amount' => $amount,
          'status' => 'active',
          'coupon_code' => $coupon_code,
          'coupon_amount' => $coupon_amount,
        ]);
    }
    
}
