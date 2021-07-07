@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid position-relative">
            <h1 class="m-0 text-center">Parent</h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                    <li class="breadcrumb-item active">Parent</li>
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
                            <a onclick="goBack()" class="btn btn-primary">Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="student-parent" class="table table-bordered table-striped data-table"">
                                                  <thead>
                                                  <tr>
                                                    <th>Parents</th>
                                                    <th>Country</th>
                                                    <th>State</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th>View</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                     @if (!empty($parent))
                                <td>{{ $parent->p1_first_name }}</td>
                                <td>{{ $parent->country }}</td>
                                <td>{{ $parent->state }}</td>
                                @if ($parent->status == 0)
                                    <td>Active</td>
                                @else
                                    <td>Inactive</td>
                                @endif
                                <td><a href="{{ route('admin.parent.edit', $parent->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.parent.delete', $parent->id) }}"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                                <td><a href="{{ route('admin.each.student', $parent->id) }}">View Students</a></td>
                            @else
                                No Data Found
                                @endif
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
