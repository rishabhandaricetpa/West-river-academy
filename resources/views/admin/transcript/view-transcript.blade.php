@extends('admin.app')

@section('content')
<!-- Content Header (Page header) -->
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid position-relative">
                <h1>Students Transcript</h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Student Transcript</li>
                    <li class="breadcrumb-item active">Transcript</li>
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
                  <button type="submit" class="btn btn-primary">View Transcript Pdf</button>

                  <tr>
                  <th>Student Name</th>
                    <th>Transcript</th>
                    <th>Course Name</th>
                    <th>Subject Name</th>
                    <th>Grade</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($transcriptData as $transcript)
                  <tr>
                      <td>{{$student->first_name}} {{$student->last_name}}</td>
                      <td>{{$transcript->transcript_period}}</td>
                      <td>{{$transcript->course_name}}</td>
                      <td>{{$transcript->subject_name}}</td>
                      <td>{{$transcript->score}}</td>
                      <td>
                            <a href="">
                            <i class="fas fa-arrow-alt-circle-right"></i></a>
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