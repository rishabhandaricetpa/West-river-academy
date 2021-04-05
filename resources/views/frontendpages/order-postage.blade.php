
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
   <form method="POST" class="mb-0" action="">
      @csrf
     <p>Select the country you are shipping to. We only ship Express outside the US.</p>
     <div class="form-row col-md-10">
    <div class="form-group col-md-9">
      <select id="inputState" class="form-control col-md-4">
        <option selected="">Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-3 d-md-flex">
    <p class="pr-md-3 space-pre">Total Due:</p>
    <div class="d-flex"> 
    <i class="fas fa-dollar-sign additional-sign"></i>
        <input type="text" class="form-control" id="inputZip">
       
    </div>
    </div>
    <button type="submit" class="btn btn-primary ml-auto">Add to cart</button>
  </div>
  <div>
  <p>If country is US:</p>
  <div class="form-row col-md-10">
    <div class="form-group col-md-10 form-row">
      <select id="inputState" class="form-control col-md-4 mr-5">
        <option selected="">United States of America</option>
        <option>...</option>
      </select>
      <input type="text" class="form-control col-md-2 ml-4" id="inputZip">
    </div>
 
  </div>
     <div class="form-row col-md-10">
    <div class="form-group col-md-9 form-row">
    <select id="inputState" class="form-control col-md-2  offset-md-6">
        <option selected="">United States of America</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-3 d-md-flex">
    <p class="pr-md-3 space-pre">Total Due:</p>
    <div class="d-flex"> 
    <i class="fas fa-dollar-sign additional-sign"></i>
        <input type="text" class="form-control" id="inputZip">
 
    </div>
      
    </div>
    <button type="submit" class="btn btn-primary ml-auto">Add to cart</button>
  </div>
  </div>
   </form>
</main>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>