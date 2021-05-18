@extends('admin.app')

@section('content')
<section class="content">
  <div class="container-fluid position-relative">
    <h1>Parent Details</h1>
    <div class="form-wrap border py-5 px-25 position-relative">
      <!-- form start -->
      <form method="post" class="row" action="{{ route('admin.parent.update', $parent->id) }}">
        @csrf
        <div class="form-group col-sm-12">
          <label>User Status<sup>*</sup> <sup>{{ $parent->status === 0 ? 'Active' : 'Inactive' }}</sup></label>
          <select id="status" name="status" class="form-control"
            value="{{ $parent->status === 0 ? 'Active' : 'Inactive' }}">
            <option value="0" @if ($parent->status == 0) selected="selected" @endif>Active</option>
            <option value="1" @if ($parent->status == 1) selected="selected" @endif>Inactive</option>
          </select>
        </div>
        <div class="form-group col-sm-6">
          <label>Parent 1 First/Given Name <sup>*</sup></label>
          <input class="form-control" id="p1_first_name" value="{{ $parent->p1_first_name }}" name="p1_first_name">
        </div>
        <div class="form-group col-sm-6">
          <label>Parent 1 Middle Name</label>
          <input class="form-control" id="p1_middle_name" name="p1_middle_name" value="{{ $parent->p1_middle_name }}">
        </div>
        <div class="form-group col-sm-6">
          <label>Parent 1 Last/Family Name <sup>*</sup></label>
          <input class="form-control" id="p1_last_name" name="p1_last_name" value="{{ $parent->p1_last_name }}">
        </div>
        <div class="form-group col-sm-6">

          <label>Parent 1 Email<sup>*</sup> </label>
          <input class="form-control" id="p1_email" name="p1_email" value="{{ $parent->p1_email }}" disabled>
        </div>
        <div class="form-group col-sm-6">
          <label>Parent 1 Cell Phone</label>
          <input class="form-control" name="p1_cell_phone" id="p1_cell_phone" value="{{ $parent->p1_cell_phone }}">
        </div>
        <div class="form-group col-sm-6">
          <label>Parent 1 Home Phone</label>
          <input class="form-control" id="p1_home_phone" name="p1_home_phone" value="{{ $parent->p1_home_phone }}">
        </div>
        <div class="form-group col-sm-6">
          <label>Parent 2 First/Given Name</label>
          <input class="form-control" id="p2_first_name" value="{{ $parent->p2_first_name }}" name="p2_first_name">
        </div>
        <div class="form-group col-sm-6">
          <label>Parent 2 Middle Name</label>
          <input class="form-control" id="p2_middle_name" name="p2_middle_name" value="{{ $parent->p2_middle_name }}">
        </div>
        <div class="form-group col-sm-6">
          <label>Parent 2 Email</label>
          <input class="form-control" id="p2_email" name="p2_email" value="{{ $parent->p2_email }}">
        </div>
        <div class="form-group col-sm-6">
          <label>Parent 2 Cell Phone</label>
          <input class="form-control" name="p2_cell_phone" id="p2_cell_phone" value="{{ $parent->p2_cell_phone }}">
        </div>
        <div class="form-group col-sm-6">
          <label>Parent 2 Home Phone</label>
          <input class="form-control" id="p2_home_phone" name="p2_home_phone" value="{{ $parent->p2_home_phone }}">
        </div>
        <div class="form-group col-sm-6">
          <label>Street Address<sup>*</sup></label>
          <input class="form-control" id="street_address" name="street_address" value="{{ $parent->street_address }}">
        </div>
        <div class="form-group col-sm-6">
          <label>City</label>
          <input class="form-control" id="city" name="city" value="{{ $parent->city }}">
        </div>
        <div class="form-group col-sm-6">
          <label>State<sup>*</sup></label>
          <input class="form-control" id="state" name="state" value="{{ $parent->state }}">
        </div>
        <div class="form-group col-sm-6">
          <label>Country<sup>*</sup></label>
          <input class="form-control" id="country" name="country" value="{{ $parent->country }}">
        </div>
        <div class="form-group col-sm-6">
          <label>Referred by</label>
          <input class="form-control" id="reference" name="reference" value="{{ $parent->reference }}">
        </div>
        <div class="form-group col-sm-6">
          <label>Immunization Status<sup>*</sup></label>
          <input class="form-control" id="immunized" name="immunized" value="{{ $parent->immunized }}">
        </div>
        <div class="form-group col-sm-12">
          <label>Students<sup>*</sup></label>
          <div class="container-fluid my-3">
            <div class="card">
              <div class="card-header p-0">
                <!-- START TABS DIV -->
                <div class="tabbable-responsive">
                  <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                          aria-controls="first" aria-selected="true">First Tab</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                          aria-controls="second" aria-selected="false">Second Tab</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
                          aria-controls="third" aria-selected="false">Third Tab</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab"
                          aria-controls="fourth" aria-selected="false">Fourth Tab</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="fifth-tab" data-toggle="tab" href="#fifth" role="tab"
                          aria-controls="fifth" aria-selected="false">Fifth Tab</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="sixth-tab" data-toggle="tab" href="#sixth" role="tab"
                          aria-controls="sixth" aria-selected="false">Sixth Tab</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                    <form action="">
                      <div class="container row">
                        <div class="form-group col-sm-6">
                          <label>First/Given Name <sup>*</sup></label>
                          <input class="form-control" id="first_name" name="first_name">
                        </div>
                        <input type='hidden' name="parent_id">
                        <div class="form-group col-sm-6">
                          <label>Middle Name</label>
                          <input class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Last/Family Name <sup>*</sup></label>
                          <input class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Date of Birth<sup>*</sup></label>
                          <div class="position-relative w-100"> <i class="fas fa-calendar-alt"
                              aria-hidden="true"></i><input class="form-control datepicker" id="dob" name="dob"
                              required></div>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Email Address</label>
                          <input class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Cell Phone<sup>*</sup></label>
                          <input class="form-control" id="cell_phone" name="cell_phone">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>National ID<sup>*</sup></label>
                          <input class="form-control" id="student_id" name="student_id">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Immunization Status<sup>*</sup></label>
                          <select class="form-control" name="immunized_status">
                            <option>Yes, records will come with school records.</option>
                            <option>Yes, I will provide records.</option>
                            <option>Yes, I plan to get immunizations soon.</option>
                            <option>No, for personal reasons.</option>
                            <option>No, for medical reasons.</option>
                            <option>No, for religious reasons.</option>
                          </select>
                        </div>
                        <div class="my-sm-4 my-3 px-3">
                          <button type="submit" class="btn btn-primary">Update</button>
                          <a type="button" href="#" class="btn btn-primary ml-3">Generate Confirmation</a>
                          <a href="#" class="btn btn-primary">Back</a>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                    <form action="">
                      <div class="container row">
                        <div class="form-group col-sm-6">
                          <label>First/Given Name <sup>*</sup></label>
                          <input class="form-control" id="first_name" name="first_name">
                        </div>
                        <input type='hidden' name="parent_id">
                        <div class="form-group col-sm-6">
                          <label>Middle Name</label>
                          <input class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Last/Family Name <sup>*</sup></label>
                          <input class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Date of Birth<sup>*</sup></label>
                          <div class="position-relative w-100"> <i class="fas fa-calendar-alt"
                              aria-hidden="true"></i><input class="form-control datepicker" id="dob" name="dob"
                              required></div>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Email Address</label>
                          <input class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Cell Phone<sup>*</sup></label>
                          <input class="form-control" id="cell_phone" name="cell_phone">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>National ID<sup>*</sup></label>
                          <input class="form-control" id="student_id" name="student_id">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Immunization Status<sup>*</sup></label>
                          <select class="form-control" name="immunized_status">
                            <option>Yes, records will come with school records.</option>
                            <option>Yes, I will provide records.</option>
                            <option>Yes, I plan to get immunizations soon.</option>
                            <option>No, for personal reasons.</option>
                            <option>No, for medical reasons.</option>
                            <option>No, for religious reasons.</option>
                          </select>
                        </div>
                        <div class="my-sm-4 my-3 px-3">
                          <button type="submit" class="btn btn-primary">Update</button>
                          <a type="button" href="#" class="btn btn-primary ml-3">Generate Confirmation</a>
                          <a href="#" class="btn btn-primary">Back</a>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                    <form action="">
                      <div class="container row">
                        <div class="form-group col-sm-6">
                          <label>First/Given Name <sup>*</sup></label>
                          <input class="form-control" id="first_name" name="first_name">
                        </div>
                        <input type='hidden' name="parent_id">
                        <div class="form-group col-sm-6">
                          <label>Middle Name</label>
                          <input class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Last/Family Name <sup>*</sup></label>
                          <input class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Date of Birth<sup>*</sup></label>
                          <div class="position-relative w-100"> <i class="fas fa-calendar-alt"
                              aria-hidden="true"></i><input class="form-control datepicker" id="dob" name="dob"
                              required></div>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Email Address</label>
                          <input class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Cell Phone<sup>*</sup></label>
                          <input class="form-control" id="cell_phone" name="cell_phone">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>National ID<sup>*</sup></label>
                          <input class="form-control" id="student_id" name="student_id">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Immunization Status<sup>*</sup></label>
                          <select class="form-control" name="immunized_status">
                            <option>Yes, records will come with school records.</option>
                            <option>Yes, I will provide records.</option>
                            <option>Yes, I plan to get immunizations soon.</option>
                            <option>No, for personal reasons.</option>
                            <option>No, for medical reasons.</option>
                            <option>No, for religious reasons.</option>
                          </select>
                        </div>
                        <div class="my-sm-4 my-3 px-3">
                          <button type="submit" class="btn btn-primary">Update</button>
                          <a type="button" href="#" class="btn btn-primary ml-3">Generate Confirmation</a>
                          <a href="#" class="btn btn-primary">Back</a>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
                    <form action="">
                      <div class="container row">
                        <div class="form-group col-sm-6">
                          <label>First/Given Name <sup>*</sup></label>
                          <input class="form-control" id="first_name" name="first_name">
                        </div>
                        <input type='hidden' name="parent_id">
                        <div class="form-group col-sm-6">
                          <label>Middle Name</label>
                          <input class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Last/Family Name <sup>*</sup></label>
                          <input class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Date of Birth<sup>*</sup></label>
                          <div class="position-relative w-100"> <i class="fas fa-calendar-alt"
                              aria-hidden="true"></i><input class="form-control datepicker" id="dob" name="dob"
                              required></div>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Email Address</label>
                          <input class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Cell Phone<sup>*</sup></label>
                          <input class="form-control" id="cell_phone" name="cell_phone">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>National ID<sup>*</sup></label>
                          <input class="form-control" id="student_id" name="student_id">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Immunization Status<sup>*</sup></label>
                          <select class="form-control" name="immunized_status">
                            <option>Yes, records will come with school records.</option>
                            <option>Yes, I will provide records.</option>
                            <option>Yes, I plan to get immunizations soon.</option>
                            <option>No, for personal reasons.</option>
                            <option>No, for medical reasons.</option>
                            <option>No, for religious reasons.</option>
                          </select>
                        </div>
                        <div class="my-sm-4 my-3 px-3">
                          <button type="submit" class="btn btn-primary">Update</button>
                          <a type="button" href="#" class="btn btn-primary ml-3">Generate Confirmation</a>
                          <a href="#" class="btn btn-primary">Back</a>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="fifth" role="tabpanel" aria-labelledby="fifth-tab">
                    <form action="">
                      <div class="container row">
                        <div class="form-group col-sm-6">
                          <label>First/Given Name <sup>*</sup></label>
                          <input class="form-control" id="first_name" name="first_name">
                        </div>
                        <input type='hidden' name="parent_id">
                        <div class="form-group col-sm-6">
                          <label>Middle Name</label>
                          <input class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Last/Family Name <sup>*</sup></label>
                          <input class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Date of Birth<sup>*</sup></label>
                          <div class="position-relative w-100"> <i class="fas fa-calendar-alt"
                              aria-hidden="true"></i><input class="form-control datepicker" id="dob" name="dob"
                              required></div>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Email Address</label>
                          <input class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Cell Phone<sup>*</sup></label>
                          <input class="form-control" id="cell_phone" name="cell_phone">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>National ID<sup>*</sup></label>
                          <input class="form-control" id="student_id" name="student_id">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Immunization Status<sup>*</sup></label>
                          <select class="form-control" name="immunized_status">
                            <option>Yes, records will come with school records.</option>
                            <option>Yes, I will provide records.</option>
                            <option>Yes, I plan to get immunizations soon.</option>
                            <option>No, for personal reasons.</option>
                            <option>No, for medical reasons.</option>
                            <option>No, for religious reasons.</option>
                          </select>
                        </div>
                        <div class="my-sm-4 my-3 px-3">
                          <button type="submit" class="btn btn-primary">Update</button>
                          <a type="button" href="#" class="btn btn-primary ml-3">Generate Confirmation</a>
                          <a href="#" class="btn btn-primary">Back</a>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="sixth" role="tabpanel" aria-labelledby="sixth-tab">
                    <form action="">
                      <div class="container row">
                        <div class="form-group col-sm-6">
                          <label>First/Given Name <sup>*</sup></label>
                          <input class="form-control" id="first_name" name="first_name">
                        </div>
                        <input type='hidden' name="parent_id">
                        <div class="form-group col-sm-6">
                          <label>Middle Name</label>
                          <input class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Last/Family Name <sup>*</sup></label>
                          <input class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Date of Birth<sup>*</sup></label>
                          <div class="position-relative w-100"> <i class="fas fa-calendar-alt"
                              aria-hidden="true"></i><input class="form-control datepicker" id="dob" name="dob"
                              required></div>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Email Address</label>
                          <input class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Cell Phone<sup>*</sup></label>
                          <input class="form-control" id="cell_phone" name="cell_phone">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>National ID<sup>*</sup></label>
                          <input class="form-control" id="student_id" name="student_id">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Immunization Status<sup>*</sup></label>
                          <select class="form-control" name="immunized_status">
                            <option>Yes, records will come with school records.</option>
                            <option>Yes, I will provide records.</option>
                            <option>Yes, I plan to get immunizations soon.</option>
                            <option>No, for personal reasons.</option>
                            <option>No, for medical reasons.</option>
                            <option>No, for religious reasons.</option>
                          </select>
                        </div>
                        <div class="my-sm-4 my-3 px-3">
                          <button type="submit" class="btn btn-primary">Update</button>
                          <a type="button" href="#" class="btn btn-primary ml-3">Generate Confirmation</a>
                          <a href="#" class="btn btn-primary">Back</a>
                        </div>

                      </div>
                    </form>

                  </div>

                  <!-- END TABS DIV -->

                </div>
              </div>
            </div>
            @if($allstudent)
            @foreach ($allstudent as $student)
            <a href="{{ route('admin.edit-student',$student->id)}}">{{ $student->fullname }},</a>
            @endforeach
            @endif
          </div>
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.view.parent')}}" class="btn btn-primary">Back</a>
          </div>
      </form>

    </div>
  </div><!-- /.container-fluid -->

</section>

@endsection
