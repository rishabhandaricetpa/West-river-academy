
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
       <h1 class="text-center text-white text-uppercase">enroll students</h1>
          <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
             <form method="POST" class="mb-0 px-0 unstyled-label">
               <div class="col-sm-7 px-0">
               <h3 class="mb-3">Select an Elective:<i class="ml-2 fas fa-question-circle tooltip-styling text-secondary" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i></h3>
                  <div class="form-group">
                    <label for="" class="h3 text-black">Enter an elective, such as MUSIC, ART, DANCE. DRAMA. etc.</label>
                      <div class="w-100">
                        <input type="text" class="form-control" name="" value="" aria-describedby="">
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="d-sm-flex mt-4">
                      <h3>Select a Grade</h3>
                      <a href="#" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#GradeHelp">Help me Decide</a>
                    </div>
                  <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="" value="option1">
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
                        <label class="form-check-label" for="">Pass</label>
                    </div>
                    <div class="form-group mb-1 mt-2r">
                        <h3 class="text-black">Select Credit: The recommended credit for a one-year course is selected. You may change it.</h3>
                        <select class="form-control min-select" data-toggle="collapse" href="#remainingCredits" role="button" aria-expanded="false" aria-controls="remainingCredits">
                          <option>1.0</option>
                         </select>
                         <h3 class="collapse mt-4" id="remainingCredits">You have 6.25 out of 7.25 remaining credits for this year.</h3>
                    </div>
                  </div>
                  <div class="mt-2r">
                    <a href="#" class="btn btn-primary">Add another Elective</a>
                    <a href="#" class="btn btn-primary ml-4 float-right">Continue</a>
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
       <ul class="list-unstyled">
         <li>A=90-100% <sub>4</sub> Grade Points, Excellent</li>
         <li>A=80-89% <sub>3</sub> Grade Points, Good</li>
         <li>A=90-100% <sub>4</sub> Grade Points, Satisfactory</li>
         <li>A=90-100% <sub>4</sub> Grade Points, Unsatisfactory but passing</li>
       </ul>
      <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></div>  
      </div>
    </div>
  </div>
</div>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>