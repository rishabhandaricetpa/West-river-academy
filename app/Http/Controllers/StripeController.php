<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe;
use Session;
use Redirect;
use App\Models\TransactionsMethod;
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
        $paymentinfo = new TransactionsMethod;
        $user=Auth::user();
        $email=$user->email;
        $userId = Auth::user()->id;
        $parentProfileData = User::find($userId)->parentProfile()->first();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $charges = \Stripe\Charge::create ([
                "amount" => 100 * $amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "receipt_email"=>$email,
                "description" =>$request->description
        ]);
        $parentProfileData = User::find($userId)->parentProfile()->first();
        $paymentinfo = $parentProfileData->TransactionsMethod()->create([
            'parent_profile_id'=>$parentProfileData,
            'transcation_id' => $charges->id,
            'payment_mode'=>'Credit Card',
            'amount'=> $charges->amount/100,
            'status'=>$charges->status,
        ]);
        $paymentinfo->save();
        
        $notification = array(
            'message' => 'Payment has been successfully processed!',
            'alert-type' => 'success'
        ); 
        return Redirect::route('payment.info')->with($notification);
        } 
        catch (\Stripe\Exception\CardException $e) {
            echo 'Status is:' . $e->getHttpStatus() . '\n';
            echo 'Type is:' . $e->getError()->type . '\n';
            echo 'Code is:' . $e->getError()->code . '\n';
            echo 'Param is:' . $e->getError()->param . '\n';
            echo 'Message is:' . $e->getError()->message . '\n';
    }
    }
}