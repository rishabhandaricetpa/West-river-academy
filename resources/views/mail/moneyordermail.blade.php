<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 style="font-family:'Catamaran', sans-serif;">West River Academy</h3> 
    <h3 style="font-family:'Catamaran', sans-serif;">Check Or Money Order Instructions</h3> 
    <h3 style="font-family:'Catamaran', sans-serif;">Hi, {{$user->name}}</h3>
    <p style="font-family:'Catamaran', sans-serif;">Thank you for your order. To pay by the check or money order:</p>
    <p style="font-family:'Catamaran', sans-serif;">1. Make your check for ${{$amount}} payable to West River Academy.</p>
    <p style="font-family:'Catamaran', sans-serif;">2. Mail your check or money order to:</p>

    <address style="font-family:'Catamaran', sans-serif;">
        West River Academy
        33721 Bluewater Lane
        Dana Point, CA 92629
    </address>

    <p style="font-family:'Catamaran', sans-serif;">We will notify you by the email and in your account notifications when payment has been received.</p>

    <address style="font-family:'Catamaran', sans-serif;">
        <a href="contact@westriveracademy.com">The West River Academy Team</a><br>
    </address>
</body>

</html>