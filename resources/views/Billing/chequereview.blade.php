@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->

<main class="position-relative container form-content mt-4">
   <div class="form-wrap border bg-light py-5 px-25">
      <h2 class="mb-3">Billing Information</h2>
      <form method="get" action="{{url('moneyorder-email')}}">
         <div class="form-group d-sm-flex mb-2">
            <label for="">Name</label>
            <div>{{$address->p1_first_name}} </div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Street</label>
            <div>{{$address->street_address}} </div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">City</label>
            <div>{{$address->city}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">State</label>
            <div>{{$address->state}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Zip Code</label>
            <div>{{$address->zip_code}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Country</label>
            <div>{{$address->country}}</div>
         </div>
     
   </div>
   <div class="form-wrap border bg-light py-5 px-25 mt-2r">
      <h2 class="mb-3">Payment Items</h2>
      <div class="seperator">
      <div class="row gray-bg py-2 text-capitalize">
        <div class="col-sm-3">
        <span>item</span>
        </div>
        <div class="col-sm-3">
        <span>quantity</span>
        </div>
        <div class="col-sm-3">
        <span>price</span>
        </div>
        <div class="col-sm-3">
        <span>total</span>
        </div>
   </div>
   <div class="row py-2">
        <div class="col-sm-3">
        <span>Custom Payment</span>
        </div>
        <div class="col-sm-3">
        <span>1</span>
        </div>
        <div class="col-sm-3">
        <span><i class="fas fa-dollar-sign"></i>{{$enroll_fees->amount}}</span>
        </div>
        <div class="col-sm-3">
        <span><i class="fas fa-dollar-sign"></i>{{$enroll_fees->amount}}</span>
        </div>
      </div>
      </div>
      <div class="total-amount pt-5">
      <span>Total price</span>
      <span class="float-right"><i class="fas fa-dollar-sign"></i>{{$enroll_fees->amount}}</span>
      </div>
</div>
<div class="form-wrap border bg-light py-2r px-25 mt-2r">
      <a href="#" class="btn btn-primary">cancel</a>
      <a href="{{route('edit.address',$parent_id)}}" class="btn btn-primary">back</a>
      <button type="submit" class="btn btn-primary">submit payment</button>
   </div>
   </form>
</main>

    <!-- * =============== /Main =============== * -->
@endsection


