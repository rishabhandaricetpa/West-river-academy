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
              <form method="get" action="{{route('admin.parent.update',$parent->id)}}">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label>User Status<sup>*</sup></label>
                    <select id="status" name="status" value="{{$parent->status==0?'Active':'Deactive'}}">
                      <option value="0">Active</option>
                      <option value="1">Deactive</option>
                   </select>
                  </div>
                  <div class="form-group">
                    <label>Parent1 First/Given Name <sup>*</sup></label>
                    <input  class="form-control" id="p1_first_name" value="{{$parent->p1_first_name}}" name="p1_first_name">
                  </div>
                  <div class="form-group">
                    <label>Parent1 Middle Name</label>
                    <input  class="form-control" id="p1_middle_name" name="p1_middle_name" value="{{$parent->p1_middle_name}}">
                  </div>
                  <div class="form-group">
                    <label>Parent1 Last/Family Name <sup>*</sup></label>
                    <input  class="form-control" id="p1_last_name" name="p1_last_name" value="{{$parent->p1_last_name}}">
                  </div>
                  <div class="form-group">
                    <label>Parent1 Email<sup>*</sup>  <i class="fas fa-calendar-alt" aria-hidden="true"></i></label>
                    <input  class="form-control" id="p1_email" name="p1_email" value="{{$parent->p1_email}}" >
                  </div>
                  <div class="form-group">
                    <label>Parent1 Cell Phone</label>
                    <input  class="form-control" name="p1_cell_phone" id="p1_cell_phone" value="{{$parent->p1_cell_phone}}">
                  </div>
                  <div class="form-group">
                    <label>Parent1 Home Phone</label>
                    <input  class="form-control"  id="p1_home_phone" name="p1_home_phone" value="{{$parent->p1_home_phone}}">
                  </div>
                  <div class="form-group">
                    <label>Parent2 First/Given Name</label>
                    <input  class="form-control" id="p2_first_name" value="{{$parent->p2_first_name}}" name="p2_first_name">
                  </div>
                  <div class="form-group">
                    <label>Parent2 Middle Name</label>
                    <input  class="form-control" id="p2_middle_name" name="p2_middle_name" value="{{$parent->p2_middle_name}}">
                  </div>
                  <div class="form-group">
                    <label>Parent2 Email<i class="fas fa-calendar-alt" aria-hidden="true"></i></label>
                    <input  class="form-control" id="p2_email" name="p2_email" value="{{$parent->p2_email}}" >
                  </div>
                  <div class="form-group">
                    <label>Parent2 Cell Phone</label>
                    <input  class="form-control" name="p2_cell_phone" id="p2_cell_phone" value="{{$parent->p2_cell_phone}}">
                  </div>
                  <div class="form-group">
                    <label>Parent2 Home Phone</label>
                    <input  class="form-control"  id="p2_home_phone" name="p2_home_phone" value="{{$parent->p2_home_phone}}">
                  </div>
                  <div class="form-group">
                    <label>Street Address<sup>*</sup></label>
                    <input  class="form-control"  id="street_address" name="street_address"  value="{{$parent->street_address}}">
                  </div>
                  <div class="form-group">
                    <label>City</label>
                    <input  class="form-control"  id="city" name="city" value="{{$parent->city}}">
                  </div>
                  <div class="form-group">
                    <label>State<sup>*</sup></label>
                    <input  class="form-control"  id="state" name="state"  value="{{$parent->state}}">
                  </div>
                  <div class="form-group">
                    <label>Country<sup>*</sup></label>
                    <input  class="form-control"  id="country" name="country"  value="{{$parent->country}}">
                  </div>
                  <div class="form-group">
                    <label>Reference</label>
                    <input  class="form-control"  id="reference" name="reference" value="{{$parent->reference}}">
                  </div>
                  <div class="form-group">
                    <label>Immunized Status<sup>*</sup></label>
                    <input  class="form-control"  id="immunized" name="immunized"  value="{{$parent->immunized}}">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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


