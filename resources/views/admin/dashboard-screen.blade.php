@extends('admin.app')
@section('content')
<!-- Content Header (Page header) -->
<!-- Content Wrapper. Contains page content -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid position-relative">
        <h1>Dashboard Notification</h1>
        <div class="d-flex">
            <ol class="breadcrumb ml-auto">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard Notification</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="assignRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Record To:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>

                </button>
            </div>

            <form id="assign">
                <input type="hidden" name="data_id" id="data_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="assigned_to" class="col-form-label">Assigned To:</label>
                        <select class="form-control" id="assigned_to" name="assigned_to">
                            <option value="Peggy">Peggy</option>
                            <option value="Stacey">Stacey</option>
                            <option value="risha">risha</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Notes:</label>
                        <textarea class="form-control" id="notes"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="assignTo()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


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
                                    <th>Created Date</th>
                                    <th>Linked To</th>
                                    <th>Notes</th>
                                    <th>Assigned To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dashboardData as $data)
                                <tr>
                                    <td>{{$data->created_date}}</td>
                                    <td>{{$data->linked_to}}</td>
                                    <td>{{$data->notes}}</td>
                                    <td>{{$data->assigned_to}}</td>
                                    <td><a href="javascript:void(0)" data-id="{{ $data->id }}" onclick="editDashboard(event.target)" data-toggle="modal" data-target="#assignRecord" class="btn btn-primary">Assign</a></td>
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
<script type="text/javascript">
    function myFunction() {
        if (!confirm("Are You Sure to delete this"))
            event.preventDefault();
    }
</script>