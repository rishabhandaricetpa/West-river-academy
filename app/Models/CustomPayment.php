<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_profile_id','type_of_payment', 'amount', 'paying_for', 'payment_mode'
    ];
}
