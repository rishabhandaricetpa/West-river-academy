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
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                    <li class="breadcrumb-item active">Parent List</li>
                </ol>
            </div><!-- /.container-fluid -->
        </div>
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
                        <div class="card-body overflow-auto">
                            <table id="family-table" class="w-100 table-styling data-table">
                                <thead>
                                    <tr>
                                        <th>Parents</th>
                                        <th>Email</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>Status</th>
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

    <!-- /.content -->
@endsection
