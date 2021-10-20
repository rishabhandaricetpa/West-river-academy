@extends('admin.app')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Student Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <form class="row align-items-center" method="post"
                    action="{{ route('admin.recordReceived', $studentRecord->id) }}" enctype="multipart/form-data">
                    <a href="{{ route('admin.parent.edit', $studentRecord->parent_profile_id) }}"
                        class="btn btn-primary  ">View Parent</a>
                    <div class="col-12 text-sm-right">
                        @if ($studentRecord->request_status !== 'Record Received')
                            <button type="submit" class="btn btn-primary mt-4 mt-sm-0">Records Received</button>
                        @endif
                    </div>
                    <input type="hidden" name="student_id" value="{{ $studentRecord->student_profile_id }}"
                        id="record_student_id">
                    <input type="hidden" name="parent_id" value="{{ $studentRecord->parent_profile_id }}"
                        id="record_parentid">
                    @if ($studentRecord->request_status !== 'Record Received')
                        <div class="col-sm-6">
                            <label>Method of Delivery </label>
                            <select class="form-control" name="mediumOfDelivery" required>
                                <option value="">Select If Received</option>
                                <option value="Digital">Digital</option>
                                <option value="Physical">Physical</option>
                            </select>
                        </div>
                    @endif
                    @if ($studentRecord->request_status !== 'Record Received')
                        <div class=" formgroup col-sm-6 mb-4 mb-sm-0">
                            <label>Upload Single/Multiple Documents<sup>*</sup></label>
                            <label class="font-weight-bold text-secondary">
                            </label>
                            <input multiple="multiple" type="file" name="file[]" class="form-control choose-btn" multiple>
                        </div>
                    @endif
                    @csrf

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
                        <input type="hidden" value="{{ $studentRecord->id }}" name="record_id" id="record_id">
                        <input type="hidden" value="{{ $studentRecord->status }}" name="status">
                        <div class="form-group col-sm-6">
                            <label>Student Name <sup>*</sup></label>
                            <input class="form-control" id="name" value="{{ $studentRecord['student']['fullname'] }}"
                                name="name" id="record_student_name" required readonly>
                        </div>
                        @if ($studentEnrollmentYear)
                            @foreach ($studentEnrollmentYear as $year)
                                <input type="hidden" name="enrollmentyear[]" value="{{ $year->grade_level }}">
                            @endforeach
                        @endif
                        <div class="form-group col-sm-6">
                            <label>School Name</label>
                            <input class="form-control" name="school_name" value="{{ $studentRecord->school_name }}"
                                id="record_school_name" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>School Email<sup>*</sup></label>
                            <input class="form-control" name="email" type="email" value="{{ $studentRecord->email }}"
                                id="record_school_email" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Fax Number<sup>*</sup></label>
                            <input class="form-control" name="fax_number" value="{{ $studentRecord->fax_number }}"
                                id="school_fax_number" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Phone Number<sup>*</sup></label>
                            <input class="form-control" name="phone_number" value="{{ $studentRecord->phone_number }}"
                                id="school_phone_number" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Street Address<sup>*</sup></label>
                            <input class="form-control" name="street_address"
                                value="{{ $studentRecord->street_address }}" id="school_street_address" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>City<sup>*</sup></label>
                            <input class="form-control" name="city" value="{{ $studentRecord->city }}" id="school_city"
                                required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>State<sup>*</sup></label>
                            <input class="form-control" name="state" value="{{ $studentRecord->state }}"
                                id="school_state" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Zip Code<sup>*</sup></label>
                            <input class="form-control" name="zip_code" value="{{ $studentRecord->zip_code }}"
                                id="school_zip_code" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Country<sup>*</sup></label>
                            <input class="form-control" name="country" value="{{ $studentRecord->country }}"
                                id="school_country" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Last Grade In School<sup>*</sup></label>
                            <input class="form-control" name="last_grade" id="last_grade_in"
                                value=" {{ $studentRecord->last_grade }}" required>
                        </div>
                        <div>
                        </div>
                    </div>

                    <!-- /.card-body -->

                    <div class="row">
                        <div class="col-12 mt-4">
                            <a href="#" onclick="updateRecord()" class="btn btn-primary my-1">Update</a>
                            <a href="{{ route('admin.download.record', [$studentRecord->id, $studentRecord->student_profile_id]) }}"
                                class="btn btn-primary my-1">Download & Preview Request</a>
                            <button type="submit"
                                onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                                class="btn btn-primary my-1">Send Record Request To School</button>
                            <a href="{{ route('admin.resend.request', [$studentRecord->id, $studentRecord->student_profile_id]) }}"
                                class=" btn btn-primary my-1">Re-send Request</a>
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Send Mail</button> --}}

                            <a onclick="goBack()" class=" btn btn-primary my-1">Back</a>
                        </div>
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Send Mail</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                <input type="text" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">cc:</label>
                                                <input type="text" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Message:</label>
                                                <textarea class="form-control" id="message-text"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
