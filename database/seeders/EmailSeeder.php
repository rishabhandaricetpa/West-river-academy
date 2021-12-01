<?php

namespace Database\Seeders;

use App\Models\EmailEdits;
use DB;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['type' => 'enrollment', 'content' => '<p>Hi,</p>

<p><b></b>student_name<b></b>&nbsp; &nbsp;has successfully enrolled from&nbsp; enrollment_start_date &nbsp; to enrollment_end_date .</p>
<p>Thank You!</p>
<p></p>'],
            ['type' => 'graduation', 'content' => '<h4>Hi,</h4>

<p><b>We have reviewed your application to graduate and approved it. Please log in to your account and pay the
        Graduation
        Fee of $total_fees , which includes the Graduation Project, high school diploma.</b></p>

<p><b>We look forward to working with you and helping you graduate from West River Academy.&nbsp;</b></p>
<p><b>Thank You!&nbsp;</b></p>'],
            ['type' => 'moneygram', 'content' => '<h3>MoneyGram Payment</h3>

<h3>Hi user_name ,</h3>
<p>Thank you for your order. To pay the total of
    $amount  by MoneyGram, please log in to your online account to open the web page with MoneyGram
    payment instructions.
    <a target="_blank" rel="nofollow" href="http://westriveracademy.test/moneygram-transfer">http://westriveracademy.test/moneygram-transfer</a>
</p>

<p>We will notify you by the email and in your account
    notifications when payment has been received.</p>


<p> Thank you,</p>

<a target="_blank" rel="nofollow">The West River Academy Team</a><br>'],
            ['type' => 'moneyorder', 'content' => '<h3>West River Academy - Check Or Money Order Instructions
    </h3>
    <p>Hi user_name  ,</p>
    <b></b>Thank<b></b> you for your order. To
        pay by check or money order, please:<br> 
    <p> 1. Make your check or money
        order payment to West River Academy.<br></p>
    <p></p>



    
        <p> West River Academy</p>
        <p> 33721 Bluewater Lane</p>
        <p> Dana Point, CA 92629</p>

        <p></p>
    

    <p>We will notify you by the email and in your account
        notifications when payment has been received.</p>

    
        <p> Thank you,</p>
        <a target="_blank" rel="nofollow">The West River Academy Team</a><br>'],
            ['type' => 'banktransfer', 'content' => '<h3>West River Academy - Bank Transfer Instructions</h3>

<p>Hi user_name ,</p>
<p>Thank you for your order. To pay the total of
    $amount  by Bank Transfer, please log in to your online account to open the web page with Bank Transfer
    instructions.

</p><p>We will notify you by email and in your account
    notifications when payment has been received.</p>
<p> Thank you,</p>

    <a target="_blank" rel="nofollow">The West River
        Academy Team</a><br>'],
            ['type' => 'transcript_approved', 'content' => '<h2>Hi, </h2>
<p><b></b><b>Transcript Received</b><b></b></p>

<p>We have recived an transcript will review the same and then you can
    download the Signed Transcript</p>

Your Address

    Written by <a target="_blank" rel="nofollow">West River Academy</a>.<br>
    Visit us at: <a target="_blank" rel="nofollow" href="https://www.westriveracademy.com/">https://www.westriveracademy.com/</a>'],

        ];
        EmailEdits::insert($data);
    }
}
