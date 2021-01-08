
@extends('layouts.app')

@section('content')
<main class="position-relative container form-content mt-4">
       <h1 class="text-center text-white text-uppercase">cart</h1>
       <div class="form-wrap border bg-light py-5 px-25">
        <div class="col-sm-6 table-content">
        <div>
            <h3>Eric</h3>
              <div class="row border-bottom py-3">
                <div class="col-sm-6"><p>2 Annual</p></div>
                <div class="col-sm-2 text-right price"><p>$750</p></div>
                <div class="col-sm-2 text-right"><a href="#">Remove</a></div>
                <div class="col-sm-2 text-right edit"><a href="#">Edit</a></div>
              </div>
              <div class="row border-bottom py-3">
                <div class="col-sm-6"><p>1 Second Semester Only</p> </div>
                <div class="col-sm-2 text-right price"><p>$200</p></div>
                <div class="col-sm-2 text-right"><a href="#">Remove</a></div>
                <div class="col-sm-2 text-right edit"><a href="#">Edit</a></div>
              </div>
              <div class="row border-bottom py-3">
                <div class="col-sm-6"><p>1 Initial Transcript</p></div>
                <div class="col-sm-2 text-right price"><p>$80</p></div>
                <div class="col-sm-2 text-right"><a href="#">Remove</a></div>
                <div class="col-sm-2 text-right edit"><a href="#">Edit</a></div>
              </div>
          </div>  

          <div class="mt-2r">
            <h3>julia</h3>
              <div class="row border-bottom py-3">
                <div class="col-sm-6"><p>1 Annual</p></div>
                <div class="col-sm-2 text-right price"><p>$50</p></div>
                <div class="col-sm-2 text-right"><a href="#">Remove</a></div>
                <div class="col-sm-2 text-right edit"><a href="#">Edit</a></div>
              </div>
              <div class="row border-bottom py-3">
                <div class="col-sm-6"><p>1 Graduation Project </p></div>
                <div class="col-sm-2 text-right price"><p>$395</p></div>
                <div class="col-sm-2 text-right"><a href="#">Remove</a></div>
                <div class="col-sm-2 text-right edit"><a href="#">Edit</a></div>
              </div>
          </div> 

          <div class="cart-total row py-2">
            <div class="col-sm-6"><p>ToTal</p></div>
            <div class="col-sm-2 text-right price"><p>$1475</p></div>
          </div>  
          <div class="mt-5 d-sm-flex">
            <div>
              <a href="#" class="btn btn-secondary">Add Student</a>
              <a href="#" class="btn btn-secondary ml-sm-2">Add Service</a>
            </div>
            <a href="{{url('/edit', Auth::user()->id)}}" class="btn btn-primary ml-auto">Check Out and Pay</a>
          </div>
        </div>
       </div>
  </main>
@endsection