@extends('admin.app')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@section('content')
    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Student Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <form class="row align-items-center" method="post"
                    action="{{ route('admin.recordReceived', $studentRecord->id) }}" enctype="multipart/form-data">
                    @csrf
                    @if ($studentRecord->request_status !== 'Record Received')
                        <div class="col-sm-6">
                            <label>Method of Delivery </label>
                            <select class="form-control" name="mediumOfDelivery">
                                <option value="">Select If Received</option>
                                <option value="Digital">Digital</option>
                                <option value="Physical">Physical</option>
                            </select>
                        </div>
                    @endif
                    <div class="col-sm-6 text-sm-right">
                        @if ($studentRecord->request_status !== 'Record Received')
                            <button type="submit" class="btn btn-primary mt-4 mt-sm-0">Records Received</button>
                        @endif
                    </div>
                    <input type="hidden" name="student_id" value="{{ $studentRecord->student_profile_id }}">
                    <input type="hidden" name="parent_id" value="{{ $studentRecord->parent_profile_id }}">
                    @if ($studentRecord->request_status !== 'Record Received')
                        <div class="col-md-4 mb-4 mb-sm-0">
                            <label class="h2">Upload Single/Multiple Documents<sup>*</sup></label>
                            <label class="font-weight-bold text-secondary">
                            </label>
                            <input multiple="multiple" type="file" name="file[]" class="form-control choose-btn" multiple>
                        </div>
                    @endif
                </form>
                @if ($studentRecord->request_status == 'Record Received')
                    <h2 class="text-center">Method of Delivery:
                        {{ $studentRecord->medium_of_transfer }}</h2>
                    <h3 class="">
                        @if ($studentRecord->request_status == 'Record Received')
                            Records Received
                        @endif
                    </h3>

                @endif
                <form method="post" action="{{ route('admin.sendRecordToSchool', $studentRecord->student_profile_id) }}">
                    @csrf
                    <div class="card-body p-0 row">
                        <input type="hidden" value="{{ $studentRecord->id }}" name="record_id">
                        <input type="hidden" value="{{ $studentRecord->status }}" name="status">
                        <div class="form-group col-sm-6">
                            <label>Student Name <sup>*</sup></label>
                            <input class="form-control" id="name" value="{{ $studentRecord['student']['fullname'] }}"
                                name="name" readonly>
                        </div>
                        @if ($studentEnrollmentYear)
                            @foreach ($studentEnrollmentYear as $year)
                                <input type="hidden" name="enrollmentyear[]" value="{{ $year->grade_level }}">
                            @endforeach
                        @endif
                        <div class="form-group col-sm-6">
                            <label>School Name</label>
                            <input class="form-control" name="school_name" value="{{ $studentRecord->school_name }}"
                                readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>School Email<sup>*</sup></label>
                            <input class="form-control" id="cell_phone" name="email" value="{{ $studentRecord->email }}"
                                readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Fax Number<sup>*</sup></label>
                            <input class="form-control" id="cell_phone" name="fax_number"
                                value="{{ $studentRecord->fax_number }}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Phone Number<sup>*</sup></label>
                            <input class="form-control" name="phone_number" value="{{ $studentRecord->phone_number }}"
                                readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Street Address<sup>*</sup></label>
                            <input class="form-control" name="street_address"
                                value="{{ $studentRecord->street_address }}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>City<sup>*</sup></label>
                            <input class="form-control" name="city" value="{{ $studentRecord->city }}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>State<sup>*</sup></label>
                            <input class="form-control" name="state" value="{{ $studentRecord->state }}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Zip Code<sup>*</sup></label>
                            <input class="form-control" name="zip_code" value="{{ $studentRecord->zip_code }}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Country<sup>*</sup></label>
                            <input class="form-control" name="country" value="{{ $studentRecord->country }}" readonly>
                        </div>
                        <div>
                        </div>
                    </div>

                    <!-- /.card-body -->
                    @if ($studentRecord->request_status !== 'Record Received')
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <a href="{{ route('admin.download.record', [$studentRecord->id, $studentRecord->student_profile_id]) }}"
                                    class="btn btn-primary">Download & Preview Records</a>
                                <button type="submit"
                                    onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                                    class="btn btn-primary">Send Records To School</button>
                                <a href="{{ route('admin.resend.request', [$studentRecord->id, $studentRecord->student_profile_id]) }}"
                                    class=" btn btn-primary">Re-send Request</a>
                                    <a href="{{ route('admin.record.request') }}"
                                    class=" btn btn-primary">Back</a>
                            </div>

                            <div class="col-md-6 mt-4">
                                <table class='table-styling w-100 min-w-100' border="1">

                                    <tr>
                                        @if ($studentRecord->resendCount)
                                            <th> Resend Request Count: </th>
                                            <td>{{ $studentRecord->resendCount }}</td>
                                        @endif
                                    </tr>

                                    <tr>
                                        @if ($studentRecord->firstRequestDate)
                                            <th> First Request Date:</th>
                                            <td>{{ $studentRecord->firstRequestDate }}</td>
                                    </tr>
                    @endif
                    <tr>
                        @if ($studentRecord->secondRequestDate)
                            <th> Second Request Date:</th>
                            <td> {{ $studentRecord->secondRequestDate }}</td>
                    </tr>
                    @endif
                    <tr>
                        @if ($studentRecord->thirdRequest)
                            <th> Third Request Date:</th>
                            <td>{{ $studentRecord->thirdRequest }}</td>
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
