<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe;
use Session;
use App\Models\TransactionsMethods;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    /**
     * payment view
     */
    public function index()
    {
        return view('Billing/creditcard');
    }
  
    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {   
        $amount=$request->amount;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $charges = \Stripe\Charge::create ([
                "amount" => 100 * $amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Making test payment." 
        ]);
        $notification = array(
            'message' => 'Payment has been successfully processed!',
            'alert-type' => 'success'
        ); 
        return view('Billing/paymentsuccess', compact('charges'))->with($notification);
        } 
        catch (\Stripe\Exception\CardException $e) {
            echo 'Status is:' . $e->getHttpStatus() . '\n';
            echo 'Type is:' . $e->getError()->type . '\n';
            echo 'Code is:' . $e->getError()->code . '\n';
            // param is '' in this case
            echo 'Param is:' . $e->getError()->param . '\n';
            echo 'Message is:' . $e->getError()->message . '\n';
    }
    }
    public function store($id, Request $request)
    {
        $paymentinfo = new TransactionsMethods;
        $user=Auth::user();
        $userId = Auth::user()->id;
        $parentProfileData = User::find($userId)->parentProfile()->first();
        $paymentinfo = $parentProfileData->TransactionsMethods()->create([
            'parent_profile_id'=>$parentProfileData,
            'transcation_id' => $id,
            'payment_mode'=>'Credit Card'
        ]);
        $paymentinfo->save();
        
        return view('SignIn/dashboard');
    }

}