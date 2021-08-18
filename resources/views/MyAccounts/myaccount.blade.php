@extends('layouts.app')
@section('pageTitle', 'MyAccount')
@section('content')
<!-- * =============== Main =============== * -->

<main class="position-relative container form-content mt-4">
  <div class="form-wrap border bg-light py-5 px-25">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <form class="row">
      <div class="col-md-6">
        <h2 class="mb-3">User Information</h2>
        <div class="form-group d-sm-flex mb-2">
          <label for="">First Name</label>
          <div>{{ $parent->p1_first_name }}</div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Last Name</label>
          <div>{{ $parent->p1_last_name }}</div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Email</label>
          <div>{{ $parent->p1_email }}</div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Phone</label>
          <div>{{ $parent->p1_cell_phone }}</div>
        </div>
        <a href="{{ url('/editaccount', $user_id) }}" class="btn btn-primary">Edit Your Login</a>
      </div>

      <div class="col-md-6">
        <h2 class="mb-3">Password</h2>
        <form>
          <div class="form-group ">
            <label for="">Password</label>
            <div>********</div>
          </div>
          <a href="{{ route('reset.password', $user_id) }}" class="btn btn-primary">Change Your
            Password?</a>

      </div>
  </div>

  <div class="form-wrap row border bg-light py-5 px-25 mt-2r ">
    <div class="col-md-6">
      <h2 class="mb-3">Mailing Address</h2>
      <form>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Street Address</label>
          <div>{{ $parent->street_address }}</div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">City</label>
          <div>{{ $parent->city }}</div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">State</label>
          <div>{{ $parent->state }}</div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Zip code</label>
          <div>{{ $parent->zip_code }}</div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Country</label>
          <div>{{ $parent->country }}</div>
        </div>
        <a href="{{ route('editMailingAddress', $user_id) }}" class="btn btn-primary">Edit Your Mailing
          Address</a>
      </form>
    </div>

    <div class="col-md-6">
      <h2 class="mb-3">Parent 2 Information</h2>
      <form>
        <div class="form-group d-sm-flex mb-2">
          <label for=""> Name</label>
          <div>{{ $parent->p2_first_name }}</div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Last Name</label>
          <div>{{ $parent->p2_last_name }}</div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Email</label>
          <div>{{ $parent->p2_email }}</div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Cell Phone</label>
          <div>{{ $parent->p2_cell_phone }}</div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Phone Number</label>
          <div>{{ $parent->p2_home_phone }}</div>
        </div>
        <a href="{{ url('/editaccount', $user_id) }}" class="btn btn-primary">Edit Your Login</a>
    </div>
  </div>


  <!-- Transcript Payment History Start-->
  @if (count($payment_history) > 0)
  <div class="form-wrap border bg-light py-5 px-25 mt-2r">
    <h2 class="mb-3">Payment History</h2>
    <div class="overflow-auto max-table">
      <table class="table-styling w-100 table-vertical_scroll">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
            {{-- <th scope="col">Coupon Amount</th> --}}
            <th scope="col">Amount Total</th>
            <th scope="col">Payment Method</th>
            <th scope="col">View Order</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($payment_history as $payment)
          <tr>
            <td>{{ formatDate($payment->created_at)}}</td>
              @if($payment->status=='pending')
            <td>Pending</td>
            @elseif($payment->status=='succeeded')
            <td>Paid</td>
            @elseif($payment->status=='paid')
            <td>Paid</td>
            @else
            <td>{{$payment->status}}</td>
            @endif
            {{-- @if($payment->coupon_amount==0)
            <td>-</td>
            @else
            <td>${{ $payment->coupon_amount}}</td>
            @endif --}}
            <td>${{ $payment->amount }}</td>
            <td>{{ $payment->payment_mode}}</td>
            <td><a href="javascript:void(0)" class="btn btn-primary btn-modal ml-3 passID" data-toggle="modal"  data-target="#Payment-details-Modal" data-id="{{ $payment->transcation_id }}" onclick="viewOrders(event.target)" data-whatever="@getbootstrap">View Order</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
  

      <div class="modal fade bd-example-modal-lg mt-5" id="Payment-details-Modal" tabindex="-1" role="dialog"
        aria-labelledby="Payment-details-ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="Payment-details-Label">View Order Detail</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">Close</span>
              </button>
          </div>
           
            <div class="modal-body">
              <div class="overflow-auto max-table">
                <table class="table-styling w-100 table-vertical_scroll">
                  <thead>
                    <td>Name</td>
                    <td>Item Type</td>
                    <td>Amount</td>
                  </thead>
                  <tbody id="paymeny_history_wrapper">
                  </tbody>
                  <tfoot class="bg-light">
                    <tr>
                      
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>

          </div>
          </form>
        </div>
      </div>
      <div>
      </div>
    </div>
  </div>
  @endif

</main>

<!-- * =============== /Main =============== * -->
@endsection
