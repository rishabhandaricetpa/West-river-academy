@extends('layouts.app')
@section('pageTitle', 'Billing Information')
@section('content')

<main class="position-relative container form-content mt-4">
   <h1 class="text-center text-white text-uppercase">Bank Transfers</h1>
   <div class="form-wrap border bg-light py-5 px-25 mt-2r">
      <h2 class="mb-3">MoneyGram Information</h2>
      <p>To pay by MoneyGram, use these details:</p>
      <form method="POST" class="mb-0">
         <div class="form-group d-sm-flex mb-2">
            <label for="">Name</label>
            <div>{{$moneyGram->name}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Address</label>
            <div>{{$moneyGram->address}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">City</label>
            <div>
               <p>{{$moneyGram->city}}</p>
            </div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">State</label>
            <div>{{$moneyGram->state}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Zip</label>
            <div>{{$moneyGram->zip}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">ID</label>
            <div>{{$moneyGram->money_gram_id}}</div>
         </div>
         <p>Please email us the reference number, remitter and amount after you have made the payment.</p>
      </form>
   </div>
   <div class="form-wrap border bg-light py-2r px-25 mt-2r">
      <a href="/dashboard" class="btn btn-primary">Return to the Dashboard</a>
   </div>
</main>

@endsection