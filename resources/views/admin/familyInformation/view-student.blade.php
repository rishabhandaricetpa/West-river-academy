@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Parent Information</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Parent Information</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
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
                <h3 class="card-title">DataTable with default features</h3>
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
                      <td>{{$item->d_o_b}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->cell_phone}}</td>
                      <td>{{$item->immunized_status}}</td>
                      <td><a href="{{ url('admin/edit-student',$item->id)}}"> <i class="fas fa-edit"></i></a>
                      <a href="{{ url('admin/delete',$item->id)}}"><i class="fas fa-trash-alt"></i></td>
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
