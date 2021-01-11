<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;


class MoneyOrderController extends Controller
{
/**
     * payment view
     */
    public function index()
    {
     $id= auth()->user()->id;
      $user=  User::find($id)->first();
      $email= $user->email;
      $address = User::find($id)->parentProfile()->first();
      $date = \Carbon\Carbon::now()->format('Y-m-d');
        Mail::to('paige.priyanka@ithands.com')->send(new SendMail($user));
     return view('mail.order-review',compact('email','date'));
    }
  
}
