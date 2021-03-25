<div class="d-flex">
   <!-- * =============== Sidebar =============== * -->
   @include('layouts.partials.sidebar')
   <!-- * =============== /Sidebar =============== * -->

   <div class="main-content position-relative ml-auto">
      <title> @yield('pageTitle', 'Student College Information') | {{config('app.name')}}</title>
      <!-- <sup>*</sup> =============== Header =============== <sup>*</sup> -->
      @include('layouts.partials.header')
      <!-- <sup>*</sup> =============== /Header =============== <sup>*</sup> -->

      <!-- * =============== Main =============== * -->

      <main class="position-relative container form-content mt-4 label-styling label-md">
         <h1 class="text-center text-white text-uppercase">College Information</h1>
         <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
            <form method="POST" class="mb-0" action="{{route('collegeDetails',$student_id)}}">
               @csrf
               <div class="form-group mb-2 lato-italic info-detail">
                  <h3 class="mb-3">Did you take any college or university courses during high school?</h3>
                  <div class="form-check mb-2">
                     <input class="form-check-input" type="radio" name="is_apCourse" value="Yes" data-target="#collegecourse" data-toggle="modal">
                     <label class="form-check-label" for="">
                        Yes
                     </label>
                  </div>
                  <div class="form-check mb-2">
                     <input class="form-check-input" type="radio" name="is_apCourse" value="No">
                     <label class="form-check-label" for="">
                        No
                     </label>
                  </div>
               </div>
               <div class="text-center">
                  <button type="submit" class="btn btn-primary">Continue</button>
               </div>
            </form>
      </main>
      <!-- * =============== /Main =============== * -->
      @include('layouts.partials.footer')
   </div>
   <!-- Choose Dates -->
   <div class="modal fade" id="collegecourse" tabindex="-1" aria-labelledby="collegecourseLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
            <div class="modal-body">
               <p>If you selected YES, it means that this course was offered at a college or university and you took and passed the course.</p>
               <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></div>
            </div>
         </div>
      </div>
   </div>
</div>