<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CustomPayment;
use App\Models\ParentProfile;
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


    //update data from Admin users input in Custom payment table
    public function updateCustomPayments(Request $request, $id)
    {
        $customPayments = CustomPayment::find($id);
        $customPayments->transcation_id = $request->get('transcation_id');
        $customPayments->payment_mode = $request->get('payment_mode');
        $customPayments->amount = $request->get('amount');
        $customPayments->status = $request->get('paymentStatus');
        $customPayments->paying_for = $request->get('paying_for');
        $customPayments->save();
        $notification = [
            'message' => 'Record updated successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);

        return view('payments/custom-payment');
    }


    public function edit($id)
    {
        $customPaymentsData = CustomPayment::whereId($id)->with('ParentProfile')->first();
        return view('admin.payment.customPayments.edit', compact('customPaymentsData'));
    }
}
