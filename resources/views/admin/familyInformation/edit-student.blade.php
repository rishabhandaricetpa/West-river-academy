@extends('admin.app')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@section('content')
<section class="content container-fluid  my-3">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
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
        <a class="nav-link" href="#record-transfer" aria-controls="record-transfer" aria-selected="true">Record
          Transfer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#student-documents" aria-controls="student-documents"
          aria-selected="true">Documents</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#Graduation" aria-controls="Graduation" aria-selected="true">Graduation</a>
      </li>
    </ul>


    {{-- students-details --}}
    <section class="students-details  py-5" id="student-details">
      <div class="tab-content">
        {{-- -------------- first tab --}}
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

          {{-- student detil-1 --}}
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
                  <input type="text" class="form-control is-disabled" id="exampleInputMothersName"
                    placeholder="Mothers Name" value="Mothers Name" disabled>
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
                  <input type="email" class="form-control is-disabled" id="exampleInputPhoneNo"
                    placeholder="+91.898.889.8765" value="" disabled>
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

    {{-- payments --}}
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
                        src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button>
                  </th>
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
    <div class="modal fade bd-example-modal-lg" id="studentDetailsModal" tabindex="-1" role="dialog"
      aria-labelledby="studentDetailsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
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

    {{-- transcript --}}
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
                        src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>

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
    <div class="modal fade bd-example-modal-lg" id="transcriptModal" tabindex="-1" role="dialog"
      aria-labelledby="transcriptModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
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
                <label for="recipient-name" class="col-form-label">Recipientsss:</label>
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


    {{-- record-transfer --}}
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
                  <th scope="col">Email</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>

                  <th scope="col" class="text-right"><button type="button" class="btn btn-primary btn-modal ml-3"
                      data-toggle="modal" data-target="#recordModal" data-whatever="@getbootstrap"><img
                        src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($recordTransfer as $records)
                <tr>
                  <td>{{ $records['student']['fullname'] }}</td>
                  <td>{{ $records->school_name }}</td>
                  <td><a class="transform-none" href="mailto:${{ $records->email }}">
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
                    <a href="{{ route('admin.student.schoolRecord', [$records->student_profile_id, $records->id]) }}">
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
    <div class="modal fade bd-example-modal-lg" id="recordModal" tabindex="-1" role="dialog"
      aria-labelledby="#recordModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="recordModalLabel">Record Transfer Request</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="add-record-request">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <input type="hidden" value="{{ $parent_id }}" id='parent_id' name="parent_id" class="form-control">
                    <input type="hidden" value="{{ $student->id }}" id='student-name' name="student-name"
                      class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">School Name:</label>
                    <input type="text" class="form-control" id="school_name" id="recipient-name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Email Address:</label>
                    <input type="email" id="email_add" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Fax Number:</label>
                    <input type="text" id="fax_number" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Phone Number:</label>
                    <input type="text" id="phone_number" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Street Address</label>
                    <input type="text" id="street_address1" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">City</label>
                    <input type="text" id="city1" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">State/Province/Region</label>
                    <input type="text" id="state1" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Zip/Postal Code</label>
                    <input type="text" id="zipcode1" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Country</label>
                    <input type="text" id="country1" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Last Grade In School</label>
                    <input type="text" id="last_grade" class="form-control">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>


    {{-- Documents --}}
    <section class="student-documents  py-5 my-3" id="student-documents">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Documents</h2>
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
                  <th scope="col" class="text-right"><button type="button" class="btn btn-primary btn-modal ml-auto" data-toggle="modal"
                      data-target="#student-documentsModal" data-whatever="@getbootstrap"><img src="/images/add.png"
                        alt=""><img src="/images.add.png" alt=""></button></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($documents as $document)
                <tr>
                  <td>{{ $document->created_at->format('M j,Y') }}</td>
                  <td>{{ $document['student']['fullname'] }}</td>
                  <td>{{ $document->original_filename }}</td>
                  <td>{{ $document->document_type }}</td>
                  <td><a href=" {{ route('admin.edit.uploadedDocument', $document->id) }}">View
                      Documents</a></br></td>
                  <td><a href=" {{ route('admin.edit.upload', $document->student_profile_id) }}">Upload
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
    <div class="modal fade bd-example-modal-lg" id="student-documentsModal" tabindex="-1" role="dialog"
      aria-labelledby="student-documentsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="student-documentsModalLabel">Upload Document</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-3">
            <form id="add-documents" enctype="multipart/form-data">
              <div class="form-group">
                <input type="hidden" value="{{ $parent_id }}" id='parent_id' name="parent_id">
                <input type="hidden" value="{{ $student->id }}" id='student-name' name="student-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Upload Document</label>
                <input type="file" id="file" class="form-control choose-btn" required>
              </div>
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Upload</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- Graduation --}}
    <section class="Graduation  py-5 my-3" id="Graduation">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Graduation</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Date Applied</th>
                  <th scope="col">Grade 9</th>
                  <th scope="col">Grade 10</th>
                  <th scope="col">Grade 11</th>
                  <th scope="col">Status</th>
                  <th scope="col">View</th>
                  <th scope="col"> <button type="button" class="btn btn-primary btn-modal ml-3" data-toggle="modal"
                      data-target="#GraduationModal" data-whatever="@getbootstrap"><img src="/images/add.png"
                        alt=""><img src="/images.add.png" alt=""></button></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($graduations as $graduation)
                <tr>
                  <td>{{ $graduation->created_at->format('M j, Y') }}</td>
                  <td>{{ $graduation->grade_9_info }}</td>
                  <td>{{ $graduation->grade_10_info }}</td>
                  <td>{{ $graduation->grade_11_info }}</td>
                  <td>{{ $graduation->status }}</td>
                  <td><a href="{{ route('admin.edit.graduation', $graduation->id) }}">View</td>
                  <td></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade bd-example-modal-lg" id="GraduationModal" tabindex="-1" role="dialog"
      aria-labelledby="GraduationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="GraduationModalLabel">Apply For Graduation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="add-graduation">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <input type="hidden" value="{{ $parent_id }}" id='parent_id' name="parent_id" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" value="{{ $student->id }}" id='student_id' name="student-name"
                      class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label for="recipient-name" class="col-form-label">Grade 9</label>
                    <select id="grade_9" required class="form-control">
                      <option value="I was enrolled in West River Academy.">I was enrolled in West River
                        Academy.
                      </option>
                      <option value="I homeschooled independently. (There are no transcripts that a school can send.)">
                        I homeschooled independently. (There are no transcripts that a school can send.)
                      </option>
                      <option value="I was enrolled in another school that can send or has already sent transcripts.">
                        I was enrolled in another school that can send or has already sent transcripts.
                      </option>
                      <option value="Others">Others</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="recipient-name" class="col-form-label">Grade 10</label>
                    <select id="grade_9" required class="form-control">
                      <option value="I was enrolled in West River Academy.">I was enrolled in West River
                        Academy.
                      </option>
                      <option value="I homeschooled independently. (There are no transcripts that a school can send.)">
                        I homeschooled independently. (There are no transcripts that a school can send.)
                      </option>
                      <option value="I was enrolled in another school that can send or has already sent transcripts.">
                        I was enrolled in another school that can send or has already sent transcripts.
                      </option>
                      <option value="Others">Others</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="recipient-name" class="col-form-label">Grade 11</label>
                    <select id="grade_9" required class="form-control">
                      <option value="I was enrolled in West River Academy.">I was enrolled in West River
                        Academy.
                      </option>
                      <option value="I homeschooled independently. (There are no transcripts that a school can send.)">
                        I homeschooled independently. (There are no transcripts that a school can send.)
                      </option>
                      <option value="I was enrolled in another school that can send or has already sent transcripts.">
                        I was enrolled in another school that can send or has already sent transcripts.
                      </option>
                      <option value="Others">Others</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="recipient-name" class="col-form-label">Status</label>
                    <select id="status-graduation" class="form-control">
                      <option value='pending'>Pending</option>
                      <option value='approved'>Approved</option>
                      <option value='paid'>Paid</option>
                      <option value='completed'>Completed</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="text-right pb-4">
    <a href="#to-the-top" class="btn btn-primary">Back to Top</a>
  </div>



  </div>
</section>

@endsection
