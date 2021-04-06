
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
   <h1 class="text-center text-white text-uppercase">order a personal consultation</h1>
   <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
   <form method="POST" class="mb-0 auto-label" action="">
      @csrf
     <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita, ex voluptatem molestiae officia nostrum velit similique modi quod facilis. Corporis.</p>
     <div class="form-group mb-2 lato-italic info-detail pb-4">
                  <h3 class="mb-3">Please choose the language you prefer.</h3>
                  <div class="form-check mb-2">
                     <input class="form-check-input"  id="select-english" type="radio" name="student_grade" value="Preschool Age 3">
                     <label class="form-check-label" for="">
                       English
                     </label>
                  </div>
                  <div class="form-check mb-2">
                     <input class="form-check-input" id="select-spanish" type="radio" name="student_grade" value="Preschool Age 4">
                     <label class="form-check-label" for="" >
                       Spanish
                     </label>
                  </div>
               </div>
               <h3 class="mb-3">You will initiate the call. How do you wish to call us?</h3>
               <div class="form-group mb-2 lato-italic info-detail pb-4 d-none" id="call_method_1">
                  <div class="form-check mb-2">
                     <input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 3">
                     <label class="form-check-label" for="">
                      My service provider
                     </label>
                  </div>
                  <div class="form-check mb-2">
                     <input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 4">
                     <label class="form-check-label" for="">
                      WhatsApp
                     </label>
                  </div>
                  <div class="form-check mb-2">
                     <input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 4">
                     <label class="form-check-label" for="">
                      Telegram
                     </label>
                  </div>
               </div>
               <div class="form-group mb-2 lato-italic info-detail pb-4 d-none" id="call_method_2">
                  <div class="form-check mb-2">
                     <input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 4">
                     <label class="form-check-label" for="">
                      Zoom
                     </label>
                  </div>
                  <div class="form-check mb-2">
                     <input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 4">
                     <label class="form-check-label" for="">
                      Google Meet
                     </label>
                  </div>
  
               </div>
               <div class="d-sm-flex mb-3">
               <p>The fee is $80 per hour. Select the number of hours:</p>
                    <div class="row ml-3 mx-0">
                    <select class="form-control col-3" >
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                </select>
                <span class="col-3 text-center">=</span>
                <input type="text" class="form-control col-3">
                </div>
                </div>
               <div class="form-group">
   <p class="mb-2">what would you like about during the consultation?</p>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
        </div>
  <div  class="form-wrap border bg-light py-5 px-25 dashboard-info mt-4">
  <button type="submit" class="btn btn-primary ml-auto">Add to cart</button>
  </div>
   </form>
</main>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>