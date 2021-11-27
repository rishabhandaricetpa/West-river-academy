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
    <div class="card m-3 family-details ">
        <div class="sticky mb-2 pb-1">
            @include('admin.familyInformation.parent_header')

        </div>
        <table id="student-table" class="table table-bordered table-striped data-table"">
                <thead>
                <tr>
                  <th>Student</th>
                  <th>DOB</th>
                  <th>Gender</th>
                  <th>Country</th>
                  <th>Email</th>
                  <th>Action</th>
                  <th>Payment</th>
                  <th>Transcript</th>
                  <th>Graduation</th>
                  <th>Record Transfer</th>
                  <th>View Uploaded Document</th>
                   <th>Upload Documents</th>
                </tr>
                </thead>
                <tbody>
               
              </tbody>
          </table>
          </div>
        <!-- /.content -->
    @endsection
