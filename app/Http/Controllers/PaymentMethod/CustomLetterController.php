<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CustomPayment;
use App\Models\FeesInfo;
use App\Models\ParentProfile;
use Illuminate\Http\Request;

class CustomLetterController extends Controller
{
    public function index()
    {
        $custom_letter_fee = FeesInfo::getFeeAmount('custom_letter');
        return view('payments.custom-letter', compact('custom_letter_fee'));
    }
}
