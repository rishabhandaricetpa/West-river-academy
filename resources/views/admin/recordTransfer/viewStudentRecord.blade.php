@extends('admin.app')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@section('content')
<section class="content">
    <div class="container-fluid position-relative">
        <h1>Edit Student Information</h1>
        <div class="form-wrap border py-5 px-25 position-relative">
            <a class="btn btn-primary" href="{{route('admin.recordReceived',$studentRecord->id)}}">Record Received</a>
            @if($studentRecord->request_status)
            <span>{{$studentRecord->request_status}}</span>
            @endif
            <form method="post" action="{{route('admin.sendRecordToSchool',$studentRecord->student_profile_id)}}">
                @csrf
                <div class="card-body p-0 row">
                    <input type="hidden" value="{{$studentRecord->id}}" name="record_id">
                    <input type="hidden" value="{{$studentRecord->status}}" name="status">
                    <div class="form-group col-sm-6">
                        <label>Student Name <sup>*</sup></label>
                        <input class="form-control" id="name" value="{{$studentRecord['student']['fullname']}}" name="name" readonly>
                    </div>
                    @if($studentEnrollmentYear)
                    @foreach($studentEnrollmentYear as $year)
                    <input type="hidden" name="enrollmentyear[]" value="{{$year->grade_level}}">
                    @endforeach
                    @endif
                    <div class="form-group col-sm-6">
                        <label>School Name</label>
                        <input class="form-control" name="school_name" value="{{$studentRecord->school_name}}" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>School Email<sup>*</sup></label>
                        <input class="form-control" id="cell_phone" name="email" value="{{$studentRecord->email}}" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Fax Number<sup>*</sup></label>
                        <input class="form-control" id="cell_phone" name="fax_number" value="{{$studentRecord->fax_number}}" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Phone Number<sup>*</sup></label>
                        <input class="form-control" name="phone_number" value="{{$studentRecord->phone_number}}" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Street Address<sup>*</sup></label>
                        <input class="form-control" name="street_address" value="{{$studentRecord->street_address}}" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>City<sup>*</sup></label>
                        <input class="form-control" name="city" value="{{$studentRecord->city}}" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>State<sup>*</sup></label>
                        <input class="form-control" name="state" value="{{$studentRecord->state}}" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Zip Code<sup>*</sup></label>
                        <input class="form-control" name="zip_code" value="{{$studentRecord->zip_code}}" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Country<sup>*</sup></label>
                        <input class="form-control" name="country" value="{{$studentRecord->country}}" readonly>
                    </div>
                    <div>
                    </div>
                </div>

                <!-- /.card-body -->
                @if($studentRecord->request_status !== 'Record Received')
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <a href="{{route('admin.download.record',[$studentRecord->id,$studentRecord->student_profile_id])}}" class="btn btn-primary">Download & Preview Record</a>
                        <button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" class="btn btn-primary">Send Record To School</button>
                        <a href="{{route('admin.resend.request',[$studentRecord->id,$studentRecord->student_profile_id] )}}" class=" btn btn-primary">ReSend Request</a>
                    </div>

                    <div class="col-md-6 mt-4">
                        <table class='table-styling w-100 min-w-100' border="1">

                            <tr> @if($studentRecord->resendCount)
                                <th> Resend Request Count: </th>
                                <td>{{$studentRecord->resendCount}}</td>
                                @endif
                            </tr>

                            <tr> @if($studentRecord->firstRequestDate)
                                <th> First Request Date:</th>
                                <td>{{$studentRecord->firstRequestDate}}</td>
                            </tr>
                            @endif
                            <tr> @if($studentRecord->secondRequestDate)
                                <th> Second Request Date:</th>
                                <td> {{$studentRecord->secondRequestDate}}</td>
                            </tr>
                            @endif
                            <tr> @if($studentRecord->thirdRequest)
                                <th> Third Request Date:</th>
                                <td>{{$studentRecord->thirdRequest}}</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                    @endif
                </div>


        </div>

        </form>
    </div>
    </div>
    <!-- /.card -->

    <!-- /.card-body -->
    </div><!-- /.container-fluid -->
</section>
@endsection