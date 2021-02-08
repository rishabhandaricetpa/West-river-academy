@extends('admin.app')

@section('content')
<section class="content">
<div class="container-fluid position-relative">
                <h3 class="card-title">Edit Country Enrollment Data</h3>
              <div class="form-wrap border py-5 px-25">
                <form method="post" action="{{route('admin.country.update',$countrydata->id)}}">
                @csrf
                    <div class="form-group col-sm-6">
                        <label>Country Name<sup>*</sup></label>
                        <input  class="form-control" id="country" value="{{$countrydata->country}}" name="country" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Start Date<sup>*</sup></label>
                        <input type="text" class="form-control "  id="start_date" name="start_date" value="{{Carbon\Carbon::parse($countrydata->start_date)->format('M d Y')}}"><span class="input-group-addon"><i class="glyphicon glyphicon-th" required></i></span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>End Date <sup>*</sup></label>
                        <input  type="text" class="form-control datepicker" id="end_date" name="end_date" value="{{Carbon\Carbon::parse($countrydata->end_date)->format('M d Y')}}">
                    </div>
                <!-- /.card-body -->
                <div class="card-footer col-sm-6">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            </div>
</section>

@endsection
