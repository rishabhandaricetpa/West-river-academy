<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
class BankTranferEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   $date = \Carbon\Carbon::now()->format('Y-m-d');
        $id= $this->user->id; 
        $user=  User::find($id)->first();
        $address = User::find($id)->parentProfile()->first();
        return $this->from(env('EMAIL'))
        ->markdown('mail.bankinfo',compact('date','address'))->subject('Bank Transfer Details');
    }
}
