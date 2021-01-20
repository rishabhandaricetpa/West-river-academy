
@extends('layouts.app')

@section('content')
  <main class="position-relative container form-content mt-4">
  <div class="form-wrap border bg-light form-content small-container">
     <h2>Make a Paypal Payment</h2>
       <form method="POST" id="payment-form" action="/paypal" class="mb-0">
      @csrf
      <div class="form-group d-sm-flex mb-2">
        <label for="">Amount</label>
        <div class="d-flex align-items-center">
        <i class="fas fa-dollar-sign additional-sign"></i>
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <!-- <span class="input-group-text">$</span> -->
        <input class="form-control" type="number" name="amount" id="amount" type="text" value="{{$enroll_fees?$enroll_fees->amount:''}}" readonly> 
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="exampleInputPassword1">What are you paying for?</label>
        <div>
          <input type="text" class="form-control" >
        </div>
      </div>
      <div class="mt-2r">
        <button type="submit" class="btn btn-primary">Pay with PayPal</button>
      </div>
    </form>  
    </div>         
  </main>
@endsection