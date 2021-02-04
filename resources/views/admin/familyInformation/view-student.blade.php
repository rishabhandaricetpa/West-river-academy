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
            <table id="example1" class="table table-bordered table-striped data-table"">
                  <thead>
                  <tr>
                    <th>Student Id</th>
                    <th>Student First Name</th>
                    <th>Studen Last Name</th>
                    <th>Date of Birth</th>
                    <th>Email</th>
                    <th>Cell_phone</th>
                    <th>Immunized</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($student as $item)
                  <tr>
                      <td>{{$item->student_Id}}</td>
                      <td>{{$item->first_name}}</td>
                      <td>{{$item->last_name}}</td>
                      <td>{{$item->d_o_b->format('M d Y')}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->cell_phone}}</td>
                      <td>{{$item->immunized_status}}</td>
                      <td><a href=" {{ url('admin/edit-student',$item->id)}}"> <i class="fas fa-edit"></i></a>
              <a href="{{ url('admin/delete',$item->id)}}"><i class="fas fa-trash-alt"
                  onclick="return myFunction();"></i></td>
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