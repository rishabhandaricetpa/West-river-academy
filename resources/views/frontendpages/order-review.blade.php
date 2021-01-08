
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
   <div class="form-wrap border bg-light py-5 px-25">
      <h2 class="mb-3">Billing Information</h2>
      <form method="POST"  class="mb-0">
         <div class="form-group d-sm-flex mb-2">
            <label for="">Name</label>
            <div> </div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Street</label>
            <div>-</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">City</label>
            <div>-</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">State</label>
            <div>-</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Zip</label>
            <div>-</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Country</label>
            <div>-</div>
         </div>
      </form>
   </div>
   <div class="form-wrap border bg-light py-5 px-25 mt-2r">
      <h2 class="mb-3">Payment Items</h2>
      <div class="seperator">
      <div class="row gray-bg py-2 text-capitalize">
        <div class="col-sm-3">
        <span>item</span>
        </div>
        <div class="col-sm-3">
        <span>quantity</span>
        </div>
        <div class="col-sm-3">
        <span>price</span>
        </div>
        <div class="col-sm-3">
        <span>total</span>
        </div>
   </div>
   <div class="row py-2">
        <div class="col-sm-3">
        <span></span>
        </div>
        <div class="col-sm-3">
        <span>1</span>
        </div>
        <div class="col-sm-3">
        <span>$</span>
        </div>
        <div class="col-sm-3">
        <span>$0.00</span>
        </div>
      </div>
      </div>
      <div class="total-amount pt-5">
      <span>Total price</span>
      <span class="float-right">$0.00</span>
      </div>
</div>
<div class="form-wrap border bg-light py-2r px-25 mt-2r">
      <a href="#" class="btn btn-primary">cancel</a>
      <a href="#" class="btn btn-primary">back</a>
      <a href="#" class="btn btn-primary">submit payment</a>
   </div>
</main>

    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>


