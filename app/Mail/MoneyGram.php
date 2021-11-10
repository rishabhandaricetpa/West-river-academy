<?php

namespace App\Mail;

use App\Models\Cart;
use App\Models\EmailEdits;
use App\Models\User;
use App\Services\WireViewEngine;
use Auth;
use DbView;
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
        $user = User::find($this->user->id)->parentProfile()->first();
        $user_name = $user->full_name;
        $date = \Carbon\Carbon::now()->format('M d Y');
        $amount = $this->amount;
        $template = EmailEdits::where('type', 'moneygram')->first();
        $email_data =  (new WireViewEngine($template->content))->setLegends([
            'user_name' => $user_name,
            'date' => $date,
            'amount' => $amount,
        ])->render();
        return  $this->markdown('mail.email-notification', compact('email_data'))->subject('MoneyGram Payment');
    }
}
