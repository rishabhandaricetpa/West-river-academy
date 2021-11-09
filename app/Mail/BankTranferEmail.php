<?php

namespace App\Mail;

use App\Models\EmailEdits;
use App\Models\User;
use DbView;
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

        $user = User::find($this->user->id)->parentProfile()->first();
        $user_name = $user->full_name;
        $amount = $this->amount;
        $template = EmailEdits::where('type', 'banktransfer')->first();
        $email_data =  DbView::make($template)->field('content')->with([
            'user_name' => $user_name,
            'amount' => $amount,
        ])->render();
        return  $this->markdown('mail.email-notification', compact('email_data'))->subject('Bank Transfer Instructions');
    }
}
