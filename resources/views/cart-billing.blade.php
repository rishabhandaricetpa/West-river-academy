
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
             <h2>Billing Address</h2>
             <form method="POST">
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">First Name</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>

                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Last Name</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>

                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Street</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">City</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">State</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Zip Code</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex">
                  <label for="">Country</label>
                      <div class="col-sm-4 px-0">
                              <select id="" class="form-control">
                                <option selected>India</option>
                                    <option>...</option>
                              </select>
                              </div>
                            </div>
  </form>
</div>

<div class="form-wrap border bg-light py-5 px-25 mt-2r">
             <h2>Shipping Address</h2>
             
             <form method="POST">
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">First Name</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>

                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Last Name</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>

                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Street</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">City</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">State</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Zip Code</label>
                      <div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex">
                  <label for="">Country</label>
                      <div class="col-sm-4 px-0">
                              <select id="" class="form-control">
                                <option selected>India</option>
                                    <option>...</option>
                              </select>
                              </div>
                            </div>
  </form>
</div>

<div class="form-wrap border bg-light py-5 px-25 mt-2r">
             <h2>Email Address</h2>
             <form method="POST">
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Email</label>
                      <div>
                        <input type="email" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>

  </form>
</div>
<div class="form-wrap border bg-light py-5 px-25 mt-2r payment-method">
             <h2>Select your method of payment...</h2>
             <h3 class="py-2">pay with</h3>
             <ul class="list-unstyled enlarge-input payment-method">
             <li class="py-3 pl-3">
             <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="">
            </div>
          <div class="payment-info"> 
            <h3>Pay Pal</h3>
            <p>You will be redirected to the PayPal website to complete your payment.</p>
          </div>
             </li>
             <li class="py-3 pl-3">
             <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="">
            </div>
          <div class="payment-info"> 
            <h3>Credit Card / Debit Card</h3>
            <p>Your credit card information will be taken on the next page.</p>
          </div>
             </li>
             <li class="py-3 pl-3">
             <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="">
            </div>
          <div class="payment-info"> 
            <h3>Credit Card / Debit Card</h3>
            <p>Your credit card information will be taken on the next page.</p>
          </div>
             </li>
             <li class="py-3 pl-3">
             <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="">
            </div>
          <div class="payment-info"> 
            <h3>Credit Card / Debit Card</h3>
            <p>Your credit card information will be taken on the next page.</p>
          </div>
             </li>
             </ul>
           
</div>

<div class="form-wrap border bg-light py-5 px-25 mt-2r">
             <h2>If you have a coupon code enter it here</h2>
             <form method="POST">
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Coupon Code</label>
                      <div>
                        <input type="email" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" name="first_name" required aria-describedby="emailHelp">
                      </div>
                  </div>
  </form>
</div>
<div class="form-wrap border bg-light py-2r px-25 mt-2r">
          <a href="#" class="btn btn-primary" >Back</a>
          <a href="#" class="btn btn-primary ml-3" >Continue</a>
        </div>
  </main>

    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
    </div>

</div>


