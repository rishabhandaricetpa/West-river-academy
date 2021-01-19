<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'amount', 'status', 'coupon_for', 'redeem_left', 'expire_at', 'assigend_to'
    ];

    public static function generateCode()
    {
        $code = Self::createRandomCode();

        if(Coupon::where('code',$code)->where('status','active')->exists()){
           return Self::generateCode();
        }

        return $code;
    }

    private static function createRandomCode()
    {
        return Str::upper(Str::random(8));
    }
}
