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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Main Dashboard</li>
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
                <h5 class="modal-title" id="exampleModalLabel">Assign Task To:</h5>
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
                                    <th>Date Created</th>
                                    <th>Orders</th>
                                    <th>Notes</th>
                                    <th>Assigned To:</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dashboardData as $data)
                                <tr>
                                    <td>{{$data->created_date}}</td>
                                    @if($data->related_to === 'student_record_received')
                                    <td><a href="{{route('admin.edit-student',$data->student->id)}}">New Student Enrolled</a></td>
                                    @elseif($data->related_to === 'graduation_record_received')
                                    <td><a href="{{ route('admin.view.graduation')}}/{{$data->linked_to}}/edit">Graduation Application</a></td>
                                    @elseif($data->related_to === 'transcript_ordered')
                                    <td><a href="{{ route('admin.viewfull.transcript',[$data->student_profile_id,$data->linked_to])}}">Transcript Ordered</a></td>
                                    @elseif($data->related_to === 'record_transfer')
                                    <td><a href="{{route('admin.student.schoolRecord',$data->student_profile_id)}}">Record Transfer</a></td>
                                    @elseif($data->related_to === 'custom_record_received')
                                    <td><a href="{{ route('admin.custom.payments')}}">Custom Payment</a></td>
                                    @elseif($data->related_to === 'transcript_edit_record_received')
                                    <td><a href="">Transcript Edit Request</a></td>
                                    @elseif($data->related_to === 'postage_record_received')
                                    <td><a href="{{ route('admin.order.postage')}}">Postage Request</a></td>
                                    @elseif($data->related_to === 'appostile_record_received')
                                    <td><a href="{{ route('admin.appostille.notarization')}}">Notarization And Appostile</a></td>
                                    @elseif($data->related_to === 'custom_letter_record_received')
                                    <td><a href="">Custom Letter</a></td>
                                    @endif
                                    <td>{{$data->notes}}</td>
                                    @if(is_null($data->assigned_to))
                                    <td class=" odd bg-primary">Not Yet Assigned</td>
                                    @elseif($data->assigned_to)
                                    <td>{{$data->assigned_to}}</td>
                                    @endif
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