@extends('layouts.app')
@section('pageTitle', 'Billing Information')
@section('content')

<main class="position-relative container form-content mt-4">
   <h1 class="text-center text-white text-uppercase">Bank Transfers</h1>
   <div class="form-wrap border bg-light py-5 px-25">
      <h2 class="mb-3">TransferWise</h2>
      <p>If you are able to use TransferWise, it’s the least expensive way to pay your fees. Here are our Transfer details.</p>
      <form method="POST" class="mb-0">
         <div class="form-group d-sm-flex mb-2">
            <label for="">Account Holder</label>
            <div> {{$tranferwise->account_holder}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Account Number</label>
            <div>{{$tranferwise->account_number}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Wire transfer number</label>
            <div>{{$tranferwise->wire_transfer_number}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Bank code: (SWIFT / BIC)</label>
            <div>{{$tranferwise->swift_code}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Routing number (ACH or ABA)</label>
            <div>{{$tranferwise->routing_number}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Address</label>
            <div>
               <p class="mb-1">{{$tranferwise->address}}</p>
               <p class="mb-1">{{$tranferwise->state}}</p>
               <p class="mb-1"> {{$tranferwise->country}}</p>
            </div>
         </div>
         <div class="form-group d-sm-flex mb-0">
            <label for="">Website</label>
            <div><a href="{{$tranferwise->website}}">{{$tranferwise->website}}</a></div>
         </div>
      </form>
   </div>
   <div class="form-wrap border bg-light py-5 px-25 mt-2r">
      <h2 class="mb-3">Bank Information</h2>
      <p>If you cannot use TransferWise, please add $30 to your total to cover the intermediary bank charges. Here is the bank information:</p>
      <form method="POST" class="mb-0">
         <div class="form-group d-sm-flex mb-2">
            <label for="">Bank Name</label>
            <div>{{$banktransfer->bank_name}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">SWIFT code</label>
            <div>{{$banktransfer->swift_code}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Bank Address</label>
            <div>
               <p>{{$banktransfer->bank_address}}</p>
               <p>{{$banktransfer->street}}</p>
            </div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Phone Number</label>
            <div>{{$banktransfer->phone_number}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Routing Number</label>
            <div>{{$banktransfer->routing_number}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Account Name</label>
            <div>{{$banktransfer->account_name}}</div>
         </div>
         <div class="form-group d-sm-flex mb-0">
            <label for="">Account Number</label>
            <div>{{$banktransfer->account_number}}</div>
         </div>
      </form>
   </div>
   <div class="form-wrap border bg-light py-2r px-25 mt-2r">
      <a href="/dashboard" class="btn btn-primary">Return to the Dashboard</a>
   </div>
</main>

@endsection