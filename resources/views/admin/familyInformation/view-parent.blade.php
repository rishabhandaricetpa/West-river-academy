<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.partials.header')

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

        <!-- * =============== NavBar =============== * -->
  @include('admin.layouts.partials.navbar')
  <!-- * =============== /Navbar =============== * -->
    <!-- * =============== Sidebar =============== * -->
  @include('admin.layouts.partials.sidebar')
  <!-- * =============== /Sidebar =============== * -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
                <table id="parent" class="table table-bordered table-striped data-table"">
                  <thead>
                  <tr>
                    <th>P1 First Name</th>
                    <th>P2 First Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $item)
                  <tr>
                      <td>{{$item->p1_first_name}}</td>
                      <td>{{$item->p2_first_name}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->country}}</td>
                      <td>{{$item->p1_cell_phone}}</td>
                      <th><i class="fas fa-edit"></i></th>
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
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->
  @include('admin.layouts.partials.footer')

