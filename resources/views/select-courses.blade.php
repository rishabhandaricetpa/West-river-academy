
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
       <h1 class="text-center text-white text-uppercase">dashboard</h1>

          <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info d-flex justify-content-center flex-wrap">
            <p class="w-100">You are ready to select the courses, credits and grades to put on the transcript for <a href="">Eric</a>. Be sure you have watched the tutorial and read the recommended course distribution before starting. </p>
           <div class="mt-auto col-xl-9 d-xl-flex justify-content-between">
           <a href="#" class="btn btn-primary font-weight-bold mb-4 mb-xl-0">View Transcript Tutorial</a>
           <a href="#" class="btn btn-primary font-weight-bold mb-4 mb-xl-0">Start to create transcript</a>
           <a href="#recommendedCourse" class="btn btn-primary font-weight-bold mb-4 mb-xl-0" data-toggle="modal">View recommended course distribution</a>
           </div> 
          </div>
  </main>
<!-- Choose more grade -->
<div class="modal fade" id="recommendedCourse" tabindex="-1" aria-labelledby="recommendedCourseLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
      <p class="mb-0">
        For a 4-year high school transcript, we recommend a total of 25- 29
        credits. You will be able to put a maximum of 7.25 credits in one year.</p>
        <ul class="list-unstyled">
        <li>The recommended distribution of courses is:</li>
       <li>English / Language Arts: 4 credits</li> 
       <li> History/Social Science: 2-3 credits</li>
        <li>Math: 2-3 credits</li>
       <li>Science: 2-3 credits</li> 
       <li>Physical Education: 2 credits</li> 
        <li>Health: 0.50 credit</li>
       <li>US Government: 0.50 credit</li> 
       <li>Second Language: 1-4 credits, depending on college</li> 
       <li>requirements, including American Sign Language.</li> 
       <li> Add Electives to total 25-29 credits for 4 years of high school. </li>
    </ul>
      <div class="text-right mt-4">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>  
      </div>
    </div>
  </div>
</div>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>


