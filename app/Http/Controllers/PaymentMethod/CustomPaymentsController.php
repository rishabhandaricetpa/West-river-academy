<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CustomPayment;
use App\Models\ParentProfile;
use App\Models\TransactionsMethod;
use Illuminate\Http\Request;

class CustomPaymentsController extends Controller
{
    //
    public function index()
    {
        return view('payments/custom-payment');
    }

    //update data from user input in Custom payment table
    public function update(Request $request)
    {
        $customPaymentsData = CustomPayment::create([
            'parent_profile_id' => ParentProfile::getParentId(),
            'amount' => $request->get('amount'),
            'paying_for' => 'pending',
            'type_of_payment' => 'Custom Payments',
            'status' => 'pending',
        ]);
        $parentId = $customPaymentsData->parent_profile_id;
        // CustomPayment::updateOrInsert(['transcript_id' => $transcriptData->id],[ 'amount' => $transcript_fee]);

        return view('payments/custom-payment');
    }


   
}
