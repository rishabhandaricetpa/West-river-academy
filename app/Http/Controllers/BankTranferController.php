<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\BankTranferEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;


class BankTranferController extends Controller
{
    public function index(){
        
      $id= auth()->user()->id;
      $user=  User::find($id)->first();
      $email= $user->email;
      $address = User::find($id)->parentProfile()->first();
     
     $date = \Carbon\Carbon::now()->format('Y-m-d');
  
          Mail::to($email)->send(new BankTranferEmail($user));
          return view('mail.banktransfer',compact('email','date'));
    }
}
