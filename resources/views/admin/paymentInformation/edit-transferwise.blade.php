@extends('admin.app')

@section('content')
<section class="content">
  <div class="container-fluid position-relative">
    <h1>Edit Transfer Wise Address</h1>
    <div class="form-wrap border py-5 px-25 position-relative">
      <form method="post" class="row" action="{{url('admin/update/transferwise',$tranferWise->id)}}">
        @csrf
        <div class="form-group col-sm-6">
          <label>User Status<sup>*</sup></label>
          <select id="status" name="status" value="{{$tranferWise->status==1?'Active':'Inactive'}}">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
        <div class="form-group col-sm-6">
          <label>Account Holder<sup>*</sup></label>
          <input class="form-control" id="account_holder" value="{{$tranferWise->account_holder}}" name="account_holder">
        </div>
        <div class="form-group col-sm-6">
          <label>Account Number</label>
          <input class="form-control" id="account_number" name="account_number" value="{{$tranferWise->account_number}}">
        </div>
        <div class="form-group col-sm-6">
          <label>Wire Transfer number <sup>*</sup></label>
          <input class="form-control" id="wire_transfer_number" name="wire_transfer_number" value="{{$tranferWise->wire_transfer_number}}">
        </div>
        <div class="form-group col-sm-6">
          <label>Swift Code</label>
          <input class="form-control" name="swift_code" id="swift_code" value="{{$tranferWise->swift_code}}">
        </div>
        <div class="form-group col-sm-6">
          <label>Routing Number</label>
          <input class="form-control" id="routing_number" name="routing_number" value="{{$tranferWise->routing_number}}">
        </div>
        <div class="form-group col-sm-6">
          <label>Address</label>
          <input class="form-control" id="address" name="address" value="{{$tranferWise->address}}">
        </div>
        <div class="form-group col-sm-6">
          <label>State</label>
          <input class="form-control" id="state" name="state" value="{{$tranferWise->state}}">
        </div>
        <div class="form-group col-sm-6">
          <label>Country</label>
          <input class="form-control" id="country" name="country" value="{{$tranferWise->country}}">
        </div>
        <div class="form-group col-sm-6">
          <label>Website</label>
          <input class="form-control" id="website" name="website" value="{{$tranferWise->website}}">
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