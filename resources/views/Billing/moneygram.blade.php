@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
   <div class="form-wrap border bg-light py-5 px-25">
      <h2 class="mb-3">Billing Information</h2>
      <form method="get" action="{{ url('moneygram-email')}}">
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
      <h2 class="mb-3">Payment Items</h2>
      <div class="seperator overflow-auto">
       <table class="w-100 table-styling">
          <thead>
             <tr>
                <th>item</th>
                <th>quantity</th>
                <th>price</th>
                <th>total</th>
             </tr>
          </thead>
          <tbody>
             <tr>
                <td>
                Custom Payment
                </td>
                <td>
                   1
                </td>
                <td>
                <i class="fas fa-dollar-sign"></i>{{$enroll_fees->amount}}
                </td>
                <td>
                <i class="fas fa-dollar-sign"></i>{{$enroll_fees->amount}}
                </td>
             </tr>
          </tbody>
          <tfoot>
             <tr>
                <td>
                Total price
                </td>
                <td><i class="fas fa-dollar-sign"></i>{{$enroll_fees->amount}}</td>
             </tr>
          </tfoot>
       </table>
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


