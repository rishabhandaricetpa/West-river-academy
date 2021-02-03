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
              <form method="post" action="{{url('admin/update/moneygram',$moneyGram->id)}}">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label>User Status<sup>*</sup></label>
                    <select id="status" name="status" value="{{$moneyGram->status==1?'Active':'Deactive'}}">
                      <option value="1">Active</option>
                      <option value="0">Deactive</option>
                   </select>
                  </div>
                  <div class="form-group">
                    <label>Name<sup>*</sup></label>
                    <input  class="form-control" id="name" value="{{$moneyGram->name}}" name="name">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input  class="form-control" id="address" name="address" value="{{$moneyGram->address}}">
                  </div>
                  <div class="form-group">
                    <label>City <sup>*</sup></label>
                    <input  class="form-control" id="city" name="city" value="{{$moneyGram->city}}">
                  </div>
                  <div class="form-group">
                    <label>State</label>
                    <input  class="form-control" name="state" id="state" value="{{$moneyGram->state}}">
                  </div>
                  <div class="form-group">
                    <label>Zip Code</label>
                    <input  class="form-control"  id="zip" name="zip" value="{{$moneyGram->zip}}">
                  </div>
                  <div class="form-group">
                    <label>ID</label>
                    <input  class="form-control" id="money_gram_id" name="money_gram_id" value="{{$moneyGram->money_gram_id}}">
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


