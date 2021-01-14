<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
    {
        $id= auth()->user()->id;
        $user=  User::find($id)->first();
        $email= $user->email;
        $address = User::find($id)->parentProfile()->first();
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        return $this->from('paige.priyanka@ithands.com')
        ->markdown('mail.moneyordermail',compact('user','address','date','email'));
    }
}
