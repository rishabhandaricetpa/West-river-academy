<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.partials.header')

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

        <!-- * =============== NavBar =============== * -->
  @include('admin.layouts.partials.navbar')
  <!-- * =============== /Navbar =============== * -->
    <!-- * =============== Sidebar =============== * -->
  @include('admin.layouts.partials.sidebar')
  <!-- * =============== /Sidebar =============== * -->


    <!-- * =============== Main =============== * -->
      <div class="form-wrap border bg-light py-5 px-25">
        <h2>Edit Student Information</h2>
        <form method="POST" action="{{route('admin.edit-student.update',$data->id)}}">
          @csrf
          <div class="form-group d-flex mb-2">
            <label for="">First/Given Name <sup>*</sup></label>
            <div>
              <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{$data->first_name}}" name="first_name" required aria-describedby="emailHelp">
            </div>
          </div>
          <div class="form-group d-flex mb-2">
            <label for="">Middle Name </label>
            <div>
              <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{$data->middle_name}}" aria-describedby="emailHelp">
            </div>
          </div>
          <div class="form-group d-flex mb-2">
            <label for="">Last/Family Name <sup>*</sup></label>
            <div>
              <input type="text" class="form-control" id="last_name" name="last_name" value="{{$data->last_name}}" required aria-describedby="emailHelp">
            </div>
          </div>
          <div class="form-group d-flex mb-2">
            <label for="">Date of Birth</label>
            <p><input type="text" class="form-control dobdatepicker" id="dob" name="dob" value="{{$data->d_o_b}}"></p>
            <i class="fas fa-calendar-alt" aria-hidden="true"></i>
          </div>
          <div class="form-group d-flex mb-2">
            <label for="">Email Address</label>
            <div>
              <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{$data->email}}" required aria-describedby="emailHelp">
             </div>
          </div>
          <div class="form-group d-flex mb-2">
            <label for="">Cell Phone</label>
            <div>
              <input type="text" class="form-control" id="cell_phone" name="cell_phone" value="{{$data->cell_phone}}" aria-describedby="emailHelp">
            </div>
          </div>
          <div class="form-group d-flex mb-2">
            <label for="">Student ID</label>
            <div>
              <input type="text" class="form-control" id="student_id" name="student_id"  value="{{$data->student_Id}}" required aria-describedby="emailHelp">
            </div>
          </div>
        
          <div class="form-group d-flex mt-2r">
            <label for="">Is this student immunized?</label>
            <div class="col-sm-6">
              <select class="form-control" name="immunized_Stat" value="{{$data->immunized_status}}">
                <option>Yes, records will come with school records.</option>
                <option>Yes, I will provide records.</option>
                <option>Yes, I plan to get immunizations soon.</option>
                <option>No, for personal reasons.</option>
                <option>No, for medical reasons.</option>
                <option>No, for religious reasons.</option>
              </select>
            </div>
          </div>
      </div>
      <div class="form-wrap border bg-light py-2r px-25 mt-2r">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    <!-- Choose Dates -->
   
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
  </div>

</div>