@extends('admin.app')

@section('content')
<section class="content container-fluid  my-3">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- first card parent details -->
  <div class="card family-details px-3 my-3">
    <ul class="nav overflow-auto" id="to-the-top">
      <li class="nav-item">
        <a class="nav-link" href="#parent-details" aria-controls="parent-details" aria-selected="true">Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#student-details" aria-controls="student-details" aria-selected="true">Students</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#notes" aria-controls="notes" aria-selected="true">Notes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#orders" aria-controls="orders" aria-selected="true">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#enrollments" aria-controls="enrollments" aria-selected="true">Enrollments</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#records" aria-controls="records" aria-selected="true">Records</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#documents" aria-controls="documents" aria-selected="true">Documents</a>
      </li>
    </ul>


    {{-- parents-details --}}
    {{-- parents-details --}}
    <section class="parents-details pb-3" id="parent-details">
      <div class="tab-content">
        {{-- -------------- first tab --}}

        <div class="row">
          <div class="col-12 d-flex align-items-center">
            <h2 class="pr-3">{{ $parent->p1_first_name }} {{ $parent->p1_middle_name }}
              {{ $parent->p1_last_name }} {{ $parent->p2_first_name }} {{ $parent->p2_middle_name }}
              {{ $parent->p2_last_name }}</h2>
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ $parent->status === 0 ? 'Active' : 'Inactive' }}
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Active</a>
                <a class="dropdown-item" href="#">Inactive</a>
              </div>
            </div>
          </div>
          <div class="col-12">Date Created: {{ $parent->created_at->format('M j, Y') }} </div>

          {{-- parent detil-1 --}}
          <div class="col-md-12">
            <form class="is-readonly row" id="sampleForm">

              <div class="col-md-6">
                <h3 class="mt-3">parent-details-1</h3>
                <div class="form-group">
                  <label for="exampleInputPassword1">First Name :</label>
                  <input type="text" class="form-control is-disabled" name="p1_first_name" id="exampleInputPassword1"
                    placeholder="" value="{{ $parent->p1_first_name }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Middle Name :</label>
                  <input type="text" class="form-control is-disabled" name="p1_middle_name" id="exampleInputPassword1"
                    placeholder="" value="{{ $parent->p1_middle_name }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name :</label>
                  <input type="text" class="form-control is-disabled" name="p1_last_name" id="exampleInputPassword1"
                    placeholder="" value="{{ $parent->p1_last_name }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email :</label>
                  <input type="email" class="form-control is-disabled" name="p1_email" id="exampleInputEmail1"
                    placeholder="" value="{{ $parent->p1_email }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone :</label>
                  <input type="email" class="form-control is-disabled" name="p1_cell_phone" id="exampleInputEmail1"
                    placeholder="" value="{{ $parent->p1_cell_phone }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"> Home Phone :</label>
                  <input type="email" class="form-control is-disabled" name="p1_home_phone" id="exampleInputEmail1"
                    placeholder="" value="{{ $parent->p1_home_phone }}" disabled>
                </div>
                <h3 class="mt-3">Address</h3>
                <div class="form-group">
                  <label for="exampleInputEmail1">Street :</label>
                  <input type="email" class="form-control is-disabled" id="street" placeholder="" name="street_address"
                    value="{{ $parent->street_address }}" disabled>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">City :</label>
                      <input type="email" class="form-control is-disabled" id="city" placeholder="" name="city"
                        value="{{ $parent->city }}" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">State :</label>
                      <input type="email" class="form-control is-disabled" id="state" placeholder="" name="state"
                        value="{{ $parent->state }}" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Country :</label>
                      <input type="email" class="form-control is-disabled" id="country" placeholder="" name="country"
                        value="{{ $parent->country }}" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Zip Code :</label>
                      <input type="zip_code" class="form-control is-disabled" id="zip_code" placeholder="" name="state"
                        value="{{ $parent->zip_code }}" disabled>
                    </div>
                  </div>
                </div>
              </div>

              {{-- parents details 2 --}}

              <div class="col-md-6">
                <h3 class="mt-3">parent-details-2</h3>
                <div class="form-group">
                  <label for="exampleInputPassword1">First Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder=""
                    value="{{ $parent->p2_first_name }}" name="p2_first_name"" disabled>
                    </div>
                    <div class=" form-group">
                  <label for="exampleInputPassword1">Middle Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder=""
                    name="p2_middle_name" value="{{ $parent->p2_middle_name }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder=""
                    name="p2_last_name" value="{{ $parent->p2_last_name }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email :</label>
                  <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                    name="p2_email" value="{{ $parent->p2_email }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone :</label>
                  <input type="email" class="form-control is-disabled" name="p2_cell_phone" id="exampleInputEmail1"
                    placeholder="" value="{{ $parent->p2_cell_phone }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Home Phone :</label>
                  <input type="email" class="form-control is-disabled" name="p2_home_phone" id="exampleInputEmail1"
                    placeholder="" value="{{ $parent->p2_home_phone }}" disabled>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                  <h3 class="mt-3 mb-2">Address </h3>
                  <div class="text-right d-flex align-items-center">
                    <input class="mt-3 mb-3" type="checkbox" id="check" name="check" value="">
                    <label class=" ml-2 mt-3 mb-2" for="check">Same Address as Parent 1</label>
                  </div>


                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Street :</label>
                  <input type="text" class="form-control is-disabled" placeholder="" id="street2" name="street2"
                    disabled>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">City :</label>
                      <input type="text" class="form-control is-disabled" placeholder="" value="" id="city2" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">State :</label>
                      <input type="text" class="form-control is-disabled" placeholder="" value="" id="state2" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Country :</label>
                      <input type="text" class="form-control is-disabled" placeholder="" value="" id="country2"
                        disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Zip code :</label>
                      <input type="text" class="form-control is-disabled" placeholder="" value="" id="zip_code2"
                        disabled>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 pt-3 d-md-flex">
                <button type="button"
                  class="btn btn-default btn-primary form-enable btn-edit js-edit mr-2">Edit</button>
                <button type="button"
                  class="btn btn-default btn-primary form-enable  btn-save js-save mr-2">Save</button>
                <button type="button" class="btn btn-default btn-primary  btn-save js-cancel">Cancel</button>
              </div>
          </div>
        </div>
      </div>
    </section>
    {{-- row 2 --}}
    <div class="row my-2 ">
      <div class="col-md-6">
        <form>
          <div class="form-group">
            <h3>Reps/Group</h3>
            <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder="Name"
              value="Benjamin" disabled>
          </div>
        </form>
      </div>
      <div class="col-md-6 ">
        <h3>Reps/Group</h3>
        <div class="overflow-auto max-table">
          <table class="table table-striped table-styling w-100 table-vertical_scroll">
            <thead class="thead-light">
              <tr>
                <th scope="col">Student Name</th>
                <th scope="col">Name</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>MM/DD/YYYY</td>
                <td>Livingston David Benjamin</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>




    {{-- student-details --}}
    <section class="parents-details py-5 my-3" id="student-details">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Students</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Student Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">DOB</th>
                  <th scope="col">GRADE</th>
                  <th scope="col">Enrolled</th>
                  <th scope="col">Graduated</th>
                  <th scope="col">Student Details</th>
                  <th scope="col">Email</th>
                  <th scope="col"><button type="button" class="btn btn-primary btn-modal ml-3" data-toggle="modal"
                      data-target="#studentDetailsModal" data-whatever="@getbootstrap"><img src="/images/add.png"
                        alt=""><img src="/images.add.png" alt=""></button></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($allstudent as $student)
                <tr>
                  <td>{{ $student->fullname }}</td>
                  <td>{{$student->gender}}</td>
                  <td>{{ $student->d_o_b->format('M j, Y') }}</td>
                  <td></td>
                  <td>Yes</td>
                  <td></td>
                  <td>{{ $student->email }}</td>
                  <td><a href=" {{ route('admin.edit-student', $student->id) }}">View
                      Student Details</a></br></td>
                  <td></td>
                </tr>
                @endforeach
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
            <h5 class="modal-title" id="studentDetailsModalLabel">Add New Student</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="add-new-student">
              <div class="row">

                <div class="col-lg-4 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">First Name:</label>
                    <input class="form-control" type="text" value="{{ $parent->id }}" id='parent_id' name="parent_id">
                  </div>
                </div>

                <div class="col-lg-4 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Middle Name:</label>
                    <input type="text" id="middle_name" class="form-control">
                  </div>
                </div>

                <div class="col-lg-4 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Last/Family Name:</label>
                    <input type="text" id="last_name" required class="form-control">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group lato-italic info-detail">
                    <label for="">Gender <sup>*</sup></label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" required>
                      <label class="form-check-label pl-1 pl-sm-0">
                        Male
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" value="Female" id="gender">
                      <label class="form-check-label pl-1 pl-sm-0">
                        Female
                      </label>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Date of Birth:</label>
                    <input type="text" id="d_o_b" class="form-control datepicker" required>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Email Address
                    </label>
                    <input type="email" id="email" class="form-control">
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Date of Birth:</label>
                    <input type="text" id="d_o_b" class="form-control datepicker" required>
                  </div>
                </div>

                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Cell Phone</label>
                    <input type="text" id="phone" class="form-control">
                  </div>
                </div>

                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">National ID
                    </label>
                    <input type="text" id="student_id" class="form-control">
                  </div>
                </div>

                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Is this student immunized?
                    </label>
                    <input type="text" id="immunized_status" class="form-control">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>

      
    </div>
  </div>
  {{-- notes --}}
  <section class="notes  py-5 my-3" id="notes">
    <div class="row">
      <div class="col-12">
        <h2 class="pr-3">Notes</h2>
        <div class="overflow-auto max-table">
          <table class="table table-striped table-styling w-100 table-vertical_scroll">
            <thead class="thead-light">
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Notes</th>
                <th scope="col" class="text-right"><button type="button" class="btn btn-primary btn-modal ml-3"
                    data-toggle="modal" data-target="#notesModal" data-whatever="@getbootstrap"><img
                      src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($getNotes as $getNote)
              <tr>
                <td>{{$getNote->created_at->format('M j, Y') }}</td>
                <td>{{$student->Notes}}</td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade bd-example-modal-lg" id="notesModal" tabindex="-1" role="dialog"
    aria-labelledby="#notesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="notesModalLabel">Add Notes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">For student</label>
              <select id="student-name">

                @foreach ($allstudent as $student)

                <option value="{{ $student->id }}">{{ $student->first_name }}</option>

                @endforeach
              </select>
              <input type="hidden" value="{{ $parent->id }}" id='parent_id' name="parent_id">

            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Notes:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

  {{-- order --}}
  <section class="orders-detail  py-5 my-3" id="orders">
    <div class="row">
      <div class="col-12">
        <h2 class="pr-3">Orders</h2>
        <div class="overflow-auto max-table">
          <table class="table table-striped table-styling w-100 table-vertical_scroll">
            <thead class="thead-light">
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Paid By</th>
                <th scope="col">Order Total</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Status</th>
                <th scope="col">Details</th>
                <th scope="col" class="text-right"> <button type="button" class="btn btn-primary btn-modal ml-3"
                    data-toggle="modal" data-target="#orderModal" data-whatever="@getbootstrap"><img
                      src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
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
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade bd-example-modal-lg" id="orderModal" tabindex="-1" role="dialog"
    aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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

  {{-- Enrollments --}}
  <section class="enrollments  py-5 my-3" id="enrollments">
    <div class="row">
      <div class="col-12">
        <h2 class="pr-3">Enrollments</h2>
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
                <th scope="col" class="text-right"><button type="button" class="btn btn-primary btn-modal ml-3"
                    data-toggle="modal" data-target="#enrollmentsModal" data-whatever="@getbootstrap"><img
                      src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($payment_info as $payment)
              <tr>
                <td>{{ Carbon\Carbon::parse($payment->created_at)->format('M j, Y') }}</td>
                <td>{{getStudentData($payment->student_profile_id)}}</td>
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
                  <a href=" {{ route('admin.edit.payment.status', $payment->id) }}"><i class=" fas fa-edit"
                      onclick="return myFunction();"></i></a>
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
  <div class="modal fade bd-example-modal-lg" id="enrollmentsModal" tabindex="-1" role="dialog"
    aria-labelledby="enrollmentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="enrollmentsModalLabel">New message</h5>
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

  {{-- Records --}}
  <section class="records  py-5 my-3" id="records">
    <div class="row">
      <div class="col-12">
        <h2 class="pr-3">Records</h2>
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
                    data-toggle="modal" data-target="#recordsModal" data-whatever="@getbootstrap"><img
                      src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
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
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">For student</label>
              <select id="student-name">

                @foreach ($allstudent as $student)

                <option value="{{ $student->id }}">{{ $student->first_name }}</option>

                @endforeach
              </select>
              <input type="hidden" value="{{ $parent->id }}" id='parent_id' name="parent_id">

            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">School Name:</label>
              <input type="text" class="form-control" id="school_name" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Email Address:</label>
              <input type="email" id="email">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Fax Number:</label>
              <input type="text" id="fax_number">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Phone Number:</label>
              <input type="text" id="phone_number">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Street Address</label>
              <input type="text" id="street_address">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">City</label>
              <input type="text" id="city">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">State/Province/Region</label>
              <input type="text" id="state">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Zip/Postal Code</label>
              <input type="text" id="zipcode">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Country</label>
              <input type="text" id="country">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  {{-- Documents --}}
  <section class="documents  py-5 my-3" id="documents">
    <div class="row">
      <div class="col-12">
        <h2 class="pr-3">Documents</h2>
        <div class="overflow-auto max-table">
          <table class="table table-striped table-styling w-100 table-vertical_scroll">
            <thead class="thead-light">
              <tr>
                <th scope="col">Date</th>
                <th scope="col">File Name</th>
                <th scope="col">Document Type</th>
                <th scope="col">View Documents</th>
                <th scope="col">Upload Documents</th>
                <th scope="col" class="text-right"> <button type="button" class="btn btn-primary btn-modal ml-3"
                    data-toggle="modal" data-target="#documentsModal" data-whatever="@getbootstrap"><img
                      src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>

              </tr>
            </thead>
            <tbody>
              @foreach ($documents as $document)
              <tr>
                <td>{{ $document->created_at->format('M j,Y') }}</td>
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

  <div class="modal fade bd-example-modal-lg" id="documentsModal" tabindex="-1" role="dialog"
    aria-labelledby="documentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="documentsModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="add-documents" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">For student</label>
              <select id="student-name">

                @foreach ($allstudent as $student)

                <option value="{{ $student->id }}">{{ $student->first_name }}</option>

                @endforeach
              </select>
              <input type="hidden" value="{{ $parent->id }}" id='parent_id' name="parent_id">

            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Upload Document</label>
              <input type="file" id="file" class="form-control choose-btn" required>
            </div>

          </div>

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Upload</button>

        </form>
      </div>
    </div>
  </div>

  <div class="text-right pb-4">
    <a href="#to-the-top" class="btn btn-primary">Back to Top</a>
  </div>



  </div>
</section>





</section>


@endsection
