<?php

namespace App\Mail;

use App\Models\EmailEdits;
use DbView;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GraduationApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $total_fees = $this->data->total_fee;
        $template = EmailEdits::where('type', 'graduation')->first();
        $email_data =  DbView::make($template)->field('content')->with([
            'total_fees' => $total_fees,
        ])->render();
        return  $this->markdown('mail.email-notification', compact('email_data'))->subject('MoneyGram Payment');
    }
}
