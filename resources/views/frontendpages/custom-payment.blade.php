
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

  <main class="position-relative container form-content mt-4">
  <div class="form-wrap border bg-light form-content small-container">
     <h2>Make a Custom Payment</h2>
       <form method="POST" action="{{ route('login') }}" class="mb-0">
      @csrf
      <div class="form-group d-sm-flex mb-2">
        <label for="">Amount</label>
        <div>
        <input type="number" name="amount" id="amount" value="580" class="w-100" step="0.01">
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="exampleInputPassword1">What are you paying for?</label>
        <div>
          <input type="text" class="form-control" required>
        </div>
      </div>
      <div class="mt-2r">
        <button type="submit" class="btn btn-primary">Cancel</button>
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </form>  
    </div>         
  </main>

    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>