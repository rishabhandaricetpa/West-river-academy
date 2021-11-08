<?php

namespace App\Mail;

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
        // return $this->view('mail.graduation-approved')->subject('West River Academy Graduation');
        return  $this->markdown('mail.graduation-approved', compact('total_fees'))->subject('MoneyGram Payment');
    }
}
