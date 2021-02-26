
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
          <form >
    <div class="form-group d-sm-flex mb-2">
      <label for="">First/Given Name</label>
      <div>
        <input
        placeholder="Name of school"
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
      <label for="">First/Given Name</label>
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
      <label for="">First/Given Name</label>
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
      <label for="">First/Given Name</label>
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
  </form>
             </div>    
  </main>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>