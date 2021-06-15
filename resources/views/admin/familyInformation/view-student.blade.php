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
    <div class="d-flex justify-content-between main-nav_header align-items-center">
      <ul class="d-flex overflow-scroll">
        <li class="menu-item"><a href="#">Dashboard</a></li>
        <li class="menu-item"><a href="edit-parent">Family</a></li>
        <li class="menu-item"><a class="active" href="#">Student</a></li>
        <li class="menu-item"><a href="#">Representative</a></li>
        <li class="menu-item"><a href="#">Groups</a></li>
        <li class="menu-item"><a href="#"><img src="/images/add.png" alt=""></a></li>
      </ul>
      <ul class="d-flex">
        <li><img src="/images/search.png" alt="login"></li>
        <li><img src="/images/bell.png" alt="login"></li>
        <li><a href="#"> <img src="/images/login.png" alt="login"></a>
        </li>
      </ul>
    </div>
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
