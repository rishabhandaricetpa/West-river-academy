@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid position-relative">
            <h1>View Documents</h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                    <li class="breadcrumb-item active">View Documents</li>
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
                            <table id="addressData" class="table table-bordered table-striped data-table"">
                              <thead>
                              <tr>
                                <th>Original Filename</th>
                                <th>Document Related To:</th>
                                <th>Uploaded To Student Dashboard ?</th>
                                <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                               @foreach ($uploadedDocuments as $uploadedDocument)
                                <tr>
                                    <td>{{ $uploadedDocument->original_filename }}</td>
                                    <td>{{ $uploadedDocument->document_type }}</td>
                                    @if ($uploadedDocument->is_upload_to_student == 1)
                                        <td>Yes</td>
                                    @else
                                        <td>No</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('admin.edit.uploadedDocument', $uploadedDocument->id) }}">
                                            <i class="fas fa-arrow-alt-circle-right"></i></a>
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
