
<div class="d-flex">
<!-- * =============== Sidebar =============== * -->
<sidebar class="main-sidebar bg-secondary pt-5 fixed-top overflow-auto">
    <ul class="list-unstyled">
    <li>
    <a href="#">Dashboard</a>
      <ul class="list-unstyled">
        <li><a href="#">Add student</a></li>
        <li><a href="#">add enrollment</a></li>
      </ul>
    </li>
    <li><a href="#">Cart</a></li>
    <li><a href="#">Fee structure</a></li>
    <li><a href="#">Tutorials</a></li>
    <li><a href="#">My Account</a></li>
    <li><a href="#">Logout</a></li>
    </ul>
 </sidebar>
  <!-- * =============== /Sidebar =============== * -->

     <div class="main-content position-relative ml-auto">
     <title> @yield('pageTitle', 'Enroll Students') | {{config('app.name')}}</title>
<!-- <sup>*</sup> =============== Header =============== <sup>*</sup> -->
@include('layouts.partials.header')
<!-- <sup>*</sup> =============== /Header =============== <sup>*</sup> -->

<!-- * =============== Main =============== * -->

  <main class="position-relative container form-content mt-4">
       <h1 class="text-center text-white text-uppercase">enroll students</h1>

          <div class="form-wrap border bg-light py-5 px-25">
             <h2>Enroll Student 1</h2>
             <form method="POST" action="{{ route('enroll') }}">
                @csrf
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">First/Given Name <sup>*</sup></label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Middle Name </label>
                      <div>
                          <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Last/Family Name <sup>*</sup></label>
                      <div>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Date of Birth</label>
                    <p><input type="text" class="form-control dobdatepicker" id="dob" name="dob"  name="fromdate"></p>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Email Address</label>
                      <div>
                        <input type="text" class="form-control @error('email') is-invalid @enderror"  name="email" id="email" value="{{ old('email') }}" required aria-describedby="emailHelp">
                        @error('email')
                          <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </div>
                        @enderror
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Cell Phone</label>
                      <div>
                        <input type="text" class="form-control" id="cell_phone" name="cell_phone" value="{{ old('cell_phone') }}" aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Student ID</label>
                      <div>
                        <input type="text" class="form-control" id="student_id" name="student_id" required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2 mt-2r">
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

              <div class="form-group d-sm-flex mb-2 mt-2r">
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
                 <!-- Button trigger modal -->
                 <a href="#chooseDates" data-toggle="modal">help me choose my dates</a> 
                 <a href="#skipYear" data-toggle="modal" class="ml-4">what if i need to skip a year?</a>
              </div>
        <div class="form-group d-sm-flex mb-2 lato-italic info-detail">
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
                      <div class="form-check" data-toggle="modal" data-target="#chooseGrade">
                      <input class="form-check-input" type="radio" name="student_grade" id="" value="10">
                      <label class="form-check-label" for="">
                        10
                      </label>
                      </div>
                      <div class="form-check" data-toggle="modal" data-target="#chooseGrade">
                      <input class="form-check-input" type="radio" name="student_grade" id="" value="11">
                      <label class="form-check-label" for="">
                        11
                      </label>
                      </div>
                      <div class="form-check" data-toggle="modal" data-target="#chooseGrade">
                      <input class="form-check-input" type="radio" name="student_grade" id="" value="12">
                      <label class="form-check-label" for="">
                        12
                      </label>
                      </div>
                    </div>
                  </div>
              </div>
      <div class="form-group d-sm-flex mt-2r">
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
        <div class="form-group d-sm-flex" >
        <label for="">tell us more about your situation </label>
        <div>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="student_situation" rows="3"></textarea>
        </div>
        </div>
        </div>
     <div class="form-wrap border bg-light py-2r px-25 mt-2r collapse" id="enrollmentPeriode">
      <h3 class="mb-5">Add Another Enrollment Period</h3>
      <div class="form-group d-sm-flex mb-2 mt-2r">
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
      <div class="form-group d-sm-flex mb-2 mt-2r">
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

<div class="form-group d-sm-flex mb-2 lato-italic info-detail mt-2r">
        <label for="">Select grade level(s) for your enrollment period
       <p>(You may select more than one for multiple years)</p></label>
        <div class="row pl-5">
          <div class="col-sm-3">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              Upgraded
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              Preschool Age 3
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              Preschool Age 4
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
            Kindergarten
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              1
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              2
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              3
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              4
            </label>
            </div>
             </div>
             <div class="col-sm-3">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              5
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              6
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              7
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              8
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              9
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              10
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              11
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="" value="">
            <label class="form-check-label" for="">
              12
            </label>
            </div>
          </div>
      </div>
      </div>
    </div>
    <div class="form-wrap border bg-light py-2r px-25 mt-2r">
        <a  href="#enrollmentPeriode" aria-expanded="false" aria-controls="enrollmentPeriode" data-toggle="collapse" class="btn btn-primary collapsed">Add Another Enrollment Period</a>
        <button type="submit" class="btn btn-primary">Continue</button>
  </div>
  </form>
  </main>
  <!-- Choose Dates -->
<div class="modal fade" id="chooseDates" tabindex="-1" aria-labelledby="chooseDatesLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
        <p>Annual enrollment covers the 12 months from August 1 - July 31. Second Semester Only covers January 1 - July 31. If you prefer to start your enrollment on the date you enroll, select that date. If you want your enrollment to date back to August 1, even though it is now later in the year, you can do so.</p>
        <p>The dates you select will appear on your confirmation of enrollment letter. Regardless of the date you select, your enrollment will include the full 12-month period for Annual or the full 7-month period for Second Semester Only.</p>
      <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></div>  
      </div>
    </div>
  </div>
</div>
<!-- Skip Year -->
<div class="modal fade" id="skipYear" tabindex="-1" aria-labelledby="skipYearLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
      <p>If you need to enroll for 2 periods that are not consecutive, complete the first enrollment period and then click on Add Another Enrollment Period at the bottom of this form.
      </p>
      <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></div>  
      </div>
    </div>
  </div>
</div>
<!-- Choose more grade -->
<div class="modal fade" id="chooseGrade" tabindex="-1" aria-labelledby="chooseGradeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
      <h3 class="text-center mb-4">For NEW high school students grades 10, 11 and 12</h3>
      <p>
      If you are newly enrolling in West River Academy for grades 10, 11 or 12, you will need to provide transcripts issued from a public or private school for your previous high school years in order for us to issue a complete high school transcript if you transfer out of West River Academy or when you graduate. If transcripts cannot be provided, you will need to enroll with us for those years. Please indicate that you understand this policy by checking the box below:
      </p>
      <div class="form-check">
         <input class="form-check-input" type="radio" name="student_grade" id="" value="10">
         <label class="form-check-label w-100" for="">
          I understand that by enrolling in West River Academy for grade 10, 11 or 12, I agree to provide transcripts from a previous school or to enroll in West River Academy for previous years before enrolling in the Graduation Program or requesting a high school transcript to transfer out of West River Academy to another school.
          </label>
          </div>
      <div class="text-right mt-3">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary ml-3" data-dismiss="modal">Save</button>
      </div>  
      </div>
    </div>
  </div>
</div>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>


