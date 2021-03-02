<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BankTranferEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;

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
        $date = \Carbon\Carbon::now()->format('M d Y');
        $id = $this->user->id;
        $user = User::find($id)->first();
        $address = User::find($id)->parentProfile()->first();
        $amount = $this->amount;
        return $this->from(env('EMAIL'))
            ->markdown('mail.bankinfo', compact('user', 'date', 'address', 'amount'))->subject('Bank Transfer Details');
    }
}
