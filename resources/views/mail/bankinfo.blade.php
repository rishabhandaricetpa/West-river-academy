<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2 style="font-family:'Catamaran', sans-serif;">Hi, {{$user->name}}</h2>
    <h3 style="font-family:'Catamaran', sans-serif;">Bank Transfer Instructions</h3>
    <p style="font-family:'Catamaran', sans-serif;">Thank you for your order. To pay the total of ${{$amount}} by the bank transfer, please log in your online account to open the web page with Bank Transfer instructions.<a href="http://westriveracademy.test/bank-transfer">http://westriveracademy.test/bank-transfer</a></p>

    <p style="font-family:'Catamaran', sans-serif;">We will notify you by the email and in your account notifications when payment has been received.</p>

    <address style="font-family:'Catamaran', sans-serif;">
        <a href="contact@westriveracademy.com">The West River Academy Team</a><br>
    </address>
</body>

</html>