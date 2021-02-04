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
                <h3 class="card-title">Edit Country Enrollment Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
              <form method="post" action="{{route('admin.country.update',$countrydata->id)}}">
                @csrf
                <div class="card-body">
                <div class="form-group">
                  <div class="form-group">
                    <label>Country Name<sup>*</sup></label>
                    <input  class="form-control" id="country" value="{{$countrydata->country}}" name="country" required>
                  </div>
                  <!-- <div class="form-group">
                    <label>Start Date<sup>*</sup></label>
                    <input  class="form-control" id="start_date" name="start_date" value="{{Carbon\Carbon::parse($countrydata->start_date)->format('M d Y')}}" required>
                  </div> -->
                  <label>Start Date<sup>*</sup></label>
                  <div class="input-group date">
                    <input type="date" class="form-control"  id="start_date" name="start_date" value="{{Carbon\Carbon::parse($countrydata->start_date)->format('M d Y')}}"><span class="input-group-addon"><i class="glyphicon glyphicon-th" required></i></span>
                </div>
                  <div class="form-group">
                    <label>End Date <sup>*</sup></label>
                    <input  type="date" class="form-control" id="end_date" name="end_date" value="{{Carbon\Carbon::parse($countrydata->end_date)->format('M d Y')}}">
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

