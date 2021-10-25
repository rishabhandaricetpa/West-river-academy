@extends('admin.app')

@section('content')
<div class="content-header">
  <div class="container-fluid position-relative">
        <h1 class="m-0 text-center">Country And Enrollment Date</h1>
      <div class="d-flex">
        <ol class="breadcrumb ml-auto">
          <li class="breadcrumb-item active">Country And Enrollments</li>
        </ol>
  </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->
    <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card-header -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="addressData" class="table table-bordered table-striped data-table"">
                  <thead>
                  <tr>
                  <th>Country Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($countrydata as $countryenrollment)
                  <tr>
                      <td>{{$countryenrollment->country}}</td>
                      <td>{{Carbon\Carbon::parse($countryenrollment->start_date)->format('F d')}}</td>
                      <td>{{Carbon\Carbon::parse($countryenrollment->end_date)->format('F d')}}</td>
                      <td><a href="{{ url('admin/edit-country',$countryenrollment->id)}}"> <i class="fas fa-edit"></i></a>
                  </tr>
                  @endforeach
                  </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
</div>
<!-- /.content -->
@endsection
