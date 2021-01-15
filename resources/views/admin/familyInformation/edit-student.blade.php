@extends('admin.app')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Student Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('admin.edit-student.update',$student->id)}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>First/Given Name <sup>*</sup></label>
                    <input  class="form-control" id="first_name" value="{{$student->first_name}}" name="first_name">
                  </div>
                  <div class="form-group">
                    <label>Middle Name</label>
                    <input  class="form-control" id="middle_name" name="middle_name" value="{{$student->middle_name}}">
                  </div>
                  <div class="form-group">
                    <label>Last/Family Name <sup>*</sup></label>
                    <input  class="form-control" id="last_name" name="last_name" value="{{$student->last_name}}">
                  </div>
                  <div class="form-group">
                    <label>Date of Birth<sup>*</sup>  <i class="fas fa-calendar-alt" aria-hidden="true"></i></label>
                    <input  class="form-control" id="dob" name="dob" value="{{$student->d_o_b->format('d M')}}" >
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input  class="form-control" name="email" id="email" value="{{$student->email}}">
                  </div>
                  <div class="form-group">
                    <label>Cell Phone<sup>*</sup></label>
                    <input  class="form-control"  id="cell_phone" name="cell_phone" value="{{$student->cell_phone}}">
                  </div>
                  <div class="form-group">
                    <label>Student ID<sup>*</sup></label>
                    <input  class="form-control"  id="student_id" name="student_id"  value="{{$student->student_Id}}">
                  </div>
                  <div class="form-group">
                    <label>Student ID<sup>*</sup></label>
                    <select class="form-control" name="immunized_status" value="{{$student->immunized_status}}">
                      <option>Yes, records will come with school records.</option>
                      <option>Yes, I will provide records.</option>
                      <option>Yes, I plan to get immunizations soon.</option>
                      <option>No, for personal reasons.</option>
                      <option>No, for medical reasons.</option>
                      <option>No, for religious reasons.</option>
                </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>

@endsection


