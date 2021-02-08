
<div class="d-flex">
<!-- * =============== Sidebar =============== * -->
@include('layouts.partials.sidebar')
  <!-- * =============== /Sidebar =============== * -->

     <div class="main-content position-relative ml-auto">
     <title> @yield('pageTitle', 'Enroll Students') | {{config('app.name')}}</title>
<!-- <sup>*</sup> =============== Header =============== <sup>*</sup> -->
@include('layouts.partials.header')
<!-- <sup>*</sup> =============== /Header =============== <sup>*</sup> -->

<!-- * =============== Main =============== * -->

  <main class="position-relative container form-content mt-4 label-styling label-md">
       <h1 class="text-center text-white text-uppercase">enroll students</h1>
          <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
             <h3 class="mb-3">Select the year for this grade. It must be a year that you were either enrolled in West River Academy or you have provided a transcript from another school.</h3>
             <form method="POST" class="mb-0" action="">
                @csrf
        <div class="form-group mb-2 lato-italic info-detail pb-4">
           <div class="row ">
            <div class="col-sm-2">
                      <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="student_grade" value="Upgraded">
                      <label class="form-check-label" for="">
                        2016-2017
                      </label>
                      </div>
                      <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 3">
                      <label class="form-check-label" for="">
                        2017-2018
                      </label>
                      </div>
                      <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 4">
                      <label class="form-check-label" for="">
                       2018-2019
                      </label>
                      </div>
                      <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="student_grade"  value="1">
                      <label class="form-check-label" for="">
                        2019-2020
                      </label>
                      </div>
                </div>
                 <div class="col-sm-4">
                      <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="student_grade"  value="2">
                      <label class="form-check-label" for="">
                        2020-2021
                      </label>
                      </div>
                      <div class="form-check d-sm-flex mb-2">
                      <input class="form-check-input" type="radio" name="student_grade"  value="2">
                       <label class="w-auto" for="">Other</label>
                        <div>
                          <input id="" type="text" class="form-control " name="" required="" autocomplete="new-password" aria-autocomplete="list">
                      </div>
                </div>
                    </div>
                  </div>
        </div>
        <div class="text-center mt-5">
            <a href="year-grade1" class="btn btn-primary">Continue</a>
        </div>
  </form>
  </main>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>