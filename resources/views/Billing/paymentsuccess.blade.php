
@extends('layouts.app')

@section('content')

<main class="position-relative container form-content mt-4">
  <div class="form-wrap border bg-light form-content small-container">
  <!-- <form method="post" action="{{route('payment.info',$charges->id)}}"> -->
    @csrf
    <h2 class="text-capitalize">Thank you!</h2>
    <p class="mb-0">Your Transaction with Stripe is successfull.Your order id is Transaction Id: {{$charges->id}}
    <a href="{{route('dashboard')}}" class="btn btn-primary">Go to Dashboard</a>

    </p>
  </div>
@endsection