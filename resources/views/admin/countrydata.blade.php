@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Country And Enrollments</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Country and Enrollments</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           <!-- /.card-header -->
            <div class="card">
      
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped data-table"">
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
                      <td>{{Carbon\Carbon::parse($countryenrollment->start_date)->format('M d Y')}}</td>
                      <td>{{Carbon\Carbon::parse($countryenrollment->end_date)->format('M d Y')}}</td>
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
