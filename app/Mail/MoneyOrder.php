<?php

namespace App\Mail;

use App\Models\Cart;
use App\Models\User;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MoneyOrder extends Mailable
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
        $user = User::find($id);
        $email = $user->email;
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $address = User::find($id)->parentProfile()->first();
        $amount = $this->amount;

        return $this->markdown('mail.moneyordermail', compact('user', 'date', 'email', 'address', 'amount'))->subject('Check and Money Order Details');
    }
}
