@extends('admin.app')

@section('content')
<!-- Content Header (Page header) -->
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid position-relative">
    <h1 class="m-0 text-center">Family List</h1>
    <div class="d-flex">
      <ol class="breadcrumb ml-auto">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Parent List</li>
      </ol>
    </div><!-- /.container-fluid -->
  </div>
</div>
<!-- /.content-header -->
<div class="card m-3 family-details ">
  <div class="sticky mb-2 pb-1">
    <div class="d-flex justify-content-between main-nav_header align-items-center">
      <ul class="d-flex overflow-scroll">
        <li class="menu-item"><a href="#">Dashboard</a></li>
        <li class="menu-item"><a class="active" href="edit-parent">Family</a></li>
        <li class="menu-item"><a href="#">Student</a></li>
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
    {{-- <ul class="nav overflow-auto align-items-center" id="to-the-top">
            <li class="nav-item">
              <a class="nav-link" href="#parent-details" aria-controls="parent-details" aria-selected="true">Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#student-details" aria-controls="student-details" aria-selected="true">Students</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#notes" aria-controls="notes" aria-selected="true">Notes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#orders" aria-controls="orders" aria-selected="true">Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#enrollments" aria-controls="enrollments" aria-selected="true">Enrollments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#records" aria-controls="records" aria-selected="true">Records</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#documents" aria-controls="documents" aria-selected="true">Documents</a>
            </li>
            <li><a href="#"> <img src="/images/back-button.png" alt=""></a></li>
          </ul>
          <div class="row parents-details_name px-3">
            <div class="col-12 d-flex align-items-center">
              <h2 class="pr-3">Melissa Manisha</h2>
              <div class="form-group">
                <select required class="btn btn-primary dropdown-toggle" id="parent_status">
                  <option   value="0">Active</option>
                  <option   value="1">Inactive</option>
                </select>
                <input type="hidden" value="" id='parent_id' name="parent_id">
              </div>
            </div>
            <div class="col-12">Date Created:</div>
          </div> --}}
  </div>
  <table id="family-table" class="w-100 table-styling data-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Country</th>
        <th>State</th>
        <th>Status</th>
        <th>Date Created</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
<!-- Main content -->

{{-- <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card-header -->
                    <div class="card">
                        
                        <!-- /.card-header -->
                        <div class="card-body overflow-auto">
                            <table id="family-table" class="w-100 table-styling data-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
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
    </section> --}}

<!-- /.content -->
@endsection
