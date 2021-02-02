<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'amount', 'status', 'coupon_for', 'redeem_left', 'expire_at', 'description'
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

    public static function removeAppliedCoupon()
    {
        session(['applied_coupon' => null]);
        session(['applied_coupon_amount' => null]);
    }

    public static function getParentCoupons()
    {
        $Userid = Auth::user()->id;
        $parentProfileData = User::find($Userid)->parentProfile()->first();
        $parent_id = $parentProfileData->id;
        
        $codes = [];
        
        $coupons = Coupon::select('code','amount')
                            ->where('status','active')
                            // ->orWhereNull('expire_at')
                            // ->orWhere('coupon_for',$parent_id) // if there's only one user is assigned
                            // ->orWhere('coupon_for','like',"%,$parent_id") // if id is in the last place
                            // ->orWhere('coupon_for','like',"$parent_id,%") // if id is in the first place
                            // ->orWhere('coupon_for','like',"%,$parent_id,%") // if id is in between 
                            // ->orWhere('expire_at','')
                            // ->orWhereDate('expire_at','>',date('Y-m-d'))
                            ->get()
                            ->toArray();

        foreach ($coupons as $coupon) {
            array_push($codes,[ 'label' => $coupon['code'].' ($'. $coupon['amount'].')', 'value' => $coupon['code']]);
        }
        
        return $codes;
    }
}
