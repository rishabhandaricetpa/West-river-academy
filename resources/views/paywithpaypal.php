<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paypal Payment</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form" action="/paypal">
        @csrf
        <h2 class="w3-text-blue">Payment Form</h2>
        <p>Demo PayPal form - Integrating paypal in laravel</p>
        <p>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label class="w3-text-blue"><b>Enter Amount</b></label>
            <input class="w3-input w3-border" name="amount" type="text">
        </p>
        <button class="w3-btn w3-blue">Pay with PayPal</button></p>
    </form>
</body>

</html>
