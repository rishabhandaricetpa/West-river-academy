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
            <h2 class="pr-3">{{ $parent->p1_first_name }} {{ $parent->p1_middle_name }}
              {{ $parent->p1_last_name }} {{ $parent->p2_first_name }} {{ $parent->p2_middle_name }}
              {{ $parent->p2_last_name }} </h2>
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
            <form class="is-readonly row students_store" id="sampleForm">

              <div class="col-md-6">
                {{-- <h3 class="mt-3">student-details-1</h3> --}}
                <div class="form-group">
                  <label for="exampleInputPassword1">First Name :</label>
                  <input type="text" class="form-control is-disabled" id="first_name" placeholder=""
                    value="{{ $student->first_name }}" disabled>
                    <input type='hidden' id="parent_id" name="parent_id" value="{{ $student->parent_profile_id }}">
                    <input type='hidden' id="students_id" name="students_id" value="{{ $student->id }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Middle Name :</label>
                  <input type="text" class="form-control is-disabled" id="middle_name" placeholder="Name"
                    value="{{ $student->middle_name }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name :</label>
                  <input type="text" class="form-control is-disabled" id="last_name" placeholder="Name"
                    value="{{ $student->last_name }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputDOB">Date Of Birth :</label>
                  <input type="text" class="form-control is-disabled" id="d_o_b" placeholder="MM/DD/YYYY"
                    value="{{ $student->d_o_b->format('F j, Y') }}" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputGender">Gender:</label>
                    <input type="text" class="form-control is-disabled" id="gender" placeholder=""
                      value="{{ $student->gender }}" disabled>
                  </div>
                <div class="form-group">
                    <label for="exampleInputMothersName">Email :</label>
                    <input type="email" class="form-control is-disabled" id="email" placeholder=""
                      value="{{ $student->email }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputMothersName">Phone :</label>
                    <input type="text" class="form-control is-disabled" id="cell_phone" placeholder=""
                      value="{{ $student->cell_phone }}" disabled>
                  </div>  
                  <div class="form-group">
                    <label for="exampleInputMothersName">National Id :</label>
                    <input type="text" class="form-control is-disabled" id="student_Id" placeholder=""
                      value="{{ $student->student_Id }}" disabled>
                  </div>  
                  <div class="form-group">
                    <label for="exampleInputMothersName">Birth City :</label>
                    <input type="text" class="form-control is-disabled" id="birth_city" placeholder=""
                      value="{{ $student->birth_city }}" disabled>
                  </div>
                  
              </div>

              {{-- students details 2 --}}

              <div class="col-md-6">
                {{-- <h3 class="mt-3">student-details-2</h3> --}}
                <div class="form-group">
                  <label for="exampleInputParent1">Parent - 1 :</label>
                  <input type="text" class="form-control is-disabled" id="p1_last_name" placeholder="Name"
                    value="{{$parent->p1_first_name}} {{$parent->p1_last_name}}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputParent2">Parent - 2 :</label>
                  <input type="text" class="form-control is-disabled" id="p2_last_name" placeholder="Name"
                    value="{{$parent->p2_first_name}} {{$parent->p2_last_name}}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputMothersName">Mother' Maiden Name :</label>
                  <input type="text" class="form-control is-disabled" id="mothers_name" placeholder=""
                    value="{{ $student->mothers_name }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputStatus">Immunization Status :</label>
                  <input type="text" class="form-control is-disabled" id="immunized_status" placeholder=""
                    value="{{ $student->immunized_status }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEnrolled">Enrolled :</label>
                  @if($enrollment_periods)
                  <input type="text" class="form-control is-disabled" id="enrollment" placeholder="Name"
                    value="Yes" disabled>
                    @else
                    <input type="text" class="form-control is-disabled" id="enrollment" placeholder="Name"
                    value="No" disabled>
                    @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputGraduate">Graduated :</label>
                  <input type="text" class="form-control is-disabled" id="graduation" placeholder="No"
                    value="" disabled>
                </div>
                  <div class="form-group">
                    <label for="exampleInputPhoneNo">Student Situation :</label>
                    <textarea type="email" class="form-control is-disabled" id="student_situation" placeholder=""
                      value="{{ $student->student_situation }}" disabled></textarea>
                  </div>
              </div>
              <div class="col-12 pt-3 d-md-flex">
                <button type="button"
                  class="btn btn-default btn-primary form-enable btn-edit js-edit mr-2">Edit</button>
                <button type="submit"
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

@endsection
