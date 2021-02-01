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
              <form method="post" action="{{url('admin/update/transferwise',$tranferWise->id)}}">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label>User Status<sup>*</sup></label>
                    <select id="status" name="status" value="{{$tranferWise->status==1?'Active':'Deactive'}}">
                      <option value="1">Active</option>
                      <option value="0">Deactive</option>
                   </select>
                  </div>
                  <div class="form-group">
                    <label>Account Holder<sup>*</sup></label>
                    <input  class="form-control" id="account_holder" value="{{$tranferWise->account_holder}}" name="account_holder">
                  </div>
                  <div class="form-group">
                    <label>Account Number</label>
                    <input  class="form-control" id="account_number" name="account_number" value="{{$tranferWise->account_number}}">
                  </div>
                  <div class="form-group">
                    <label>Wire Transfer number <sup>*</sup></label>
                    <input  class="form-control" id="wire_transfer_number" name="wire_transfer_number" value="{{$tranferWise->wire_transfer_number}}">
                  </div>
                  <div class="form-group">
                    <label>Swift Code</label>
                    <input  class="form-control" name="swift_code" id="swift_code" value="{{$tranferWise->swift_code}}">
                  </div>
                  <div class="form-group">
                    <label>Routing Number</label>
                    <input  class="form-control"  id="routing_number" name="routing_number" value="{{$tranferWise->routing_number}}">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input  class="form-control" id="address" name="address" value="{{$tranferWise->address}}">
                  </div>
                  <div class="form-group">
                    <label>State</label>
                    <input  class="form-control" id="state" name="state" value="{{$tranferWise->state}}">
                  </div>
                  <div class="form-group">
                    <label>Country</label>
                    <input  class="form-control" id="country" name="country" value="{{$tranferWise->country}}">
                  </div> 
                  <div class="form-group">
                    <label>Website</label>
                    <input  class="form-control" id="website" name="website" value="{{$tranferWise->website}}">
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


