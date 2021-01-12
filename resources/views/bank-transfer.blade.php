@extends('layouts.app')

@section('content')

<main class="position-relative container form-content mt-4">
   <h1 class="text-center text-white text-uppercase">Bank Transfers</h1>
   <div class="form-wrap border bg-light py-5 px-25">
      <h2 class="mb-3">TransferWise</h2>
      <p>If you are able to use TransferWise, it’s the least expensive way to pay your fees. Here are our Transfer details.</p>
      <form method="POST"  class="mb-0">
         <div class="form-group d-sm-flex mb-2">
            <label for="">Account Holder</label>
            <div> West River Educational Services</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Account Number</label>
            <div>822000140123</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Wire transfer number</label>
            <div>026073008</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Bank code: (SWIFT / BIC)</label>
            <div>CMFGUS33</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Routing number (ACH or ABA)</label>
            <div>026073150</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Address</label>
            <div>
            <p class="mb-1">TransferWise</p>
            <p class="mb-1">19 W. 24th Street</p>
           <p class="mb-1"> New York, NY 10010</p>
            <p class="mb-1">United States</p>
            </div>
         </div>
         <div class="form-group d-sm-flex mb-0">
            <label for="">Website</label>
            <div><a href="http://transferwise.com">http://transferwise.com</a></div>
         </div>
      </form>
   </div>
   <div class="form-wrap border bg-light py-5 px-25 mt-2r">
      <h2 class="mb-3">Bank Information</h2>
      <p>If you cannot use TransferWise, please add $30 to your total to cover the intermediary bank charges. Here is the bank information:</p>
      <form method="POST" class="mb-0">
         <div class="form-group d-sm-flex mb-2">
            <label for="">Bank Name</label>
            <div>US Bank NA</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">SWIFT code</label>
            <div>USBKUS44IMT</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Bank Address</label>
            <div>
          <p>33621 Del Obispo St, Ste A</p>
          <p>Dana Point, CA 92629</p>
            </div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Phone Number</label>
            <div>(800) 872-2657</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Routing Number</label>
            <div>102000021</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Account Name</label>
            <div>West River Educational Services, Inc.</div>
         </div>
         <div class="form-group d-sm-flex mb-0">
            <label for="">Account Number</label>
            <div>153463063153</div>
         </div>
      </form>
   </div>
   <div class="form-wrap border bg-light py-2r px-25 mt-2r">
      <a href="#" class="btn btn-primary">Return to the Dashboard</a>
   </div>
</main>

@endsection
