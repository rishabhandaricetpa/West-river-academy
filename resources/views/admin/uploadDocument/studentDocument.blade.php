@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid position-relative">
            <h1>Student List</h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                    <li class="breadcrumb-item active">Student List</li>
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
                            <table id="student-document-table" class="table table-bordered table-striped data-table"">
                          <thead>
                          <tr>
                            <th>Student</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Country</th>
                            <th>Email</th>
                            <th>Upload Documents</th>
                            <th>View Uploaded Documents</th>
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
