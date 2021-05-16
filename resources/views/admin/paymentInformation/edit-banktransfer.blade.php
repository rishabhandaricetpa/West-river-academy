@extends('admin.app')

@section('content')
<section class="content">
  <div class="container-fluid position-relative">
    <h1>Edit Bank Transfer Address</h1>
    <div class="form-wrap border py-5 px-25 position-relative">
      <form method="post" class="row" action="{{url('admin/update/banktransfer',$banktransfer->id)}}">
        @csrf
        <div class="form-group col-sm-6">
          <label>User Status<sup>*</sup></label>
          <select id="status" class="form-control" name="status" value="{{$banktransfer->status==1?'Active':'Inactive'}}" required>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
        <div class="form-group col-sm-6">
          <label>Bank Name<sup>*</sup></label>
          <input class="form-control" id="bank_name" value="{{$banktransfer->bank_name}}" name="bank_name" required>
        </div>
        <div class="form-group col-sm-6">
          <label>Swift Code</label>
          <input class="form-control" id="swift_code" name="swift_code" value="{{$banktransfer->swift_code}}" required>
        </div>
        <div class="form-group col-sm-6">
          <label>Bank Address <sup>*</sup></label>
          <input class="form-control" id="bank_address" name="bank_address" value="{{$banktransfer->bank_address}}" required>
        </div>
        <div class="form-group col-sm-6">
          <label>Street <sup>*</sup></label>
          <input class="form-control" id="street" name="street" value="{{$banktransfer->street}}" required>
        </div>
        <div class="form-group col-sm-6">
          <label>phone Number</label>
          <input class="form-control" name="phone_number" id="phone_number" value="{{$banktransfer->phone_number}}" required>
        </div>
        <div class="form-group col-sm-6">
          <label>Routing Number</label>
          <input class="form-control" id="routing_number" name="routing_number" value="{{$banktransfer->routing_number}}" required>
        </div>
        <div class="form-group col-sm-6">
          <label>Account Name</label>
          <input class="form-control" id="account_name" name="account_name" value="{{$banktransfer->account_name}}" required>
        </div>
        <div class="form-group col-sm-6">
          <label>Account Number</label>
          <input class="form-control" id="account_number" name="account_number" value="{{$banktransfer->account_number}}" required>
        </div>
        <!-- /.card-body -->
        <div class="col-sm-12">
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="/admin/payment-address" class="btn btn-primary">Back</a>
        </div>
      </form>
    </div>
  </div>
  </div>
</section>

@endsection