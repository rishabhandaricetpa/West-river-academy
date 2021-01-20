<?php

namespace App\Http\Controllers\PaymentMethod;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\BankTranferEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Auth;


class BankTranferController extends Controller
{
    public function index(){
      $id = Auth::user()->id;
      $email= Auth::user()->email; 
     $address = User::find($id)->parentProfile()->first();
     $user=  User::find($id)->first();
     $date = \Carbon\Carbon::now()->format('Y-m-d');
     Mail::to($email)->send(new BankTranferEmail($user));
     return view('mail.banktransfer',compact('email','date'));
    }
}
