
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

          <div class="form-wrap border bg-light py-2r px-25 dashboard-info">
          <form class="mb-0 inner-form-wrapper">
      <input type="hidden" name="_token" value="EuQSC1dz2DZVzUfe5dXy1humimXPHGOMn7AlzReS">      <div class="form-group d-sm-flex mb-2">
        <label for="exampleInputEmail1">First name</label>

        <div>
          <input id="email" type="email" class="form-control " name="email" value="" required="" autocomplete="email" autofocus="">
          <!--   <div class="alert alert-danger">Enter your user ID.</div> -->
                            </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Middle Name</label>
        <div>
          <input type="text" class="form-control " name="password" required="" autocomplete="">
          <!--  <div class="alert alert-danger">Enter your password.</div> -->
                  </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Last Name</label>
        <div>
          <input type="text" class="form-control " name="password" required="" autocomplete="">
          <!--  <div class="alert alert-danger">Enter your password.</div> -->
                  </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Country to present transcript</label>
        <div>
            <select class="form-select w-100" aria-label="Default select example">
            <option selected>USA</option>
            <option value="">...</option>
            <option value="">...</option>
            <option value="">...</option>
            </select>
         </div>
      </div>
      <div class="text-left">
          <a href="#HelpmeDecide" class="btn btn-primary" data-toggle="modal" >Help me decide</a>
      </div>
      <div class="mt-5 text-center">
        <a href="#" class="btn btn-primary">Continue</a>
      </div>
      <!-- <div class="register-info">Don't have an account yet? <a href="http://127.0.0.1:8000/register">Click this link to create one.</a></div> -->
    </form>
          </div>
  </main>
  <!-- Choose Dates -->
  <div class="modal fade" id="HelpmeDecide" tabindex="-1" aria-labelledby="HelpmeDecideLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
       <p>Select the country where the transcript will be used. It may be a country other than where you live.</p>
      <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></div>  
      </div>
    </div>
  </div>
</div>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>


