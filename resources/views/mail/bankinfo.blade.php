<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<h3 style="font-family:'Catamaran', sans-serif; color:black;">West River Academy - Bank Transfer Instructions</h3> 
   
    <h2 style="font-family:'Catamaran', sans-serif;color:black;">Hi {{$user->name}},</h2>
    <p style="font-family:'Catamaran', sans-serif;color:black;">Thank you for your order. To pay the total of ${{$amount}} by bank transfer, please log in to your online account to open the web page with Bank Transfer instructions.
    </br><a href="http://westriveracademy.test/bank-transfer"> {{env('APP_URL')}}/bank-transfer</a></p>
    <p style="font-family:'Catamaran', sans-serif;color:black;">We will notify you by email and in your account notifications when payment has been received.</p>

    <address style="font-family:'Catamaran', sans-serif;color:black;">
        <h3 style="font-family:'Catamaran', sans-serif; color:black;"> Thank you,</h3> 
        <a  style="font-family:'Catamaran', sans-serif; color:black;" href="contact@westriveracademy.com">The West River Academy Team</a><br>
    </address>
</body>

</html>