@extends('admin.app')

@section('content')
    <section class="content">

        <!-- first card parent details -->
        <div class="container-fluid position-relative my-3">
            <h1>Parent Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- form start -->
                <form method="post" class="row" action="{{ route('admin.parent.update', $parent->id) }}">
                    @csrf
                    <div class="form-group col-sm-12">
                        <label>Family Name <sup>*</sup></label>
                        <input class="form-control" id="p1_first_name"
                            value="{{ $parent->p1_last_name }} & {{ $parent->p2_last_name }} Family"
                            name="p1_first_name" disabled>
                    </div>
                    <div class="form-group col-12">
                        <label>User Status<sup>*</sup>
                            <sup>{{ $parent->status === 0 ? 'Active' : 'Inactive' }}</sup></label>
                        <select id="status" name="status" class="form-control"
                            value="{{ $parent->status === 0 ? 'Active' : 'Inactive' }}">
                            <option value="0" @if ($parent->status == 0) selected="selected" @endif>Active</option>
                            <option value="1" @if ($parent->status == 1) selected="selected" @endif>Inactive</option>
                        </select>
                    </div>
                    <div class="container-fluid my-3 parent-info">
                        <div class="row">
                            <!-- tab primary details -->
                            <div class="col-lg-6">
                                <div class="card ">
                                    <div class="card-header p-0">
                                        <!-- START TABS DIV -->
                                        <div class="tabbable-responsive">
                                            <div class="tabbable">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="parent1" data-toggle="tab"
                                                            href="#first" role="tab" aria-controls="first"
                                                            aria-selected="true">Parent 1</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="parent2" data-toggle="tab" href="#second"
                                                            role="tab" aria-controls="second" aria-selected="false">Parent 2
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="login" data-toggle="tab" href="#third"
                                                            role="tab" aria-controls="third" aria-selected="false">Log
                                                            In</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="first" role="tabpanel"
                                                aria-labelledby="parent1">
                                                <div class="form-group col-12">
                                                    <label>Parent 1 First/Given Name <sup>*</sup></label>
                                                    <input class="form-control" id="p1_first_name"
                                                        value="{{ $parent->p1_first_name }}" name="p1_first_name">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Parent 1 Middle Name</label>
                                                    <input class="form-control" id="p1_middle_name" name="p1_middle_name"
                                                        value="{{ $parent->p1_middle_name }}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Parent 1 Last/Family Name <sup>*</sup></label>
                                                    <input class="form-control" id="p1_last_name" name="p1_last_name"
                                                        value="{{ $parent->p1_last_name }}">
                                                </div>
                                                <div class="form-group col-12">

                                                    <label>Parent 1 Email<sup>*</sup> </label>
                                                    <input class="form-control" id="p1_email" name="p1_email"
                                                        value="{{ $parent->p1_email }}" disabled>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Parent 1 Cell Phone</label>
                                                    <input class="form-control" name="p1_cell_phone" id="p1_cell_phone"
                                                        value="{{ $parent->p1_cell_phone }}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Parent 1 Home Phone</label>
                                                    <input class="form-control" id="p1_home_phone" name="p1_home_phone"
                                                        value="{{ $parent->p1_home_phone }}">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="second" role="tabpanel"
                                                aria-labelledby="parent2">
                                                <div class="form-group col-12">
                                                    <label>Parent 2 First/Given Name</label>
                                                    <input class="form-control" id="p2_first_name"
                                                        value="{{ $parent->p2_first_name }}" name="p2_first_name">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Parent 2 Middle Name</label>
                                                    <input class="form-control" id="p2_middle_name" name="p2_middle_name"
                                                        value="{{ $parent->p2_middle_name }}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Parent 2 Email</label>
                                                    <input class="form-control" id="p2_email" name="p2_email"
                                                        value="{{ $parent->p2_email }}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Parent 2 Cell Phone</label>
                                                    <input class="form-control" name="p2_cell_phone" id="p2_cell_phone"
                                                        value="{{ $parent->p2_cell_phone }}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Parent 2 Home Phone</label>
                                                    <input class="form-control" id="p2_home_phone" name="p2_home_phone"
                                                        value="{{ $parent->p2_home_phone }}">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="login">
                                                <div class="form-group col-12">
                                                    <label>First Name</label>
                                                    <input class="form-control" id="p2_cell_phone"
                                                        value="{{ $parent->p2_cell_phone }}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Last Name</label>
                                                    <input class="form-control" id="p2_home_phone"
                                                        value="{{ $parent->p2_home_phone }}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Email</label>
                                                    <input class="form-control" id="p2_home_phone"
                                                        value="{{ $parent->p2_home_phone }}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Password</label>
                                                    <input class="form-control" id="p2_home_phone"
                                                        value="{{ $parent->p2_home_phone }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- tab primary details ends -->


                            <!--    secondary details -->
                            <div class="col-lg-6 parent-info__secondary">
                                <div class="row">
                                    <!-- tab secondary details -->
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header p-0">
                                                <!-- START TABS DIV -->
                                                <div class="tabbable-responsive">
                                                    <div class="tabbable">
                                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="primaryaddress"
                                                                    data-toggle="tab" href="#forth" role="tab"
                                                                    aria-controls="forth" aria-selected="true">Primary
                                                                    Address</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="secondaryaddress" data-toggle="tab"
                                                                    href="#fifth" role="tab" aria-controls="fifth"
                                                                    aria-selected="true">Other Address</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="forth" role="tabpanel"
                                                        aria-labelledby="primaryaddress">
                                                        <div class="form-group col-12">
                                                            <label>Street Address<sup>*</sup></label>
                                                            <input class="form-control" id="street_address"
                                                                name="street_address"
                                                                value="{{ $parent->street_address }}">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label>City</label>
                                                            <input class="form-control" id="city" name="city"
                                                                value="{{ $parent->city }}">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label>State<sup>*</sup></label>
                                                            <input class="form-control" id="state" name="state"
                                                                value="{{ $parent->state }}">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label>Country<sup>*</sup></label>
                                                            <input class="form-control" id="country" name="country"
                                                                value="{{ $parent->country }}">
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="fifth" role="tabpanel"
                                                        aria-labelledby="secondaryaddress">
                                                        <div class="form-group col-12">
                                                            <label>Address<sup>*</sup></label>
                                                            <input class="form-control" id="street_address"
                                                                value="{{ $parent->street_address }}">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label>Country</label>
                                                            <input class="form-control" id="city" name="city"
                                                                value="{{ $parent->city }}">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label>Home Phone<sup>*</sup></label>
                                                            <input class="form-control" id="state" name="state"
                                                                value="{{ $parent->state }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- tab secondary details ends -->

                                    <!-- family-info starts -->
                                    <div class="col-sm-6 card py-3">
                                        <h3> Family Info</h3>
                                        <div class="form-group">
                                            <label>Immunization Status<sup>*</sup></label>
                                            <input class="form-control" id="immunized" name="immunized"
                                                value="{{ $parent->immunized }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Referred by</label>
                                            <input class="form-control" id="reference" name="reference"
                                                value="{{ $parent->reference }}">
                                        </div>
                                    </div>
                                    <!-- family-info ends-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a onclick="goBack()" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- second card parent details -->
        <div class="container-fluid position-relative my-3">
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- student details here -->
                <div class="form-group">
                    <label>Students<sup>*</sup></label>
                    <div class="card my-3 w-100">
                        <div class="card-header p-0">
                            <!-- START TABS DIV -->
                            <div class="tabbable-responsive">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="student-tab" data-toggle="tab" href="#sixth"
                                                role="tab" aria-controls="sixth" aria-selected="true">Students</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="sixth" role="tabpanel"
                                    aria-labelledby="student-tab">
                                    <div class="card-body overflow-auto">
                                        <!-- student table -->
                                        <table id="#example-1" class="table table-bordered table-striped data-table">
                                            <thead>
                                                <tr>
                                                    <th>Name </th>
                                                    <th>Date of Birth</th>
                                                    <th>Email</th>
                                                    <th>Enrollments</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allstudent as $student)
                                                    <tr>
                                                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                                        <td>{{ $student->d_o_b->format('M j, Y') }}</td>
                                                        <td>{{ $student->email }}</td>
                                                        <td>{{ getendallenrollmentes($student->id) }}</td>
                                                        <td><a href=" {{ route('admin.edit-student', $student->id) }}">View
                                                                Student Details</a></br></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid position-relative my-3">
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- order details -->
                <div class="card">
                    <div class="card-header p-0">
                        <!-- START TABS DIV -->
                        <div class="tabbable-responsive">
                            <div class="tabbable">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="enrollments" data-toggle="tab" href="#seventh"
                                            role="tab" aria-controls="seventh" aria-selected="true">Enrollments</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders" data-toggle="tab" href="#eight" role="tab"
                                            aria-controls="eight" aria-selected="true">Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="records" data-toggle="tab" href="#nineth" role="tab"
                                            aria-controls="nineth" aria-selected="true">Records</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="document" data-toggle="tab" href="#tenth" role="tab"
                                            aria-controls="tenth" aria-selected="true">Documents</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="seventh" role="tabpanel"
                                aria-labelledby="enrollments">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped data-table">
                                        <thead>
                                            <tr>

                                                <th class="transform-none">Start Date of Enrollment</th>
                                                <th class="transform-none">End Date of Enrollment</th>
                                                <th>Grade Level</th>
                                                <th>Amount</th>
                                                <th>Payment Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payment_info as $payment)
                                                <tr>

                                                    <td>{{ Carbon\Carbon::parse($payment->start_date_of_enrollment)->format('M j, Y') }}
                                                    </td>
                                                    <td>{{ Carbon\Carbon::parse($payment->end_date_of_enrollment)->format('M j, Y') }}
                                                    </td>
                                                    <td>{{ $payment->grade_level }}</td>
                                                    <td>{{ $payment->amount }}</td>
                                                    @if ($payment->status === 'paid')
                                                        <td>Paid</td>
                                                    @elseif($payment->status ==='pending')
                                                        <td>Pending</td>
                                                    @endif
                                                    <td>
                                                        <a
                                                            href=" {{ route('admin.edit.payment.status', $payment->id) }}"><i
                                                                class=" fas fa-edit" onclick="return myFunction();"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="eight" role="tabpanel" aria-labelledby="orders">
                                <div class="card-body">
                                    <table id="#example-1" class="table table-bordered table-striped data-table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Transcation Id </th>
                                                <th>Payment Mode</th>
                                                <th>Amount</th>
                                                <th>Orders</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transcations as $transcation)
                                                <tr>
                                                    <td>{{ $transcation->created_at->format('M j,Y') }}</td>
                                                    <td>{{ $transcation->transcation_id }}</td>
                                                    <td>{{ $transcation->payment_mode }}</td>
                                                    <td>{{ $transcation->amount }}</td>
                                                    <?php $values = getOrders($transcation->transcation_id);
                                                    ?>

                                                    <td>{{ $values }}</td>
                                                    <td><a
                                                            href=" {{ route('admin.allorders', [$transcation->transcation_id, $transcation->parent_profile_id]) }}">View
                                                            Orders</a></br></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nineth" role="tabpanel" aria-labelledby="records">
                                <div class="card-body">
                                    <table id="#example-1" class="table table-bordered table-striped data-table">
                                        <table id="#example-1" class="table table-bordered table-striped data-table">
                                            <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>School Name</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recordTransfer as $records)
                                                    <tr>
                                                        <td>{{ $records['student']['fullname'] }}</td>
                                                        <td>{{ $records->school_name }}</td>
                                                        <td><a class="transform-none"
                                                                href="mailto:${{ $records->email }}">
                                                                {{ $records->email }}</a></td>
                                                        <td>{{ $records->phone_number }}</td>
                                                        @if (empty($records->request_status))
                                                            <td>In Review
                                                            @elseif($records->request_status=='Record Received')
                                                            <td>Records Received
                                                        @endif
                                                        @if ($records->resendCount)
                                                            Resend Requested:{{ $records->resendCount }}
                                                        @endif
                                                        </td>

                                                        <td>
                                                            <a
                                                                href="{{ route('admin.student.schoolRecord', [$records->student_profile_id, $records->id]) }}">
                                                                <i class=" fas fa-arrow-alt-circle-right"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tenth" role="tabpanel" aria-labelledby="document">
                                <div class="card-body">
                                    <table id="#example-1" class="table table-bordered table-striped data-table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>File Name</th>
                                                <th></th>
                                                <th>Amount</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($documents as $document)
                                                <tr>
                                                    <td>{{ $document->created_at->format('M j,Y') }}</td>
                                                    <td>{{ $document->original_filename }}</td>
                                                    <td>{{ $document->document_type }}</td>
                                                    <td>{{ $document->filename }}</td>
                                                    <td><a
                                                            href=" {{ route('admin.edit.uploadedDocument', $document->id) }}">View
                                                            Documents</a></br></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>







    </section>

@endsection
