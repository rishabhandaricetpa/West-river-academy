@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid position-relative">
            <h1>Student List</h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                    <li class="breadcrumb-item active">Student List</li>
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
                            @if ($students->count() > 0)
                                Parent(s) : {{ $students[0]['parentProfile']['p1_first_name'] }}
                                <a href="{{ route('admin.view.students.parent', $id) }}"
                                    class="btn btn-primary float-right">View Parent</a>
                            @endif
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th class="transform-none">Date of Birth</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                        <th>View Payments</th>
                                        <th>View Transcript</th>
                                        <th>View Graduation</th>
                                        <th>View Record Transfer</th>
                                        <th>View Uploaded Document </th>
                                        <th>Upload Documents</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->fullname }}</td>
                                            <td>{{ $student->d_o_b->format('M j, Y') }}</td>
                                            <td>{{ $student->gender }}</td>
                                            <td class="transform-none">{{ $student->email }}</td>
                                            <td>{{ $student->payment_status }} </br>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.edit-student', $student->id) }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.delete.student', $student->id) }}"><i
                                                        class="fas fa-trash-alt"></i></a>
                                            </td>
                                            <td><a href="{{ route('admin.edit.student.payment', $student->id) }}">View
                                                    Payments</a></br></td>
                                            <td><a href="{{ route('admin.edit.transcript', $student->id) }}">View
                                                    Transcripts</a></br></td>
                                            @if ($student->graduation)
                                                <td><a
                                                        href="{{ route('admin.view.graduation', $student->graduation->id) }}">View
                                                        Graduation</a></br></td>
                                            @else
                                                <td>Not applied</td>
                                            @endif
                                            @if ($student->recordTransfers)
                                                <td><a
                                                        href="{{ route('admin.student.schoolRecord', [$student['recordTransfers']['student_profile_id'], $student['recordTransfers']['id']]) }}">View
                                                        Record Transfer</a></br></td>
                                            @else
                                                <td>Not applied</td>
                                            @endif
                                            <td><a href="{{ route('admin.edit.upload', $student->id) }}">Upload</a></td>
                                            <td> <a
                                                    href="{{ route('admin.change.uploadDocument', $student->id) }}">View</a>
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
        if (!confirm("Are You Sure to delete this"))
            event.preventDefault();
    }

</script>
