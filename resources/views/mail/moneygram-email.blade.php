<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 style="font-family:'Catamaran', sans-serif;">West River Academy</h3> 
    <h3 style="font-family:'Catamaran', sans-serif;">MoneyGram Payment</h3> 

    <h2 style="font-family:'Catamaran', sans-serif;">Hi, {{$user->name}}</h2>
    <p style="font-family:'Catamaran', sans-serif;">Thank you for your order. To pay the total of ${{$amount}} by MoneyGram, please log in to your online account to open the web page with MoneyGram payment instructions. <a href="http://westriveracademy.test/moneygram-transfer">http://westriveracademy.test/moneygram-transfer</a></p>

    <p style="font-family:'Catamaran', sans-serif;">We will notify you by the email and in your account notifications when payment has been received.</p>

    <address style="font-family:'Catamaran', sans-serif;">
        <a href="contact@westriveracademy.com">The West River Academy Team</a><br>
    </address>
</body>

</html>