<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2 style="font-family:'Catamaran', sans-serif;">Hi, {{$user->name}}</h2>
    <h3 style="font-family:'Catamaran', sans-serif;">PAYMENT: Bank Transfer</h3>
    <p style="font-family:'Catamaran', sans-serif;">Use the following link to access the bank info in the private area of the website. You will need to log in to open the web page. <a href="http://westriveracademy.test/bank-transfer">http://westriveracademy.test/bank-transfer</a></p>

    <p style="font-family:'Catamaran', sans-serif;">Please let us know when you have made the payment and if you have used TransferWise or a regular bank transfer.</p>
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
                <td style="padding:8px;">Bank Transfer</td>
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

    Your Address
    <address style="font-family:'Catamaran', sans-serif;">
        Written by <a href="mailto:xyz@example.com">West River Academy</a>.<br>
        <p>contact@westriveracademy.com</p>
        Visit us at: https://www.westriveracademy.com/
    </address>
</body>

</html>