@extends('admin.app')
@section('content')
<!-- Content Header (Page header) -->
<!-- Content Wrapper. Contains page content -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid position-relative">
        <h1>Main Dashboard</h1>
        <div class="d-flex">
            <ol class="breadcrumb ml-auto">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                <li class="breadcrumb-item active">Main Dashboard</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Button trigger modal -->

<!-- Modal for Super Admin -->
<div class="modal fade" id="assignRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="exampleModalLabel">Assign Task To:</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>

                </button>
            </div>
            <form id="assign-form">
                <input type="hidden" name="data_id" id="data_id">
                <div class="modal-body p-3">
                    <div class="form-group">
                        <label for="assigned_to" class="col-form-label">Assigned To:</label>
                        <select class="form-control" id="assigned_to" name="assigned_to">
                            <option value="" disabled>Please Select One</option>
                            <option value="Danielle">Danielle</option>
                            <option value="Karen">Karen</option>
                            <option value="Peggy">Peggy</option>
                            <option value="Paula">Paula</option>
                            <option value="Raelyn">Raelyn</option>
                            <option value="Stacey">Stacey</option>
                            <option value="Ray">Ray</option>
                            <option value="Paige">Paige</option>
                            <option value="Rebecca">Rebecca</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Notes:</label>
                        <textarea class="form-control" id="notes" onKeyPress="if(this.value.length==2000) return false;" maxlength="2000"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal for Sub Admin -->
<div class="modal fade" id="assignStatusToRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Task Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>

                </button>
            </div>
            <form id="assign">
                <input type="hidden" name="datarecord_id" id="datarecord_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="assigned_to" class="col-form-label">Status:</label>
                        <select class="form-control" id="task_status" name="assigned_to">
                            <option value="" disabled>Please Select One</option>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="updateStatus()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Main content -->
@php
$date = \Carbon\Carbon::now()->toDateString();
@endphp
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card-header -->
                <div class="card">
                    <div class="card-header">

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>

                                    <th>Date Created</th>
                                    <th>Orders</th>
                                    <th>Amount</th>
                                    <th>Notes</th>
                                    <th>Assigned To:</th>

                                    <th>Action</th>

                                    <th>Task Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dashboardData as $data)
                                <tr>

                                    <td>{{ formatDate($data->created_date) }}</td>
                                    <td><a href="{{route('admin.parent.edit',$data->parent_profile_id)}}">{{$data->item_type}}</a></td>
                                    <td>${{$data->amount}}</td>

                                    <td>{{ $data->notes }}</td>
                                    @if (empty($data->assigned_to))
                                    <td class="odd bg-primary">Not Yet Assigned</td>
                                    @elseif($data->assigned_to)
                                    <td>{{ $data->assigned_to }}</td>
                                    @endif


                                    <td><a href="javascript:void(0)" data-id="{{ $data->id }}" onclick="editDashboard(event.target)" data-toggle="modal" data-target="#assignRecord" class="btn btn-primary">Assign</a></td>

                                    @if (empty($data->task_status))
                                    <td class="">No Status </td>
                                    @elseif($data->task_status)
                                    <td class="bg-success">{{ $data->task_status }}</td>
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