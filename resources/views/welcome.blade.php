
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

          <div class="form-wrap border bg-light py-5 px-25">
             <h2 class="mb-5">What would you like to do?</h2>
            <div class="row">
           <div class="col-md-3 col-sm-6 text-center">
           <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-comments rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order a Personal Consultation</h3>
              </a>
           </div>  
           <div class="col-md-3 col-sm-6 text-center">
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-stamp rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order Postage</h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-id-card-alt rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order a Student ID Card</h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-file-alt rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order an Apostille or Notarization</h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-credit-card rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Make a Payment</h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-graduation-cap rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Apply for Graduation</h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-clipboard rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order a Custom Letter</h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-sync rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Renew my Family’s Enrollment</h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-user-graduate rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Enroll a new Student in my Family</h3>
              </a>
            </div>

              <div class="col-sm-12">
                  <p>Needs Help? Check out our <a href="#">Dashboard Tuorial </a> <span class="px-4">or</span><a href="#" role="button" class="btn btn-primary"> Help me decide</a></p>
             </div>
         </div>
  </main>

    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>


