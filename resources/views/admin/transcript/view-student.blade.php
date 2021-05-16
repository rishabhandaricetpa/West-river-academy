@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid position-relative">
            <h1>Student Details</h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                    <li class="breadcrumb-item active">Student Details</li>
                    <li class="breadcrumb-item active">Transcript</li>
                </ol>
            </div><!-- /.col -->
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
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>National ID</th>
                        <th>Cell Phone</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                       @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->middle_name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td><a class="transform-none" href="mailto:${{ $student->email }}"> {{ $student->email }}</a></td>
                                    <td>{{ $student->student_Id }}</td>
                                    <td>{{ $student->cell_phone }}</td>
                                    @if ($type == 'k-8')
                                        <td>
                                            <a href=" {{ route('admin.edit.transcript', $student->id) }}">
                                                <i class="fas fa-arrow-alt-circle-right"></i></a>
                                        </td>
                                    @else
                                        <td>
                                            <a href=" {{ route('admin.edit.transcript9_12', $student->id) }}">
                                                <i class="fas fa-arrow-alt-circle-right"></i></a>
                                        </td>
                                    @endif

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
        if (!confirm("Are You Sure to delete this"))
            event.preventDefault();
    }

</script>
