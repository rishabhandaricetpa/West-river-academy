
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
       <h1 class="text-center text-white text-uppercase">cart</h1>
       <div class="form-wrap border bg-light py-5 px-25">
        <div class="col-sm-6 table-content">
        <div>
            <h3>Eric</h3>
              <div class="row border-bottom py-3">
                <div class="col-sm-6"><p>2 Annual</p></div>
                <div class="col-sm-2 text-right price"><p>$750</p></div>
                <div class="col-sm-2 text-right"><a href="#">Remove</a></div>
                <div class="col-sm-2 text-right edit"><a href="#">Edit</a></div>
              </div>
              <div class="row border-bottom py-3">
                <div class="col-sm-6"><p>1 Second Semester Only</p> </div>
                <div class="col-sm-2 text-right price"><p>$200</p></div>
                <div class="col-sm-2 text-right"><a href="#">Remove</a></div>
                <div class="col-sm-2 text-right edit"><a href="#">Edit</a></div>
              </div>
              <div class="row border-bottom py-3">
                <div class="col-sm-6"><p>1 Initial Transcript</p></div>
                <div class="col-sm-2 text-right price"><p>$80</p></div>
                <div class="col-sm-2 text-right"><a href="#">Remove</a></div>
                <div class="col-sm-2 text-right edit"><a href="#">Edit</a></div>
              </div>
          </div>  

          <div class="mt-2r">
            <h3>julia</h3>
              <div class="row border-bottom py-3">
                <div class="col-sm-6"><p>1 Annual</p></div>
                <div class="col-sm-2 text-right price"><p>$50</p></div>
                <div class="col-sm-2 text-right"><a href="#">Remove</a></div>
                <div class="col-sm-2 text-right edit"><a href="#">Edit</a></div>
              </div>
              <div class="row border-bottom py-3">
                <div class="col-sm-6"><p>1 Graduation Project </p></div>
                <div class="col-sm-2 text-right price"><p>$395</p></div>
                <div class="col-sm-2 text-right"><a href="#">Remove</a></div>
                <div class="col-sm-2 text-right edit"><a href="#">Edit</a></div>
              </div>
          </div> 

          <div class="cart-total row py-2">
            <div class="col-sm-6"><p>ToTal</p></div>
            <div class="col-sm-2 text-right price"><p>$1475</p></div>
          </div>  
          <div class="mt-5 d-sm-flex">
            <div>
              <a href="#" class="btn btn-secondary">Add Student</a>
              <a href="#" class="btn btn-secondary ml-sm-2">Add Service</a>
            </div>
            <a href="#" class="btn btn-primary ml-auto">Check Out and Pay</a>
          </div>
        </div>
       </div>
  </main>

    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>


