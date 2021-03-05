<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2 style="font-family:'Catamaran', sans-serif;">Hi, {{$user->name}}</h2>
    <h3 style="font-family:'Catamaran', sans-serif;">PAYMENT: Check Or Money Order</h3>
    <p style="font-family:'Catamaran', sans-serif;">Use the following address to make Checks payable to: West River Academy</p>

    <h3>BILLING INFORMATION</h3>
    <table border="1" style="border-collapse:collapse; margin: 20px 0;font-family:'Catamaran', sans-serif;" rowspan>
        <thead>
            <tr>
                <th style="padding:8px;text-align:left" scope="row">DATE</th>
                <td style="padding:8px;text-align:left"> {{$date}}</td>
            </tr>
        </thead>
        <tbody>
            <tr>

                <th style="padding:8px;" scope="row">PAYMENT MODE</th>
                <td style="padding:8px;">Check Or Money Order</td>
            </tr>
            <tr>

                <th style="padding:8px;" scope="row">TOTAL TO PAY</th>
                <td style="padding:8px;">${{$amount}}</td>
            </tr>
            <tr>

                <th style="padding:8px;" scope="row">ADDRESS</th>
                <td style="padding:8px;">{{$address->street_address .'  ' . $address->city.'  '.$address->state }}</td>
            </tr>
        </tbody>
    </table>

    <p>Send Payments to:</p>
    <address style="font-family:'Catamaran', sans-serif;">
        West River Academy
        33721 Bluewater Lane
        Dana Point, CA 92629
    </address>

    <address style="font-family:'Catamaran', sans-serif;">
        Written by <a href="mailto:xyz@example.com">West River Academy</a>.<br>
        Visit us at: https://www.westriveracademy.com/
    </address>
</body>

</html>