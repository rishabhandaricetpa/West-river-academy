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
        $id = $this->user->id;
        $user = User::find($id)->first();
        $email = $user->email;
        $parent_profile = User::find($id)->parentProfile()->first();
        $address = User::find($id)->parentProfile()->first();
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $payment = Cart::getCartAmount($parent_profile->id, true);
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        return $this->from(env('EMAIL'))
        ->markdown('mail.moneygram-email', compact('user', 'address', 'parent_profile', 'date', 'email', 'payment'))->subject('Money Gram Payment');
    }
}
