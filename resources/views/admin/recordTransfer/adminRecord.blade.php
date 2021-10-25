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
                    <li class="breadcrumb-item active">Record Transfer Information</li>
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
                            <table id="example1" class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>School Name</th>
                                        <th>Email</th>

                                        <th>Status</th>
                                        <th>View Parent</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schoolRecords as $record)
                                        <tr>
                                            <td>{{ $record['student']['fullname'] }}</td>
                                            <td>{{ $record->school_name }}</td>
                                            <td><a class="text-lowercase" href="mailto:${{ $record->email }}">
                                                    {{ $record->email }}</a></td>

                                            @if (empty($record->request_status) || $record->request_status == 'Pending')
                                                <td>In Review </br>
                                                @elseif($record->request_status=='Record Received')
                                                <td>Records Received </br>
                                            @endif
                                            @if ($record->resendCount)
                                                Resend Requested:{{ $record->resendCount }}
                                            @endif
                                            </td>
                                            <td><a
                                                    href="{{ route('admin.parent.edit', $record->parent_profile_id) }}">{{ $record['parent']['fullname'] }}</a>
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ route('admin.student.schoolRecord', [$record->student_profile_id, $record->id]) }}">
                                                    <i class=" fas fa-arrow-alt-circle-right"></i></a>
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
