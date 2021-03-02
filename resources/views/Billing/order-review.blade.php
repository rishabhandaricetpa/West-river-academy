@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->

<main class="position-relative container form-content mt-4">
   <div class="form-wrap border bg-light py-5 px-25">
      <h2 class="mb-3">Billing Information</h2>
      <form method="get" action="{{route('bank.transfer',$final_amount)}}">
         <div class="form-group d-flex mb-2">
            <label for="">Name</label>
            <div class="ml-auto">{{$address->p1_first_name}} </div>
         </div>
         <div class="form-group d-flex mb-2">
            <label for="">Street</label>
            <div class="ml-auto">{{$address->street_address}} </div>
         </div>
         <div class="form-group d-flex mb-2">
            <label for="">City</label>
            <div class="ml-auto">{{$address->city}}</div>
         </div>
         <div class="form-group d-flex mb-2">
            <label for="">State</label>
            <div class="ml-auto">{{$address->state}}</div>
         </div>
         <div class="form-group d-flex mb-2">
            <label for="">Zip Code</label>
            <div class="ml-auto">{{$address->zip_code}}</div>
         </div>
         <div class="form-group d-flex mb-2">
            <label for="">Country</label>
            <div class="ml-auto">{{$address->country}}</div>
         </div>

   </div>
   <div class="form-wrap border bg-light py-5 px-25 mt-2r">
      <h2 class="mb-3">Payment Total</h2>
      <div class="form-group d-flex mb-2">
         <label for="">Order Total</label>
         <div class="ml-auto"><i class="fas fa-dollar-sign"></i>{{$final_amount}}</div>
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