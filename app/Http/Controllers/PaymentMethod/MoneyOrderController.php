<?php

namespace App\Http\Controllers\PaymentMethod;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;


class MoneyOrderController extends Controller
{
/**
     * payment view
     */
    public function index(){
    // { dd('reacjed');
       $id = auth()->user()->id;
       $user=  User::find($id)->first();
      $email= $user->email;
    //   $address = User::find($id)->parentProfile()->first();
    //   $date = \Carbon\Carbon::now()->format('Y-m-d');
        Mail::to($email)->send(new SendMail($user));
        return view('mail.moneyorder-review',compact('email'));

    }
  
}
