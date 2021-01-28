<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Hi {{$user->name}} </h2>,
PAYMENT: Bank Transfer
Use the following link to access the bank info in the private area of the website. You will need to log in to open the web page.
http://westriveracademy.test/moneygram-transfer

Please let us know when you have made the payment and if you have used TransferWise or a regular bank transfer.

DATE: {{ $date}}
PAYMENT: N/A

BILLING INFORMATION

{{$address->street_address}}.,<
------------
ITEM: CUSTPAYMENT
Custom Payment
PRICE: $0.00
QT: 1
ITEM TOTAL: $0.00

TOTAL: $0.00


</p>

</body>
</html>