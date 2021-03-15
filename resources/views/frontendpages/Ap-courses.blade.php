<div class="d-flex">
  <!-- * =============== Sidebar =============== * -->
  @include('layouts.partials.sidebar')
  <!-- * =============== /Sidebar =============== * -->

  <div class="main-content position-relative ml-auto">
    <title> @yield('pageTitle', 'Another AP Course') | {{config('app.name')}}</title>
    <!-- <sup>*</sup> =============== Header =============== <sup>*</sup> -->
    @include('layouts.partials.header')
    <!-- <sup>*</sup> =============== /Header =============== <sup>*</sup> -->

    <!-- * =============== Main =============== * -->

    <main class="position-relative container form-content mt-4">
      <h1 class="text-center text-white text-uppercase">enroll students</h1>
      <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
        <div class="d-flex">
          <h3 class="mb-3">Did you take any AP courses and pass the AP Test?</h3>
          <a href="#HelpmeDecide" data-toggle="modal" role="button" class="btn btn-primary ml-auto">Help me decide</a>
        </div>
        <div>
          <a data-toggle="collapse" href="#ap-courses" role="button" aria-expanded="false" aria-controls="ap-courses" class="btn btn-primary px-2r py-1">yes</a>
          <a href="#" role="button" class="btn btn-primary px-2r py-1 ml-4">no</a>
        </div>
        <form method="POST" class="mb-0 px-0 mt-2r unstyled-label collapse" id="ap-courses">
          <div class="col-sm-7 px-0">
            <div class="form-group d-sm-flex  align-items-center">
              <label for="" class="h3 text-black mb-0">AP Course Name</label>
              <div class="w-75">
                <input type="text" class="form-control" id="" name="" value="" aria-describedby="">
              </div>
            </div>
            <div class="form-group mb-2 mt-2r">
              <label for="" class="h3 text-black mb-3">What grade did you receive?</label>
              <div class="d-sm-flex">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="" id="" value="option1">
                  <label class="form-check-label" for="">A</label>
                </div>
                <div class="form-check ml-5">
                  <input class="form-check-input" type="radio" name="" id="" value="option2">
                  <label class="form-check-label" for="">B</label>
                </div>
                <div class="form-check ml-5">
                  <input class="form-check-input" type="radio" name="" id="" value="option2">
                  <label class="form-check-label" for="">C</label>
                </div>
              </div>
              <div class="form-group mb-2 mt-2r">
                <label for="" class="h3 text-black mb-3">Select Credit</label>
                <div class="d-sm-flex">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="" id="" value="option1">
                    <label class="form-check-label" for="">1.0</label>
                  </div>
                  <div class="form-check ml-5">
                    <input class="form-check-input" type="radio" name="" id="" value="option2">
                    <label class="form-check-label" for="">0.50</label>
                  </div>
                  <div class="form-check ml-5">
                    <input class="form-check-input" type="radio" name="" id="" value="option2">
                    <label class="form-check-label" for="">0.25</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-5">
            <a href="select-language-arts" class="btn btn-primary">I'm finished adding AP Courses</a>
            <a href="#" class="btn btn-primary ml-4">Add Another AP Course</a>
          </div>
        </form>
      </div>


    </main>
    <!-- Help me decide -->
    <div class="modal fade" id="HelpmeDecide" tabindex="-1" aria-labelledby="HelpmeDecideLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-body">
            <p>AP means Advanced Placement. To put AP in front of a course name, you must have taken and passed with a grade of A, B or C an actual AP course listed on this website: https://apstudents.collegeboard.org/course-index-page</p>
            <p>Enter the exact name of the course and the grade you received. You will need to show us proof of taking and passing the course.</p>
            <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></div>
          </div>
        </div>
      </div>
    </div>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
  </div>

</div>