<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe;
use Session;

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
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 150,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Making test payment." 
        ]);
        $notification = array(
            'message' => 'Payment has been successfully processed!',
            'alert-type' => 'success'
        ); 
        return back()->with($notification);
    }
    public function store($id, Request $request)
    {
        $paymentinfo = new Payment;
        $user = Auth::user();
        $paymentinfo = $user->transactions()->create([
            'transcation_id' => $id,

        ]);
        $paymentinfo->save();
        Mail::to(Auth::user())->send(new OrderShipped($id));
        return view('ordershipped');
    }

}