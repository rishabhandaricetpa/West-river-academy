<?php

namespace App\Mail;

use App\Models\RecordTransfer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyToParentRecordReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $record, $parent;
    public function __construct($record, $parent)
    {
        $this->record = $record;
        $this->parent = $parent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $school_data = $this->record->school_name;
        $parent_name = $this->parent->fullname;
        return  $this->markdown('mail.record-received', compact('school_data', 'parent_name'))->subject('Successfully Received Records');
    }
}
