@extends('admin.app')

@section('content')
<!-- Content Header (Page header) -->
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid position-relative">
                <h1>Courses</h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Courses</li>
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
                    <th>Course Id</th>
                    <th>Course Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($courses as $course)
                  <tr>
                      <td>{{$course->id}}</td>
                      <td>{{$course->course_name}}</td>
                      <td>
                            <a href=" {{route('admin.edit.course',$course->id)}}">
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