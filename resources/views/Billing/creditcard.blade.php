<head>
    <title>Credit Card Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>

@extends('layouts.app')
@section('pageTitle', 'Payment Details')
@section('content')
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Payment Details</h1>

    <div class="form-wrap border bg-light py-5 px-25">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <h2 class="panel-heading mb-0">Payment Details</h2>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{ route('stripe.payment') }}" method="post" class="validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Name on Card<sup>*</sup></label> <input class='form-control' size='4' type='text'>
                                </div>
                            </div>

                            <div class='form-row row'>
                                <div class='col-xs-12 form-group card required border-0'>
                                    <label class='control-label'>Card Number<sup>*</sup></label> <input autocomplete='off' class='form-control card-num' size='20' type='text'>
                                </div>
                            </div>

                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC<sup>*</sup></label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Month<sup>*</sup></label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year<sup>*</sup></label> <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                </div>
                                <div class='form-row row col-12'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>What are you paying for?</label> <input class='form-control' size='4' type='text' name="description" required>
                                    </div>
                                </div>
                            </div>

                            <div class='form-row row'>
                                <div class='col-md-12 hide error form-group'>
                                    <div class='alert-danger alert'>Please fill the Required fields.</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now <i class="fas fa-dollar-sign"></i>{{$final_amount}}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection