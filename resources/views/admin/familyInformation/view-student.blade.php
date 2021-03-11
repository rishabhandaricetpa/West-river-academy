@extends('admin.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid position-relative">
    <h1>Student Information</h1>
    <div class="d-flex">
      <ol class="breadcrumb ml-auto">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Parent Information</li>
      </ol>
    </div>
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
            <table id="student-table" class="table table-bordered table-striped data-table"">
                  <thead>
                  <tr>
                    <th>Student Id</th>
                    <th>Student</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Actions</th>
                    <th>Payments</th>
                    <th>Transcripts</th>
                    <th>Graduations</th>
                  </tr>
                  </thead>
                  <tbody>
                 
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