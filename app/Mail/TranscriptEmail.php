<?php

namespace App\Mail;

use App\Models\EmailEdits;
use App\Models\User;
use App\Services\WireViewEngine;
use DbView;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TranscriptEmail extends Mailable
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
    {
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $id = $this->user->id;
        $user = User::find($id);
        $template = EmailEdits::where('type', 'transcript_approved')->first();
        $email_data =  (new WireViewEngine($template->content))->setLegends([
            'date' => $date,
        ])->render();
        return $this->markdown('mail.email-notification', compact('date'))->subject('Transcript Received');
    }
}
