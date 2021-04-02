
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

  <main class="position-relative container form-content mt-4">
          <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
             <form method="POST" class="mb-0 px-0 unstyled-label">
               <div class="col-lg-9 px-0">
                  <div class="form-group row  align-items-center">
                    <label for="" class="h3 text-black mb-0 col-md-4">What is the full name of the college?</label>
                      <div class="w-100 col-md-8">
                        <input type="text" class="form-control" name="" value="" aria-describedby="">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex row  align-items-center">
                    <label for="" class="h3 text-black mb-0 col-md-4">Name of the Course (name must match exactly the college transcript)</label>
                      <div class="w-100 col-md-8">
                        <input type="text" class="form-control" name="" value="" aria-describedby="">
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="d-sm-flex mt-4 mb-3">
                      <h3>What grade were you in when you took the course?</h3>
                    </div>
                  <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="" value="option1">
                        <label class="form-check-label" for="">9</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="" value="option2">
                        <label class="form-check-label" for="">10</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="" value="option2">
                        <label class="form-check-label" for="">11</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="" value="option2">
                        <label class="form-check-label" for="">12</label>
                    </div>
                 
                    <div class="d-sm-flex mt-4 align-items-center">
                      <h3>Was it a college level course?</h3>
                      <a href="#" class="btn btn-primary ml-4" data-toggle="modal" data-target="#GradeHelp">Help me Decide</a>
                    </div>
                    <div class="form-group mb-1">
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="" value="option2">
                        <label class="form-check-label" for="">A</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="" value="option2">
                        <label class="form-check-label" for="">B</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="" value="option2">
                        <label class="form-check-label" for="">C</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="" value="option2">
                        <label class="form-check-label" for="">D</label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="" value="option2">
                        <label class="form-check-label" for="">F</label>
                    </div>
                    </div>
                    <div class="info-detail lato-italic mt-4">
                      <h3>Select Credit: The recommended credit for a one-year course is selected. You may change it.</h3>
                      <p>A one-semester college level course is equivalent to a one-year high school course.</p>
<p>If your college transcript shows 3 or more credits, select 1 credit; otherwise, select 0.50 or 0.25 credit.</p>
<div class="col-sm-2 px-0 mt-3">
      <select name="immunized_status" class="form-control">
            <option>1.0</option> 
            <option>1.1</option> 
            <option>1.2</option>
            <option>1.3</option>
              <option>1.4</option> 
              <option>1.5</option>
        </select></div>
                    </div>
                  </div>
                  <div class="mt-2r">
                    <a href="#" class="btn btn-primary">Add another English/Language Arts Course</a>
                    <a href="select-elective" class="btn btn-primary ml-4 float-right">Continue</a>
                  </div> 
                </div>
            </form>
             </div>
           
             
  </main>
  <!-- Choose Dates -->
  <div class="modal fade" id="GradeHelp" tabindex="-1" aria-labelledby="GradeHelpLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
       <p>Yes means the course would appear in the list of AP courses here:
https://apstudents.collegeboard.org/course-index-page</p>
<p>It will receive an extra grade point. If you took elective courses which have no AP equivalent, you should select NO.</p>
      <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></div>  
      </div>
    </div>
  </div>
</div>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>