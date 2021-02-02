<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'transcation_id', 'payment_mode', 'parent_profile_id','amount','status','coupon_code','coupon_amount'
       ];
    protected $table = "transaction_methods";
    
    public function parentProfile()
    {
        return $this->belongsTo('App\Models\ParentProfile');
    }
    
}
