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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">View Student Information</li>
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
                                    <th>Date od Birth</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                    <th>View Payments</th>
                                    <th>View Transcript</th>
                                    <th>View Graduation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>{{$student->fullname}}</td>
                                    <td>{{$student->gender}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>{{$student->payment_status}} </br>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.edit-student',$student->id)}}"><i class="fas fa-edit"></i></a>
                                        <a href="{{route('admin.delete.student',$student->id)}}"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                    <td><a href="{{route('admin.edit.student.payment',$student->id)}}">View Payments</a></br></td>
                                    <td><a href="{{route('admin.edit.transcript',$student->id)}}">View Transcripts</a></br></td>
                                    @if($student->graduation)
                                    <td><a href="{{route('admin.view.graduation',$student->graduation->id)}}">View Graduation</a></br></td>
                                    @else
                                    <td>Not applied</td>
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