
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
   <h1 class="text-center text-white text-uppercase">order postage</h1>
   <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
   <form method="POST" class="mb-0 auto-label" action="">
      @csrf
     <p>Select the country you are shipping to. We only ship Express outside the US.</p>
     <div class="form-row px-0">
     <div class="form-group col-lg-6 col-xl-3 d-md-flex">
      <label for="inputState" >Country</label>
      <select id="select-particular" class="form-control">
        <option selected="">United states of america</option>
        <option>india</option>
        <option>America</option>
      </select>
    </div>
    <div class="form-group  col-lg-3 d-md-flex ml-lg-auto">
    <p class="pr-md-3 space-pre ml-auto">Total Due:</p>
    <div class="d-flex"> 
    <i class="fas fa-dollar-sign additional-sign"></i>
        <input type="text" class="form-control" id="inputZip">
    </div>
    </div>
  </div>
  <div id="select-us" class="d-none">
  <p>If country is US:</p>
  <div class="form-row px-0 seperator-top">

  <div class="form-group  col-lg-3  d-md-flex">
      <label for="inputCity">Country</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group  col-lg-3  d-md-flex">
      <label for="inputState" >State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group  col-lg-3  d-md-flex">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
    <div class="form-group  col-lg-3  d-md-flex">
    <p class="pr-md-3 space-pre ml-auto">Total Due:</p>
    <div class="d-flex"> 
    <i class="fas fa-dollar-sign additional-sign"></i>
        <input type="text" class="form-control" id="inputZip">
    </div>
    </div>
  </div>
    </div>

  </div>
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