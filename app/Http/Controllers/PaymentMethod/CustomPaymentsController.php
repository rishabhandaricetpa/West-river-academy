<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomPayment;
use App\Models\Cart;
use App\Models\ParentProfile;

class CustomPaymentsController extends Controller
{
    //
    public function index()
    {
        return view('payments/custom-payment');
    }

    //update
    public function update(Request $request)
    {
        $customPaymentsData = CustomPayment::create([
            'parent_profile_id' => ParentProfile::getParentId(),
            'amount' => $request->get('amount'),
            'paying_for' => 'pending',
            'type_of_payment'=>'Custom Payments',
            'status'=>'pending'
        ]);
        $parentId= $customPaymentsData->parent_profile_id;
        // CustomPayment::updateOrInsert(['transcript_id' => $transcriptData->id],[ 'amount' => $transcript_fee]);

        return view('payments/custom-payment');
    }
}
