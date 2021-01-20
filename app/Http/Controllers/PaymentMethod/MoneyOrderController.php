<?php

namespace App\Http\Controllers\PaymentMethod;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;
use Auth;

class MoneyOrderController extends Controller
{
/**
     * payment view
     */
    public function index(){
       $id =Auth::user()->id;
       $user=  User::find($id)->first();
       $email= Auth::user()->email;
        Mail::to($email)->send(new SendMail($user));
        return view('mail.moneyorder-review',compact('email'));

    }
  
}
