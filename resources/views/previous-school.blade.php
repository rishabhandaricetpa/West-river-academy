
<div class="d-flex">
<!-- * =============== Sidebar =============== * -->
@include('layouts.partials.sidebar')
  <!-- * =============== /Sidebar =============== * -->

     <div class="main-content position-relative ml-auto">
     <title> @yield('pageTitle', 'Enroll Students') | {{config('app.name')}}</title>
<!-- =============== Header =============== -->
@include('layouts.partials.header')
<!-- =============== /Header =============== -->

<!-- * =============== Main =============== * -->

  <main class="position-relative container form-content mt-4">
       <h1 class="text-center text-white text-uppercase">previous school</h1>
          <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
          <form class="mb-0">
    <div class="form-group d-sm-flex mb-2">
      <label for="">School Name</label>
      <div>
        <input
          type="text"
          class="form-control"
          id=""
          name=""
          required
          aria-describedby=""
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Email Address</label>
      <div>
        <input
          type="text"
          class="form-control"
          id=""
          name=""
          required
          aria-describedby=""
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Fax Number</label>
      <div>
        <input
          type="text"
          class="form-control"
          id=""
          name=""
          required
          aria-describedby=""
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Phone Number</label>
      <div>
        <input
          type="text"
          class="form-control"
          id=""
          name=""
          required
          aria-describedby=""
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Street Address</label>
      <div>
        <input
          type="text"
          class="form-control"
          id=""
          name=""
          required
          aria-describedby=""
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">City</label>
      <div>
        <input
          type="text"
          class="form-control"
          id=""
          name=""
          required
          aria-describedby=""
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">State/Province/Region</label>
      <div>
        <input
          type="text"
          class="form-control"
          id=""
          name=""
          required
          aria-describedby=""
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Zip/Postal Code</label>
      <div>
        <input
          type="text"
          class="form-control"
          id=""
          name=""
          required
          aria-describedby=""
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Country</label>
      <div>
        <input
          type="text"
          class="form-control"
          id=""
          name=""
          required
          aria-describedby=""
        />
      </div>
    </div>
    <div class="mt-4">
    <a href="#" role="button" class="btn btn-primary mr-2">Back</a>
    <a href="#" role="button" class="btn btn-primary mr-2">Cancel</a>
    <a href="#" role="button" class="btn btn-primary mr-2">Submit</a>
    </div>
  </form>
             </div>    
  </main>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>