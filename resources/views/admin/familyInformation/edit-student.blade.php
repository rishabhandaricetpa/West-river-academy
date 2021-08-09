@extends('admin.app')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@section('content')
    <section class="content container-fluid">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- first card student details -->
        <div class="card family-details ">
            <div class="sticky mb-2 pb-1">
                @include('admin.familyInformation.student_header')
                <div class="card family-details px-3 mb-4 pt-3">

                    {{-- students-details --}}
                    <section class="students-details pt-2 pb-5" id="student-details">
                        <div class="tab-content">
                            {{-- -------------- first tab --}}
                            <div class="row">
                                <div class="col-12 d-flex align-items-center">
                                    <h2 class="pr-3"><a
                                            href="{{ route('admin.parent.edit', $parent_id) }}">{{ $student->fullname }}</a>
                                    </h2>
                                    <div class="form-group mb-0">
                                        <select required class="dropdown-icon" id="student_status">
                                            <option @if ($student->status === 0) selected @endif value="0">Active</option>
                                            <option @if ($student->status === 1) selected @endif value="1">Inactive</option>
                                        </select>
                                        <input type="hidden" value="{{ $student->id }}" id='id' name="id">
                                    </div>
                                </div>
                                <div class="col-12"> Date Created:{{ $student->created_at->format('M j, Y') }}</div>

                                {{-- student detil-1 --}}

                                <div class="col-md-12">
                                    <form class="is-readonly row students_store" id="studentForm1"
                                        class="edit-student-profile">
                                        <div class="col-md-6">
                                            {{-- <h3 class="mt-3">student-details-1</h3> --}}
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">First Name :</label>
                                                <input type="text" class="form-control is-disabled" id="first_name"
                                                    placeholder="" value="{{ $student->first_name }}" disabled>
                                                <input type='hidden' id="parent_id" name="parent_id"
                                                    value="{{ $student->parent_profile_id }}">
                                                <input type='hidden' id="students_id" name="students_id"
                                                    value="{{ $student->id }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Middle Name :</label>
                                                <input type="text" class="form-control is-disabled" id="middle_name"
                                                    placeholder="Name" value="{{ $student->middle_name }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Last Name :</label>
                                                <input type="text" class="form-control is-disabled" id="last_name"
                                                    placeholder="Name" value="{{ $student->last_name }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDOB">Date Of Birth :</label>
                                                <input type="text" class="form-control is-disabled" id="d_o_b"
                                                    placeholder="MM/DD/YYYY"
                                                    value="{{ $student->d_o_b->format('F j, Y') }}" disabled>
                                            </div>
                                            <div class="form-group lato-italic info-detail d-flex py-1">
                                                <div>
                                                    <label for="">Gender <sup>*</sup></label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input mt-1" type="radio" name="gender"
                                                        id="gender" value="Male"
                                                        {{ $student->gender == 'Male' ? 'checked' : '' }} required
                                                        disabled>
                                                    <label class="form-check-label pl-1 pl-sm-0">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input mt-1" type="radio" name="gender"
                                                        value="Female"
                                                        {{ $student->gender == 'Female' ? 'checked' : '' }} id="gender"
                                                        disabled>
                                                    <label class="form-check-label pl-1 pl-sm-0">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputMothersName">Email :</label>
                                                <input type="email" class="form-control is-disabled" id="email"
                                                    placeholder="" value="{{ $student->email }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputMothersName">Phone :</label>
                                                <input type="text" class="form-control is-disabled" id="cell_phone"
                                                    placeholder="" value="{{ $student->cell_phone }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputMothersName">National Id :</label>
                                                <input type="text" class="form-control is-disabled" id="national_ID"
                                                    placeholder="" value="{{ $student->student_Id }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputMothersName">Birth City :</label>
                                                <input type="text" class="form-control is-disabled" id="birth_city"
                                                    placeholder="" value="{{ $student->birth_city }}" disabled>
                                            </div>

                                        </div>

                                        {{-- students details 2 --}}

                                        <div class="col-md-6">
                                            {{-- <h3 class="mt-3">student-details-2</h3> --}}
                                            <div class="form-group">
                                                <label for="exampleInputParent1">Parent - 1 :</label>
                                                <input type="text" class="form-control is-disabled" id="p1_name"
                                                    placeholder="Name"
                                                    value="{{ $parent->p1_first_name }} {{ $parent->p1_last_name }}"
                                                    readonly disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputParent2">Parent - 2 :</label>
                                                <input type="text" class="form-control is-disabled" id="p2_last_name"
                                                    placeholder="Name"
                                                    value="{{ $parent->p2_first_name }} {{ $parent->p2_last_name }}"
                                                    readonly disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputMothersName">Mother' Maiden Name :</label>
                                                <input type="text" class="form-control is-disabled" id="mothers_name"
                                                    placeholder="" value="{{ $student->mothers_name }}" readonly
                                                    disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputStatus">Immunization Status :</label>
                                                <input type="text" class="form-control is-disabled" id="immunized_status"
                                                    placeholder="" value="{{ $student->immunized_status }}" readonly
                                                    disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEnrolled">Enrolled :</label>
                                                @if ($enrollment_periods)
                                                    <input type="text" class="form-control is-disabled" id="enrollment"
                                                        placeholder="Name" value="Yes" readonly disabled>
                                                @else
                                                    <input type="text" class="form-control is-disabled" id="enrollment"
                                                        placeholder="Name" value="No" readonly disabled>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputGraduate">Graduated :</label>
                                                @if ($graduations)
                                                    <input type="text" class="form-control is-disabled" id="graduation"
                                                        placeholder="Yes" value="Yes" readonly disabled>
                                                @else
                                                    <input type="text" class="form-control is-disabled" id="graduation"
                                                        placeholder="No" value="No" readonly disabled>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPhoneNo">Student Situation :</label>
                                                <textarea type="email" class="form-control is-disabled"
                                                    id="student_situation" placeholder=""
                                                    value="{{ $student->student_situation }}" disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-3 d-md-flex">
                                            <button type="button"
                                                class="btn btn-default btn-primary form-enable btn-edit js-edit mr-2">Edit</button>
                                            <button type="submit"
                                                class="btn btn-default btn-primary form-enable  btn-save js-save mr-2">Save</button>
                                            <button type="button"
                                                class="btn btn-default btn-primary  btn-save js-cancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="modal fade bd-example-modal-lg" id="studentsDetailsModal" tabindex="-1" role="dialog"
                        aria-labelledby="studentGraduationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="studentGraduationModalLabel">Add New Student</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="new-student-record">
                                        <div class="row">
                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">First Name:</label>
                                                    <input class="form-control" type="text" id='student_first_name'>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{ $student->id }}" id='student'
                                                name="student-name" class="form-control">
                                            <input type="hidden" value="{{ $parent->id }}" id='parents_id'
                                                name="parents_id">

                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Middle Name:</label>
                                                    <input type="text" id="student_middle_name" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Last/Family
                                                        Name:</label>
                                                    <input type="text" id="student_last_name" required class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group lato-italic info-detail d-flex">
                                                    <div>
                                                        <label for="">Gender <sup>*</sup></label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-0" type="radio"
                                                            name="student_gender" id="student_gender" value="Male" required>
                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-0" type="radio"
                                                            name="student_gender" value="Female" id="gender">
                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Date of Birth:</label>
                                                    <input type="text" id="student_d_o_b" class="form-control datepicker"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Email Address
                                                    </label>
                                                    <input type="email" id="student_email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Cell Phone</label>
                                                    <input type="text" id="student_phone" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">National ID
                                                    </label>
                                                    <input type="text" id="students_student_id" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Is this student
                                                        immunized?
                                                    </label>
                                                    <input type="text" id="student_immunized_status" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- nav tab starts --}}
                    <nav class="student-detail_documents">
                        <div class="nav nav-tabs justify-content-start" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="studentActivity-tab" data-toggle="tab" href="#studentActivity"
                                role="tab" aria-controls="studentActivity" aria-selected="true">Activity</a>
                            <a class="nav-link" id="studentEnrollments-tab" data-toggle="tab" href="#studentEnrollments"
                                role="tab" aria-controls="studentEnrollments" aria-selected="false">Enrollments</a>
                            <a class="nav-link" id="studentTranscript-tab" data-toggle="tab" href="#studentTranscript"
                                role="tab" aria-controls="studentTranscript" aria-selected="false">Transcript</a>
                            <a class="nav-link" id="studentRecords-tab" data-toggle="tab" href="#studentRecords" role="tab"
                                aria-controls="studentRecords" aria-selected="false">Records</a>
                            <a class="nav-link" id="studentDocuments-tab" data-toggle="tab" href="#studentDocuments"
                                role="tab" aria-controls="studentDocuments" aria-selected="false">Documents</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        {{-- activities --}}

                        <div class="tab-pane fade show active" id="studentActivity" role="tabpanel"
                            aria-labelledby="studentActivity-tab">
                            {{-- Student-activity --}}
                            <section class="Student-activity" id="Student-activity">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="overflow-auto max-table">
                                            <table class="table table-striped table-styling w-100 table-vertical_scroll">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Notes</th>
                                                        <th scope="col" class="text-right"><button type="button"
                                                                class="btn btn-modal ml-3" data-toggle="modal"
                                                                data-target="#Student-activityModal"
                                                                data-whatever="@getbootstrap"><img src="/images/add.png"
                                                                    alt=""><img src="/images.add.png" alt=""></button></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($notes as $note)
                                                        <tr>
                                                            <td>{{ $note->created_at->format('M j, Y') }}</td>
                                                            <td>{{ $note->notes }}</td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            {{-- Student-activityModal --}}
                            <div class="modal fade bd-example-modal-lg" id="Student-activityModal" tabindex="-1"
                                role="dialog" aria-labelledby="#Student-activityModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="Student-activityModalLabel">Student Activity</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body py-2 px-md-4 px-2">
                                            <form id="add-new-notes">
                                                <div class="form-group">
                                                    <input type="hidden" value="{{ $student->id }}"
                                                        id="student_name_for_notes">
                                                    <input class="form-control" type="hidden" value="{{ $parent->id }}"
                                                        id='parent_id'>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Notes:</label>
                                                    <textarea id="message_text" class="form-control" id="message_text"
                                                        required onKeyPress="if(this.value.length==2000) return false;"
                                                        maxlength="2000"></textarea>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- enrollments --}}
                        <div class="tab-pane fade" id="studentEnrollments" role="tabpanel"
                            aria-labelledby="studentEnrollments-tab">
                            <section class="enrollments" id="enrollments">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="overflow-auto max-table">
                                            <table class="table table-striped table-styling w-100 table-vertical_scroll">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Student Name</th>
                                                        <th scope="col">Start Date</th>
                                                        <th scope="col">End Date</th>
                                                        <th scope="col">Grade</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Details</th>
                                                        <th scope="col" class="text-right"><button type="button"
                                                                class="btn btn-modal ml-3" data-toggle="modal"
                                                                data-target="#enrollmentsModal"
                                                                data-whatever="@getbootstrap"><img src="/images/add.png"
                                                                    alt=""><img src="/images.add.png" alt=""></button></th>
                                                        <th scope="col" class="text-right"><a
                                                                href="{{ route('admin.update.allenrollment', $student->id) }}"
                                                                class="btn btn-primary">
                                                                Update All Enrollment Paid</a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payment_info as $payment)
                                                        <tr>
                                                            <td>{{ Carbon\Carbon::parse($payment->created_at)->format('M j, Y') }}
                                                            </td>
                                                            <td>{{ getStudentData($payment->student_profile_id) }}</td>
                                                            <td>{{ Carbon\Carbon::parse($payment->start_date_of_enrollment)->format('M j, Y') }}
                                                            </td>
                                                            <td>{{ Carbon\Carbon::parse($payment->end_date_of_enrollment)->format('M j, Y') }}
                                                            </td>
                                                            <td>{{ $payment->grade_level }}</td>
                                                            @if ($payment->status === 'paid')
                                                                <td>Paid</td>
                                                            @elseif($payment->status ==='pending')
                                                                <td>Pending</td>
                                                            @endif
                                                            <td>
                                                                <a
                                                                    href=" {{ route('admin.edit.payment.status', $payment->id) }}"><i
                                                                        class=" fas fa-edit"
                                                                        onclick="return myFunction();"></i></a>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="modal fade bd-example-modal-lg" id="enrollmentsModal" tabindex="-1" role="dialog"
                                aria-labelledby="enrollmentsModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="enrollmentsModalLabel">Add Enrollments</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="add-new-enrollments">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <input type="hidden" value="{{ $parent_id }}" id='parent_id'
                                                            name="parent_id" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="hidden" value="{{ $student->id }}"
                                                            id='student_name_enroll' name="student_name"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group  col-md-6">
                                                        <label for="recipient-name" class="col-form-label">Enrollment
                                                            Period</label>
                                                        <select id="enrollment_period" required class="form-control">
                                                            <option value="annual">Annual</option>
                                                            <option value="half">Semester</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="recipient-name" class="col-form-label">Start Date of
                                                            Enrollment:</label>
                                                        <input type="date" class="form-control" id="start_date" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="message-text" class="col-form-label">End Date of
                                                            Enrollment:</label>
                                                        <input type="date" class="form-control" id="end_date" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group lato-italic info-detail">
                                                            <label for="">Grade <sup>*</sup></label>
                                                            <div class="row">
                                                                <div class="col-6">


                                                                    <div class="form-check" required>
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" id="grade_level[]"
                                                                            value="Ungraded" required>
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            Ungraded
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" id="grade_level[]"
                                                                            value="Preschool Age 3">
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            Preschool Age 3
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" id="grade_level[]"
                                                                            value="Preschool Age 4">
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            Preschool Age 4
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" id="grade_level[]"
                                                                            value="Kindergarten" required>
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            Kindergarten
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" id="grade_level[]"
                                                                            value="1" required>
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            1
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" id="grade_level[]"
                                                                            value="2" required>
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            2
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" id="grade_level[]"
                                                                            value="3" required>
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            2
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" id="grade_level[]"
                                                                            value="4" required>
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            4
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" id="grade_level[]"
                                                                            value="5" required>
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            5
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" value="6"
                                                                            id="grade_level[]">
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            6
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" value="7"
                                                                            id="grade_level[]">
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            7
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" value="8"
                                                                            id="grade_level[]">
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            8
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" value="9"
                                                                            id="grade_level[]">
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            9
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" value="10"
                                                                            id="grade_level[]">
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            10
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" value="11"
                                                                            id="grade_level[]">
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            11
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input mt-1" type="radio"
                                                                            name="grade_level[]" value="12"
                                                                            id="grade_level[]">
                                                                        <label class="form-check-label pl-1 pl-sm-0">
                                                                            12
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-md-6">
                                                        <label for="recipient-name" class="col-form-label">Enrollment
                                                            Payment Status</label>
                                                        <select id="enrollment_status" required class="form-control">
                                                            <option value="paid">Paid</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group  col-md-6">
                                                        <label for="recipient-name" class="col-form-label">Amount</label>
                                                        <select id="amount_status" required class="form-control">
                                                            <option value="375">$ 375</option>
                                                            <option value="200">$ 200</option>
                                                            <option value="50">$ 50</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- transcript --}}
                        <div class="tab-pane fade" id="studentTranscript" role="tabpanel"
                            aria-labelledby="studentTranscript-tab">
                            <section class="transcripts-detail" id="transcripts">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="overflow-auto max-table">
                                            <table class="table table-striped table-styling w-100 table-vertical_scroll">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Transcript</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Action</th>
                                                        <th scope="col" class="text-right"><button type="button"
                                                                class="btn btn-modal ml-3" data-toggle="modal"
                                                                data-target="#transcriptModal"
                                                                data-whatever="@getbootstrap"><img src="/images/add.png"
                                                                    alt=""><img src="/images.add.png" alt=""></button></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($transcripts as $transcript)
                                                        <tr>
                                                            <td>{{ $transcript->period }}</td>

                                                            <td>{{ $transcript['transcriptPayment']['status'] }}</td>
                                                            <td>{{ $transcript['transcriptPayment']['amount'] }}</td>
                                                            <td> <a
                                                                    href="{{ route('admin.transpayment.edit', $transcript['transcriptPayment']['id']) }}">
                                                                    <i class=" fas fa-arrow-alt-circle-right"></i></a></td>
                                                            <td></td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </div>
                        <div class="modal fade bd-example-modal-lg" id="transcriptModal" tabindex="-1" role="dialog"
                            aria-labelledby="transcriptModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transcriptModalLabel">Generate Transcript</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="add-transcript">
                                            <div class="row">

                                                <input type="hidden" value="{{ $student->id }}" id='std_id'
                                                    name="student-name" class="form-control">

                                                <input type="hidden" value="{{ $parent->id }}" id='parent_id'
                                                    name="parent_id">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Period</label>
                                                        <select id="transcript_period" class="form-control" required
                                                            onchange="getTranscriptval();">
                                                            <option value="">Select...</option>
                                                            <option value="K-8">K-8</option>
                                                            <option value="9-12">9-12</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Amount<span
                                                                class="required">*</span></label>
                                                        <select type="" id="amount" class="form-control" required
                                                            onchange="getTotalTranscript();">
                                                            <option value="">Select...</option>
                                                            <option value="25">25</option>
                                                            <option value="80">80</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Quantity
                                                            <span class="required">*</span></label>
                                                        <input type="number" id="quantity" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Status</label>
                                                        <select type="" id="status" class="form-control paymentDisplay"
                                                            required>
                                                            <option value="">Select</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="paid">Paid</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group transction-div">
                                                        <label for="message-text" class="col-form-label">Transaction
                                                            ID</label>
                                                        <input type="text" id="transcript_transaction_id"
                                                            class="form-control custom_letter_transction">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group payment-div">
                                                        <label for="message-text" class="col-form-label">Payment
                                                            Mode</label>
                                                        <select type="" id="transcript_pay_mode"
                                                            class="form-control custom_letter_payment_mode">
                                                            <option value="">Select One </option>
                                                            <option value="Credit Card">Credit Card</option>
                                                            <option value="Paypal">Paypal</option>
                                                            <option value="Bank Transfer">Bank Transfer</option>
                                                            <option value="MoneyGram">MoneyGram</option>
                                                            <option value="Check Or Money Order"> Check Or Money Order
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Note
                                                        </label>
                                                        <textarea style="height:120px;" id="notes" class="form-control"
                                                            onKeyPress="if(this.value.length==2000) return false;"
                                                            maxlength="2000"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- records --}}
                        <div class="tab-pane fade" id="studentRecords" role="tabpanel" aria-labelledby="studentRecords-tab">
                            <section class="records" id="records">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="overflow-auto max-table">
                                            <table class="table table-striped table-styling w-100 table-vertical_scroll">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Student Name</th>
                                                        <th scope="col">School Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Phone Number</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>

                                                        <th scope="col" class="text-right"><button type="button"
                                                                class="btn btn-modal ml-3" data-toggle="modal"
                                                                data-target="#recordsModal"
                                                                data-whatever="@getbootstrap"><img src="/images/add.png"
                                                                    alt=""><img src="/images.add.png" alt=""></button>
                                                        </th>
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
                                                                @elseif($records->request_status=='Record
                                                                    Received')
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
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="modal fade bd-example-modal-lg" id="recordsModal" tabindex="-1" role="dialog"
                                aria-labelledby="recordsModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="recordsModalLabel">Create New Record</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="add-record-request">
                                                <div class="row">
                                                    <input type="hidden" value="{{ $student->id }}"
                                                        id='record_student_id' name="student-name" class="form-control">

                                                    <input type="hidden" value="{{ $parent->id }}" id='parent_id'
                                                        name="parent_id">
                                                    <div class="form-group col-md-6">
                                                        <label for="recipient-name" class="col-form-label">School
                                                            Name:</label>
                                                        <input type="text" class="form-control" id="school_name"
                                                            id="recipient-name" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="message-text" class="col-form-label">Email
                                                            Address:</label>
                                                        <input type="email" id="email_add" class="form-control" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="message-text" class="col-form-label">Fax
                                                            Number:</label>
                                                        <input type="text" id="fax_number" class="form-control" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="message-text" class="col-form-label">Phone
                                                            Number:</label>
                                                        <input type="text" id="phone_number" class="form-control" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="message-text" class="col-form-label">Last Grade
                                                            In
                                                            School</label>
                                                        <input type="text" id="last_grade" class="form-control" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="message-text" class="col-form-label">Street
                                                            Address</label>
                                                        <input type="text" id="record_street_address" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="message-text" class="col-form-label">City</label>
                                                        <input type="text" id="record_city" class="form-control" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="message-text" class="col-form-label">State</label>
                                                        <input type="text" id="record_state" class="form-control" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="message-text" class="col-form-label">Zip
                                                            Code</label>
                                                        <input type="text" id="record_zip_code" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="message-text" class="col-form-label">Country</label>
                                                        <input type="text" id="record_country" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- documents --}}
                        <div class="tab-pane fade" id="studentDocuments" role="tabpanel"
                            aria-labelledby="studentDocuments-tab">
                            <section class="documents" id="documents">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="overflow-auto max-table">
                                            <table class="table table-striped table-styling w-100 table-vertical_scroll">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Student Name</th>
                                                        <th scope="col">File Name</th>
                                                        <th scope="col">Document Type</th>
                                                        <th scope="col">View Documents</th>
                                                        <th scope="col">Upload Documents</th>
                                                        <th scope="col" class="text-right"> <button type="button"
                                                                class="btn btn-modal ml-3" data-toggle="modal"
                                                                data-target="#documentsModal"
                                                                data-whatever="@getbootstrap"><img src="/images/add.png"
                                                                    alt=""><img src="/images.add.png" alt=""></button>
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($documents as $document)
                                                        <tr>
                                                            <td>{{ $document->created_at->format('M j,Y') }}</td>
                                                            <td>{{ $document['student']['fullname'] }}</td>
                                                            <td>{{ $document->original_filename }}</td>
                                                            <td>{{ $document->document_type }}</td>
                                                            <td><a
                                                                    href=" {{ route('admin.edit.uploadedDocument', $document->id) }}">View
                                                                    Documents</a></br></td>
                                                            <td><a
                                                                    href=" {{ route('admin.edit.upload', $document->student_profile_id) }}">Upload
                                                                    Documents</a></br></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="modal fade bd-example-modal-lg" id="documentsModal" tabindex="-1" role="dialog"
                                aria-labelledby="documentsModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="documentsModalLabel">Upload Documents</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="add-documents" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <input type="hidden" value="{{ $parent_id }}" id='parent_id'
                                                            name="parent_id">
                                                        <input type="hidden" value="{{ $student->id }}" id='student_idd'
                                                            name="student_id">
                                                    </div>
                                                    <div class="form-group col-12 d-flex">
                                                        <input type="checkbox" id="is_upload" value="1"
                                                            class="form-control choose-btn mt-1 mr-2">
                                                        <label for="message-text" class="col-form-label">
                                                            Want to upload in Student Dashboard *</label>

                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="message-text" class="col-form-label">Upload
                                                            Document</label>
                                                        <input type="file" id="file" class="form-control choose-btn"
                                                            required>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="message-text" class="col-form-label">
                                                            Document Type</label>
                                                        <textarea id="doc_type" class="form-control choose-btn"
                                                            required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
    </section>

@endsection
