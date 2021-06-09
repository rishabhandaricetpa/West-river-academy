@extends('admin.app')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@section('content')
<section class="content container-fluid  my-3">

  <!-- first card student details -->
  <div class="card family-details px-3 my-3">
    <ul class="nav overflow-auto" id="to-the-top">
      <li class="nav-item">
        <a class="nav-link" href="#student-details" aria-controls="student-details" aria-selected="true">Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#student-payments" aria-controls="student-payments" aria-selected="true">Payments</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#transcript" aria-controls="transcript" aria-selected="true">Transcript</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#record-transfer" aria-controls="record-transfer" aria-selected="true">Record Transfer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#student-documents" aria-controls="student-documents" aria-selected="true">Documents</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#Graduation" aria-controls="Graduation" aria-selected="true">Graduation</a>
      </li>
    </ul>


    {{-- students-details --}}
    <section class="students-details  py-5" id="student-details">
      <div class="tab-content">
        {{---------------- first tab --}}
        <div class="row">
          <div class="col-12 d-flex align-items-center">
            <h2 class="pr-3">Benjamin & Chong Livingston</h2>
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Active
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Inactive</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
          <div class="col-12">Date Created:</div>

          {{-- student detil-1  --}}
          <div class="col-md-12">
            <form class="is-readonly row" id="sampleForm">

              <div class="col-md-6">
                {{-- <h3 class="mt-3">student-details-1</h3> --}}
                <div class="form-group">
                  <label for="exampleInputPassword1">First Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder="Name"
                    value="Benjamin" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Middle Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder="Name"
                    value="David" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder="Name"
                    value="Livingston" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputDOB">Date Of Birth :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputDOB" placeholder="MM/DD/YYYY"
                    value="MM/DD/YYYY" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputGender">Gender:</label>
                    <input type="text" class="form-control is-disabled" id="exampleInputMothersName" placeholder="Male"
                      value="Male" disabled>
                  </div>
                <div class="form-group">
                    <label for="exampleInputMothersName">Mother' Maiden Name :</label>
                    <input type="text" class="form-control is-disabled" id="exampleInputMothersName" placeholder="Mothers Name"
                      value="Mothers Name" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputStatus">Immunization Status :</label>
                    <input type="text" class="form-control is-disabled" id="exampleInputStatus" placeholder="Male"
                      value="Male" disabled>
                  </div>
              </div>

              {{-- students details 2 --}}

              <div class="col-md-6">
                {{-- <h3 class="mt-3">student-details-2</h3> --}}
                <div class="form-group">
                  <label for="exampleInputParent1">Parent - 1 :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputParent1" placeholder="Name"
                    value="Benjamin" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputParent2">Parent - 2 :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputParent2" placeholder="Name"
                    value="David" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEnrolled">Enrolled :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputEnrolled" placeholder="Name"
                    value="Yes" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputGrade">Grade :</label>
                  <input type="email" class="form-control is-disabled" id="exampleInputGrade" placeholder="10"
                    value="10" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputGraduate">Graduated :</label>
                  <input type="email" class="form-control is-disabled" id="exampleInputGraduate" placeholder="No"
                    value="" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputID">Graduated :</label>
                    <input type="email" class="form-control is-disabled" id="exampleInputID" placeholder="7889887"
                      value="" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPhoneNo">Phone :</label>
                    <input type="email" class="form-control is-disabled" id="exampleInputPhoneNo" placeholder="+91.898.889.8765"
                      value="" disabled>
                  </div>
        
              </div>
              <div class="col-12 pt-3 d-md-flex">
                <button type="button"
                  class="btn btn-default btn-primary form-enable btn-edit js-edit mr-2">Edit</button>
                <button type="button"
                  class="btn btn-default btn-primary form-enable  btn-save js-save mr-2">Save</button>
                <button type="button" class="btn btn-default btn-primary  btn-save js-cancel">Cancel</button>
              </div>

            </form>
          </div>



        </div>
      </div>
    </section>
   
    {{-- payments--}}
    <section class="students-details py-5 my-3" id="student-payments">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Payments</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                  <th scope="col">Grade Level</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Payment Status</th>
                  <th scope="col">Action</th>
                  <th scope="col" class="text-right"> <button type="button" class="btn btn-primary btn-modal ml-3"
                      data-toggle="modal" data-target="#studentDetailsModal" data-whatever="@getbootstrap"><img
                        src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>MM/DD/YYYY</td>
                  <td>2</td>
                  <td>345</td>
                  <td>Pending</td>
                  <td><a href="#">click here</a></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="studentDetailsModal" tabindex="-1" role="dialog"
      aria-labelledby="studentDetailsModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="studentDetailsModalLabel">New message</h5>
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
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>

    {{-- transcript--}}
    <section class="transcript py-5 my-3" id="transcript">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Transcript</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Transcript</th>
                  <th scope="col">Status</th>
                  <th scope="col">Enrollment Year</th>
                  <th scope="col">School Name</th>
                  <th scope="col">Grade</th>
                  <th scope="col">Action</th>
                  <th scope="col" class="text-right"><button type="button" class="btn btn-primary btn-modal ml-3"
                      data-toggle="modal" data-target="#transcriptModal" data-whatever="@getbootstrap"><img
                        src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td>pending</td>
                  <td>Melissa Manisha</td>
                  <td>2020</td>
                  <td>St.John</td>
                  <td>a</td>
                  <td><a href="#">click</a></td>
                  <td></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="transcriptModal" tabindex="-1" role="dialog" aria-labelledby="#transcriptModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="transcriptModalLabel">New message</h5>
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
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>

    {{-- record-transfer--}}
    <section class="record-transfer-detail  py-5 my-3" id="record-transfer">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Record Transfer</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Student Name</th>
                  <th scope="col">School Name</th>
                  <th scope="col">School Email</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Action</th>
                  <th scope="col" class="text-right"><button type="button" class="btn btn-primary btn-modal ml-3"
                      data-toggle="modal" data-target="#transcriptModal" data-whatever="@getbootstrap"><img
                        src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Melissa Manisha</td>
                  <td>school name</td>
                  <td>email</td>
                  <td>97376238779</td>
                  <td><a href="#">click</a></td>
                  <td></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="orderModalLabel">New message</h5>
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
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>

    {{--Enrollments --}}
    <section class="student-documents  py-5 my-3" id="student-documents">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Documents</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">File Name</th>
                  <th scope="col">Document Related To</th>
                  <th scope="col">Uploaded To Student Dashboard</th>
                  <th scope="col">Action</th>
                  <th scope="col"><button type="button" class="btn btn-primary btn-modal ml-3" data-toggle="modal"
                    data-target="#student-documentsModal" data-whatever="@getbootstrap"><img src="/images/add.png"
                      alt=""><img src="/images.add.png" alt=""></button></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td>Benjamin Livingston</td>
                  <td>$10</td>
                  <td><a href="#">action</a></td>
                  <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Benjamin Livingston</td>
                    <td>$10</td>
                    <td><a href="#">action</a></td>
                    <td></td>
                  </tr>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="student-documentsModal" tabindex="-1" role="dialog" aria-labelledby="student-documentsModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="student-documentsModalLabel">New message</h5>
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
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>

    {{--Records --}}
    <section class="Graduation  py-5 my-3" id="Graduation">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Graduation</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Date Applied</th>
                  <th scope="col">Expected Graduation Date</th>
                  <th scope="col">Status</th>
                  <th scope="col">Details</th>
                  <th scope="col">  <button type="button" class="btn btn-primary btn-modal ml-3" data-toggle="modal"
                    data-target="#GraduationModal" data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img
                      src="/images.add.png" alt=""></button></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>07/10/2020</td>
                  <td>07/10/2020</td>
                  <td>Pending</td>
                  <td><a href="#">details</a></td>
                  <td></td>
                </tr>
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="GraduationModal" tabindex="-1" role="dialog" aria-labelledby="GraduationModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="GraduationModalLabel">New message</h5>
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
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>

    <div class="text-right pb-4">
      <a href="#to-the-top" class="btn btn-primary">Back to Top</a>
    </div>



  </div>
</section>
{{-- <section class="content">
        <div class="container-fluid position-relative">
            <h1>Student Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <form method="post" class="row" action="{{ route('admin.edit-student.update', $student->id) }}"
enctype="multipart/form-data">
@csrf
<div class="form-group col-sm-6">
  <label>First/Given Name <sup>*</sup></label>
  <input class="form-control" id="first_name" value="{{ $student->first_name }}" name="first_name">
</div>
<input type='hidden' name="student_id" value="{{ $student->student_profile_id }}">
<div class="form-group col-sm-6">
  <label>Middle Name</label>
  <input class="form-control" id="middle_name" name="middle_name" value="{{ $student->middle_name }}">
</div>
<div class="form-group col-sm-6">
  <label>Last/Family Name <sup>*</sup></label>
  <input class="form-control" id="last_name" name="last_name" value="{{ $student->last_name }}">
</div>
<div class="form-group col-sm-6">
  <label>Date of Birth<sup>*</sup></label>
  <div class="position-relative w-100"> <i class="fas fa-calendar-alt" aria-hidden="true"></i><input
      class="form-control datepicker" id="dob" name="dob" value="{{ $student->d_o_b->format('M d Y') }}" required></div>
</div>
<div class="form-group col-sm-6">
  <label>Email Address</label>
  <input class="form-control" name="email" id="email" value="{{ $student->email }}">
</div>
<div class="form-group col-sm-6">
  <label>Cell Phone<sup>*</sup></label>
  <input class="form-control" id="cell_phone" name="cell_phone" value="{{ $student->cell_phone }}">
</div>
<div class="form-group col-sm-6">
  <label>National ID<sup>*</sup></label>
  <input class="form-control" id="student_id" name="student_id" value="{{ $student->student_Id }}">
</div>
<div class="form-group col-sm-6">
  <label>Immunization Status<sup>*</sup></label>
  <select class="form-control" name="immunized_status" value="{{ $student->immunized_status }}">
    <option>Yes, Graduation will come with school Graduation.</option>
    <option>Yes, I will provide Graduation.</option>
    <option>Yes, I plan to get immunizations soon.</option>
    <option>No, for personal reasons.</option>
    <option>No, for medical reasons.</option>
    <option>No, for religious reasons.</option>
  </select>
</div>
<div class="form-group col-sm-12">
  <label>Student Situation</label>
  <textarea class="form-control" name="student_situation"
    value="{{ $student->student_situation }}">{{ $student->student_situation }}</textarea>
</div>
<div>
</div>

<label class="px-3">Enrollment Period <sup>*</sup></label>
@foreach ($enrollment_periods as $enrollment_period)
<div class="form-group w-100 row mx-0">
  <input type="hidden" name="id[]" value="{{ $enrollment_period->id }}">
  <div class="col-md-4 mb-4 mb-sm-0">
    <label class="w-auto">Start Date </label>
    <input class="datepicker form-control" id="start_date_of_enrollment" type="text" name="start_date[]"
      value="{{ Carbon\Carbon::parse($enrollment_period->start_date_of_enrollment)->format('M j, Y') }}">
  </div>
  <div class="col-md-4  mb-4 mb-sm-0">
    <label class="w-auto">End Date </label>
    <input class="datepicker form-control" id="end_date_of_enrollment" type="text" name="end_date[]"
      value="{{ Carbon\Carbon::parse($enrollment_period->end_date_of_enrollment)->format('M j, Y') }}">
  </div>

  <div class="col-md-4 mb-4 mb-sm-0">
    <label class="w-auto">Grade Level</label>
    <select name="grade[]" class="form-control">
      <option value="Ungraded" @if ($enrollment_period->grade_level == 'Ungraded') selected="selected" @endif>Ungraded
      </option>
      <option value="Preschool Age 3" @if ($enrollment_period->grade_level ==
        'Preschool
        Age 3') selected="selected" @endif>
        Preschool
        Age 3
      </option>

      <option value="Preschool Age 4" @if ($enrollment_period->grade_level ==
        'Preschool
        Age 4') selected="selected" @endif>
        Preschool
        Age 4
      </option>

      <option value="Kindergarten" @if ($enrollment_period->grade_level == 'Kindergarten') selected="selected"
        @endif>Kindergarten</option>

      <option class="form-control" value="1" @if ($enrollment_period->grade_level == '1') selected="selected" @endif>1
      </option>

      <option class="form-control" value="2" @if ($enrollment_period->grade_level == '2') selected="selected" @endif>2
      </option>

      <option class="form-control" value="3" @if ($enrollment_period->grade_level == '3') selected="selected" @endif>3
      </option>

      <option class="form-control" value="4" @if ($enrollment_period->grade_level == '4') selected="selected" @endif>4
      </option>

      <option class="form-control" value="5" @if ($enrollment_period->grade_level == '5') selected="selected" @endif>5
      </option>

      <option class="form-control" value="6" @if ($enrollment_period->grade_level == '6') selected="selected" @endif>6
      </option>

      <option class="form-control" value="7" @if ($enrollment_period->grade_level == '7') selected="selected" @endif>7
      </option>

      <option class="form-control" value="8" @if ($enrollment_period->grade_level == '8') selected="selected" @endif>8
      </option>

      <option class="form-control" value="9" @if ($enrollment_period->grade_level == '9') selected="selected" @endif>9
      </option>

      <option class="form-control" value="10" @if ($enrollment_period->grade_level == '10') selected="selected"
        @endif>10</option>

      <option class="form-control" value="11" @if ($enrollment_period->grade_level == '11') selected="selected"
        @endif>11</option>

      <option class="form-control" value="12" @if ($enrollment_period->grade_level == '12') selected="selected"
        @endif>12</option>
    </select>
  </div>
</div>
@endforeach
<div class="col-md-6">
  <label>Upload Single/Multiple Documents<sup>*</sup></label>
  <label class="font-weight-bold text-secondary">
  </label>
  <input multiple="multiple" type="file" name="file[]" class="form-control choose-btn" multiple>
</div>
<!-- /.card-body -->
<div class="my-sm-4 my-3 col-12">
  <button type="submit" class="btn btn-primary">Update</button>
  <a type="button" href="{{ route('admin.genrate.adminConfirmition', $student->id) }}"
    class="btn btn-primary ml-3">Generate Confirmation</a>
  <a onclick="goBack()" class="btn btn-primary">Back</a>
</div>
<!-- student tab -->
<div class="col-12">
  <div class="card ">
    <div class="card-header p-0">
      <!-- START TABS DIV -->
      <div class="tabbable-responsive">
        <div class="tabbable">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="" data-toggle="tab" href="#first" role="tab" aria-controls="first"
                aria-selected="true">Enrollments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="student2" data-toggle="tab" href="#sixth" role="tab" aria-controls="sixth"
                aria-selected="false">Record Transfer </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="login" data-toggle="tab" href="#third" role="tab" aria-controls="third"
                aria-selected="false">Transcript K-8</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="transcript" data-toggle="tab" href="#transcript1" role="tab"
                aria-controls="transcript1" aria-selected="false">Transcript
                9-12</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="doc" data-toggle="tab" href="#documents" role="tab" aria-controls="documents"
                aria-selected="false">
                Documents</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Enrollment Information Starts-->
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="student1">
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
                  <a href=" {{ route('admin.edit.payment.status', $payment->id) }}"><i class=" fas fa-edit"
                      onclick="return myFunction();"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>


        </div>
        <!-- Enrollment Information Ends-->


        <!-- Record Transfer Information Starts-->
        <div class=" tab-pane fade" id="sixth" role="tabpanel" aria-labelledby="student2">
          <table id="example1" class="table table-bordered table-striped data-table">
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
              @foreach ($schoolRecords as $record)
              <tr>
                <td>{{ $record['student']['fullname'] }}</td>
                <td>{{ $record->school_name }}</td>
                <td><a class="transform-none" href="mailto:${{ $record->email }}">
                    {{ $record->email }}</a></td>
                <td>{{ $record->phone_number }}</td>
                @if (empty($record->request_status))
                <td>In Review </br>
                  @elseif($record->request_status=='Record Received')
                <td>Records Received </br>
                  @endif
                  @if ($record->resendCount)
                  Resend Requested:{{ $record->resendCount }}
                  @endif
                </td>

                <td>
                  <a href="{{ route('admin.student.schoolRecord', [$record->student_profile_id, $record->id]) }}">
                    <i class=" fas fa-arrow-alt-circle-right"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- Record Transfer Information Ends-->

        <!--  Transcript k-8 Information Starts-->
        <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="login">
          <table id="addressData" class="table table-bordered table-striped data-table">
            <thead>
              <tr>
                <th>Transcript</th>
                <th>Status</th>
                <th>Enrollment Year</th>
                <th>School Name</th>
                <th>Grade</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transcript as $transcripts)
              <tr>
                <td>{{ $transcripts->period }}</td>
                @if ($transcripts->status === 'completed')
                <td>Completed</td>
                @elseif($transcripts->status === 'paid') <td>Paid</td>
                @elseif($transcripts->status === 'approved') <td>Approved</td>
                @elseif($transcripts->status === 'canEdit') <td>Edit</td>
                @endif
                <td>{{ $transcripts->enrollment_year }}</td>
                <td>{{ $transcripts->school_name }}</td>
                <td>{{ $transcripts->grade }}</td>
                <td>
                  <a
                    href=" {{ route('admin.viewfull.transcript', [$transcripts->student_profile_id, $transcripts->transcript_id]) }}">View
                    K-8 Transcript</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!--  Transcript k-8 Information ENDS-->

        <!--Transcript 9-12 Information Starts -->
        <div class="tab-pane fade" id="transcript1" role="tabpanel" aria-labelledby="transcript">
          <table id="example1" class="table table-bordered table-striped data-table">
            <thead>
              <tr>
                <th>Transcript</th>
                <th>Status</th>
                <th>Enrollment Year</th>
                <th>School Name</th>
                <th>Grade</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transcript9_12s as $transcript9_12)
              <tr>
                <td>{{ $transcript9_12->period }}</td>
                @if ($transcript9_12->status === 'completed')
                <td>Completed</td>
                @elseif($transcript9_12->status === 'paid') <td>Paid</td>
                @elseif($transcript9_12->status === 'approved') <td>Approved
                </td>
                @elseif($transcript9_12->status === 'canEdit') <td>Edit</td>
                @endif
                <td>{{ $transcript9_12->enrollment_year }}</td>
                <td>{{ $transcript9_12->school_name }}</td>
                <td>{{ $transcript9_12->grade }}</td>
                <td><a
                    href=" {{ route('admin.viewfull.transcript9_12', [$transcript9_12->student_profile_id, $transcript9_12->transcript_id]) }}">View
                    9-12 Transcript</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!--Transcript 9-12 Information Ends  -->

        <!--Documents Information Starts  -->
        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="doc">
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
                                         @foreach ($uploadedDocuments as
                                            $uploadedDocument)
                                            <tr>
                                                <td>{{ $uploadedDocument->original_filename }}</td>
                                                <td>{{ $uploadedDocument->document_type }}</td>
                                                @if ($uploadedDocument->is_upload_to_student == 1)
                                                    <td>Yes</td>
                                                @else
                                                    <td>No</td>
                                                @endif
                                                <td>
                                                    <a
                                                        href="
            {{ route('admin.edit.uploadedDocument', $uploadedDocument->id) }}">
            <i class="fas fa-arrow-alt-circle-right"></i></a>
            </td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!--Documents Information Ends  -->
      </div>
    </div>
  </div>
</div>
</div>
</div>



</form>
</div>
</div>


</section> --}}

@endsection
