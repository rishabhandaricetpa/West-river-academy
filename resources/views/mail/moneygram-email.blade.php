<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 style="font-family:'Catamaran', sans-serif; color:black;">MoneyGram Payment</h3>

    <p style="font-family:'Catamaran', sans-serif; color:black;">Hi {{ $user->name }},</p>
    <p style="font-family:'Catamaran', sans-serif; color:black;">Thank you for your order. To pay the total of
        ${{ $amount }} by MoneyGram, please log in to your online account to open the web page with MoneyGram
        payment instructions.
        </br></br><a
            href="http://westriveracademy.test/moneygram-transfer">http://westriveracademy.test/moneygram-transfer</a>
    </p>

    <p style="font-family:'Catamaran', sans-serif; color:black;">We will notify you by the email and in your account
        notifications when payment has been received.</p>

    <address style="font-family:'Catamaran', sans-serif; color:black;font-style: normal;">
        <p style="font-family:'Catamaran', sans-serif; color:black;"> Thank you,</p>
        <a href="contact@westriveracademy.com">The West River Academy Team</a><br>
    </address>
</body>

</html>
