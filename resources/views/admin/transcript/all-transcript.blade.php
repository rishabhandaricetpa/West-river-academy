@extends('admin.app')

@section('content')
<!-- Content Header (Page header) -->
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid position-relative">
            <h1>Transcripts Information</h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">{{$student->fullname}} Transcripts Information</li>
                    <li class="breadcrumb-item active">Transcripts</li>
                </ol>
            </div><!-- /.col -->
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
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="addressData" class="table table-bordered table-striped data-table"">
                  <thead>
                  <tr>
                    <th>Transcript</th>
                    <th>Status</th>
                    <th>Enrollment Year</th>
                    <th>School Name</th>
                    <th>Grade</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($transcript as $transcripts)
                  <tr>
                      <td>{{$transcripts->period}}</td>
                      <td>{{$transcripts->status}}</td>
                      <td>{{$transcripts->enrollment_year}}</td>
                      <td>{{$transcripts->school_name}}</td>
                      <td>{{$transcripts->grade}}</td>
                      <td>
                            <a href="{{route('admin.viewfull.transcript',[$transcripts->student_profile_id,$transcripts->transcript_id])}}">View Transcript</a>
                            </td>
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
<script>
    function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
</script>