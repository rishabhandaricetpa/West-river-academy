@extends('admin.app')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Parent Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{url('admin/update/banktransfer',$banktransfer->id)}}">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label>User Status<sup>*</sup></label>
                    <select id="status" name="status" value="{{$banktransfer->status==1?'Active':'Deactive'}}">
                      <option value="1">Active</option>
                      <option value="0">Deactive</option>
                   </select>
                  </div>
                  <div class="form-group">
                    <label>Bank Name<sup>*</sup></label>
                    <input  class="form-control" id="bank_name" value="{{$banktransfer->bank_name}}" name="bank_name">
                  </div>
                  <div class="form-group">
                    <label>Swift Code</label>
                    <input  class="form-control" id="swift_code" name="swift_code" value="{{$banktransfer->swift_code}}">
                  </div>
                  <div class="form-group">
                    <label>Bank Address <sup>*</sup></label>
                    <input  class="form-control" id="bank_address" name="bank_address" value="{{$banktransfer->bank_address}}">
                  </div>
                  <div class="form-group">
                    <label>Street <sup>*</sup></label>
                    <input  class="form-control" id="street" name="street" value="{{$banktransfer->street}}">
                  </div>
                  <div class="form-group">
                    <label>phone Number</label>
                    <input  class="form-control" name="phone_number" id="phone_number" value="{{$banktransfer->phone_number}}">
                  </div>
                  <div class="form-group">
                    <label>Routing Number</label>
                    <input  class="form-control"  id="routing_number" name="routing_number" value="{{$banktransfer->routing_number}}">
                  </div>
                  <div class="form-group">
                    <label>Account Name</label>
                    <input  class="form-control" id="account_name" name="account_name" value="{{$banktransfer->account_name}}">
                  </div>
                  <div class="form-group">
                    <label>Account Number</label>
                    <input  class="form-control" id="account_number" name="account_number" value="{{$banktransfer->account_number}}">
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="/admin/payment-address" class="btn btn-primary">Back</a>
                </div>
              </form>
            </div>
            <!-- /.card -->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>

@endsection


