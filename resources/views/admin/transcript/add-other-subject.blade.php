@extends('admin.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid position-relative">
            <h1>Subject : </h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                    <li class="breadcrumb-item active">Subjects</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card-header -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Other Subjects</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="addressData" class="table table-bordered table-striped data-table"">
                      <thead>
                      <tr>
                        <th>Subject Name</th>
                        <th>Grade Level</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                       @foreach ($subjects as $subject)
                                <tr>

                                    <td>{{ $subject->subject_name }}</td>
                                    <td>{{ $subject->transcript_period }}</td>
                                    </td>
                                    <td>
                                        <a href=" {{ route('admin.add.other', $subject->id) }}" class=" btn btn-primary"
                                            type="submit" value="Add">Add Subject</a>
                                        <a href="{{ route('admin.delete.other', $subject->id) }}" class=" btn btn-primary"
                                            type="submit" value="Delete">Delete Subject</a>
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
@endsection
<script>
    function myFunction() {
        if (!confirm("Are You Sure to delete this"))
            event.preventDefault();
    }

</script>
