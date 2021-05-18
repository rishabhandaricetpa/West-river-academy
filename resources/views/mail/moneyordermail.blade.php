<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 style="font-family:'Catamaran', sans-serif; color:black;">West River Academy</h3> 
    <h3 style="font-family:'Catamaran', sans-serif; color:black;">Check Or Money Order Instructions</h3> 
    <h3 style="font-family:'Catamaran', sans-serif; color:black;">Hi {{$user->name}},</h3>
    <p style="font-family:'Catamaran', sans-serif; color:black;">Thank you for your order. To pay by the check or money order:</p>
    <p style="font-family:'Catamaran', sans-serif; color:black;">1. Make your check for ${{$amount}} payable to West River Academy.</p>
    <p style="font-family:'Catamaran', sans-serif; color:black;">2. Mail your check or money order to:</p>

    <address style="font-family:'Catamaran', sans-serif; color:black;">
       <p> West River Academy</p></br>
       <p> 33721 Bluewater Lane</p></br>
       <p> Dana Point, CA 92629</p></br>
    </address>

    <p style="font-family:'Catamaran', sans-serif; color:black;">We will notify you by the email and in your account notifications when payment has been received.</p>

    <address style="font-family:'Catamaran', sans-serif; color:black;">
        <a href="contact@westriveracademy.com">The West River Academy Team</a><br>
    </address>
</body>

</html>