<?php

namespace App\Mail;

use App\Models\Cart;
use App\Models\User;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MoneyGram extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $amount)
    {
        $this->user = $user;
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $id = $this->user->id;
        $user = User::find($id)->first();
        $address = User::find($id)->parentProfile()->first();
        $date = \Carbon\Carbon::now()->format('M d Y');
        $amount = $this->amount;

        return  $this->markdown('mail.moneygram-email', compact('user', 'address', 'date', 'amount'))->subject('Money Gram Payment');
    }
}
