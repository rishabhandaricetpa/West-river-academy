
@extends('layouts.app')

@section('content')
<main class="position-relative container form-content mt-4">
       <h1 class="text-center text-white text-uppercase">cart</h1>
       <div class="form-wrap border bg-light py-5 px-25">
        <div class="col-sm-6 table-content">
          <div id="app">
            <get-cart :students='@json($enroll_fees)'> </get-cart>
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