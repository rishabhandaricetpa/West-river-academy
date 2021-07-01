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
<div class="card pt-2 m-3 family-details ">
  <table id="family-table" class="w-100 table-styling data-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Country</th>
        <th>State</th>
        <th>Status</th>
        <th>Date Created</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

@endsection
