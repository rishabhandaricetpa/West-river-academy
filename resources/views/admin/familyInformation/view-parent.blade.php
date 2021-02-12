@extends('admin.app')

@section('content')
<!-- Content Header (Page header) -->
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid position-relative">
        <h1 class="m-0 text-center">Parent Information</h1>
      <div class="d-flex">
        <ol class="breadcrumb ml-auto">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Parent Information</li>
        </ol>
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
            <table id="example1" class="table table-bordered table-striped data-table"">
                  <thead>
                  <tr>
                    <th>Parent1 First Name</th>
                    <th>Parent2 First Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Student Information</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $item)
                  <tr>
                      <td>{{$item->p1_first_name}}</td>
                      <td>{{$item->p2_first_name}}</td>
                      <td>{{$item->p1_email}}</td>
                      <td>{{$item->country}}</td>
                      <td>{{$item->p1_cell_phone}}</td>
                      <td>{{$item->status==0 ?'Active':'Deactivated'}}</td>
                      <td><a href=" {{ url('admin/deactive',$item->id)}}"> <i class="fas fa-ban"
                    onclick="disableButton(this)"></i></a>
                    <a href="{{ url('admin/edit',$item->id)}}"><i class="fas fa-edit"></i>
                <a href="{{ url('admin/delete/parent',$item->id)}}"><i class="fas fa-trash-alt"
                    onclick="return myFunction();"></i></a></td>
                    <td><a href="{{ url('admin/view-student',$item->id)}}">
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