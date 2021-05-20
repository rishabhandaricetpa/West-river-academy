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
          <label>Family Name <sup>*</sup></label>
          <input class="form-control" id="p1_first_name" value="{{ $parent->p1_last_name }} & {{ $parent->p2_last_name }} Family" name="p1_first_name" disabled>
        </div>
        <div class="form-group col-sm-6">
          <label>User Status<sup>*</sup> <sup>{{ $parent->status === 0 ? 'Active' : 'Inactive' }}</sup></label>
          <select id="status" name="status" class="form-control"
            value="{{ $parent->status === 0 ? 'Active' : 'Inactive' }}">
            <option value="0" @if ($parent->status == 0) selected="selected" @endif>Active</option>
            <option value="1" @if ($parent->status == 1) selected="selected" @endif>Inactive</option>
          </select>
        </div>
        <div class="container-fluid my-3">
            <div class="card">
              <div class="card-header p-0">
                <!-- START TABS DIV -->
                <div class="tabbable-responsive">
                  <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="parent1" data-toggle="tab" href="#first" role="tab"
                          aria-controls="first" aria-selected="true">Parent 1</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="parent2" data-toggle="tab" href="#sixth" role="tab"
                          aria-controls="sixth" aria-selected="false">Parent 2 </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="login" data-toggle="tab" href="#sixth" role="tab"
                          aria-controls="sixth" aria-selected="false">Log In</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="parent1">
                                      <div class="form-group col-sm-6">
                              <label>Parent 1 First/Given Name <sup>*</sup></label>
                              <input class="form-control" id="p1_first_name" value="{{ $parent->p1_first_name }}" name="p1_first_name" >
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
                  </div>
                  <div class="tab-pane fade" id="sixth" role="tabpanel" aria-labelledby="parent2">
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
                  </div>

                </div>
              </div>
            </div>
            <div class="container-fluid my-3">
            <div class="card">
              <div class="card-header p-0">
                <!-- START TABS DIV -->
                <div class="tabbable-responsive">
                  <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="parent1" data-toggle="tab" href="#first" role="tab"
                          aria-controls="first" aria-selected="true">Address</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="parent1">
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
                  </div>
                </div>
              </div>
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
                        <a class="nav-link active" id="student-tab" data-toggle="tab" href="#first" role="tab"
                          aria-controls="first" aria-selected="true">Students</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="student-tab">
                  @foreach($allstudent as $key=>$student)
                      <div class="d-flex align-items-center pt-4">
                        <a href="{{ route('admin.edit-student',$student->id)}}" class="btn btn-primary ml-auto">View Student Details</a>
                      </div>
                      <div class="seperator">
                        <div class="form-group d-sm-flex mb-2">
                          <label for="">Student Name</label>
                          <div>
                            <p>{{$student ->first_name}} {{$student ->last_name}}</p>
                          </div>
                        </div>
                        <div class="form-group d-sm-flex mb-2">
                          <label for="">Date of Birth</label>
                          <div>
                            <p>{{$student ->d_o_b->format('M j, Y' )}}</p>
                          </div>
                        </div>
                        <div class="form-group d-sm-flex mb-2">
                          <label for="">Email Address</label>
                          <div>
                            <p>{{$student ->email}}</p>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </form>
                  </div>
                  <!-- END TABS DIV -->
                </div>
              </div>
            </div>
          </div>

          <div class="container-fluid my-3">
            <div class="card">
              <div class="card-header p-0">
                <!-- START TABS DIV -->
                <div class="tabbable-responsive">
                  <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="parent1" data-toggle="tab" href="#first" role="tab"
                          aria-controls="first" aria-selected="true">Activity</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="parent2" data-toggle="tab" href="#sixth" role="tab"
                          aria-controls="sixth" aria-selected="false">Document</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="login" data-toggle="tab" href="#sixth" role="tab"
                          aria-controls="sixth" aria-selected="false">orders</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="parent1">
                                      <div class="form-group col-sm-6">
                              <label>Parent 1 First/Given Name <sup>*</sup></label>
                              <input class="form-control" id="p1_first_name" value="{{ $parent->p1_first_name }}" name="p1_first_name" >
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
                  </div>
                  <div class="tab-pane fade" id="sixth" role="tabpanel" aria-labelledby="parent2">
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
                  </div>

                </div>
              </div>
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
