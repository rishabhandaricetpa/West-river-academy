<?php

namespace App\Mail;

use App\Models\StudentProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrollmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $enrollment_period;
    public function __construct($enrollment_period)
    {
        $this->enrollment_period = $enrollment_period;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $student_id = $this->enrollment_period->student_profile_id;
        $enrollment_start_date = formatDate($this->enrollment_period->start_date_of_enrollment);
        $enrollment_end_date = formatDate($this->enrollment_period->end_date_of_enrollment);
        $student = StudentProfile::where('id', $student_id)->first();
        $student_name = $student->first_name;
        return  $this->markdown('mail.enrollment-confirmation', compact('student_name', 'enrollment_start_date', 'enrollment_end_date'))->subject('Successfully Enrolled');
    }
}
