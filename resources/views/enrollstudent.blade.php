
<title> @yield('pageTitle', 'Enroll Students') | {{config('app.name')}}</title>
<!-- <sup>*</sup> =============== Header =============== <sup>*</sup> -->
@include('layouts.partials.header')

 <!-- * =============== Sidebar =============== * -->
 <sidebar class="main-sidebar bg-secondary">
 </sidebar>  
     <!-- * =============== Main =============== * -->
  <main class="position-relative container form-content mt-4">
       <h1 class="text-center text-white text-uppercase">enroll students</h1>

  <div class="form-wrap border bg-light py-5 px-25">
  <form method="POST" action="{{ route('enroll') }}">
  @csrf
      <div>
      <h2>Enroll Student 1</h2>
      <form>
      <div class="form-group d-flex mb-1">
        <label for="">First/Given Name <sup>*</sup></label>
        <div>
        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Middle Name </label>
        <div>
            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Last/Family Name <sup>*</sup></label>
        <div>
        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Date of Birth</label>
        <div>
        <div class="form-row col-sm-3 px-0">
    <div class="form-group col-md-5">
      <select id="" class="form-control">
           
      </select>
    </div>
    <div class="form-group col-md-3">
      <select id="" class="form-control" name="d_o_B">
        <option selected>-...</option>
              <option value=''>--Select Month--</option>
          <option selected value='1'>Janaury</option>
          <option value='2'>February</option>
          <option value='3'>March</option>
          <option value='4'>April</option>
          <option value='5'>May</option>
          <option value='6'>June</option>
          <option value='7'>July</option>
          <option value='8'>August</option>
          <option value='9'>September</option>
          <option value='10'>October</option>
          <option value='11'>November</option>
          <option value='12'>December</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <select id="" class="form-control">
        <option selected>-...</option>
        <option>...</option>
      </select>
    </div>
  </div>
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Email Address</label>
        <div>
        <input type="text" class="form-control @error('email') is-invalid @enderro"  name="email" id="email" value="{{ old('email') }}" required aria-describedby="emailHelp">
        @error('email')
            <div class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </div>
            @enderror
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Cell Phone</label>
        <div>
        <input type="text" class="form-control" id="cell_phone" name="cell_phone" value="{{ old('cell_phone') }}" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Student ID</label>
        <div>
        <input type="text" class="form-control" id="student_id" name="student_id" required aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1 mt-2r">
        <label for="">Select your START date of enrollment</label>
        <div class="row mx-0">
        <div class="form-row col-sm-3 px-0">
    <div class="form-group col-md-5">
      <select id="" class="form-control">
        <option selected>August</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <select id="" class="form-control">
        <option selected>1</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <select id="" class="form-control">
        <option selected>2020</option>
        <option>...</option>
      </select>
    </div>
  </div>
  <div class="info-detail col-sm-9 lato-italic">
            <p>Choose August 1 (the first day of the Annual enrollment period), January 1 (the first day of the Second Semester), today's date or another date. This date will appear on your confirmation of enrollment letter. You will be considered enrolled for the full 12-month period for Annual or 7-month period for Second Semester Only.</p>
       </div>
      </div>      
      </div>
      <div class="form-group d-flex mb-1 mt-2r">
        <label for="">Select your END date of enrollment</label>
        <div class="row mx-0">
        <div class="form-row col-sm-3 px-0">
    <div class="form-group col-md-5">
      <select id="" class="form-control">
        <option selected>July</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <select id="" class="form-control">
        <option selected>31</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <select id="" class="form-control">
        <option selected>2021</option>
        <option>...</option>
      </select>
    </div>
  </div>
  <div class="info-detail col-sm-9 lato-italic">
            <p>Choose before July 31 (the last day of your enrollment) or another date before July 31. This date will appear on your confirmation of enrollment letter. Your enrollment will officially end on July 31.</p>
       </div>
      </div>
</div>
 <div class="form-group mt-2r d-flex links-list mb-5">
         <a href="#" class="text-uppercase">help me choose my dates</a>
         <a href="#" class="text-uppercase ml-4">what if i need to skip a year?</a>
      </div>
<div class="form-group d-flex mb-1 lato-italic info-detail">
        <label for="">Select grade level(s) for your enrollment period
       <p>(You may select more than one for multiple years)</p></label>
        <div class="row pl-5">
          <div class="col-sm-3">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="Upgraded">
            <label class="form-check-label" for="">
              Upgraded
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="Preschool Age 3">
            <label class="form-check-label" for="">
              Preschool Age 3
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="Preschool Age 4">
            <label class="form-check-label" for="">
              Preschool Age 4
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="Kindergarten">
            <label class="form-check-label" for="">
            Kindergarten
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="1">
            <label class="form-check-label" for="">
              1
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="2">
            <label class="form-check-label" for="">
              2
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="3">
            <label class="form-check-label" for="">
              3
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="4">
            <label class="form-check-label" for="">
              4
            </label>
            </div>
             </div>
             <div class="col-sm-3">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="5">
            <label class="form-check-label" for="">
              5
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="6">
            <label class="form-check-label" for="">
              6
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="7">
            <label class="form-check-label" for="">
              7
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="8">
            <label class="form-check-label" for="">
              8
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="9">
            <label class="form-check-label" for="">
              9
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="10">
            <label class="form-check-label" for="">
              10
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="11">
            <label class="form-check-label" for="">
              11
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="student_grade" id="" value="12">
            <label class="form-check-label" for="">
              12
            </label>
            </div>
          </div>

      </div>
      
      </div>
      <div class="form-group d-flex mt-2r">
        <label for="">Is this student immunized?</label>
        <div class="col-sm-6">
        <select class="form-control" name="immunized_Stat">
          <option>Yes, records will come with school records.</option>
          <option>Yes, I will provide records.</option>
          <option>Yes, I plan to get immunizations soon.</option>
          <option>No, for personal reasons.</option>
          <option>No, for medical reasons.</option>
          <option>No, for religious reasons.</option>
        </select>
      </div>
      </div>
      <div class="form-group d-flex" >
        <label for="">tell us more about your situation </label>
        <div>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="student_situation" rows="3"></textarea>
      </div>
      </div>
     </div>
      <div class="mt-4">
        <a  class="btn btn-primary" data-toggle="collapse" href="#addAnotherEnroll" aria-expanded="false" aria-controls="addAnotherEnroll">Add Another Enrollment Period</a>
        <button type="submit" class="btn btn-primary">Continue</button>
      </div>
    </form>
    
  </main>

    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')

</body>
</html>


