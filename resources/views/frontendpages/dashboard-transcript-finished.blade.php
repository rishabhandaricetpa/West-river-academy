
<div class="d-flex">
<!-- * =============== Sidebar =============== * -->
<sidebar class="main-sidebar bg-secondary pt-5 fixed-top overflow-auto">
    <ul class="list-unstyled">
    <li>
    <a href="#"><span>Dashboard</span><i class="fas fa-tachometer-alt"></i>
Download SVGPerfect for when you want to use just one icon as a vector on the desktop or in your own icon workflow.</a>
      <ul class="list-unstyled">
        <li><a href="#"><span>Add student</span><i class="fas fa-user-graduate"></i></a></li>
        <li><a href="#"><span>add enrollment</span><i class="fas fa-edit"></i></a></li>
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
            <p class="w-100">I’m finished with this transcript. I want to see what it looks like.</p>
            <a href="#" class="btn btn-primary mt-auto font-weight-bold">View Transcript</a>
          </div>
  </main>

    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>


