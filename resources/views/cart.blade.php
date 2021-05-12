@extends('layouts.app')
@section('pageTitle', 'Cart')
@section('content')
<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">cart</h1>
  <div class="form-wrap border bg-light py-5 px-25">
    <div class="col-lg-6 table-content">
      <div id="app">
        <get-cart :students='@json($enroll_fees)'> </get-cart>
      </div>

      <div class="mt-5 d-sm-flex align-items-center">
        <div>
          <a href="/enroll-student" class="btn btn-secondary mb-lg-0 mb-4">Add Student</a>
          <a href="/dashboard" class="btn btn-secondary ml-sm-2 mb-lg-0 mb-4">Add Service</a>
        </div>
        <a href="{{url('/edit/address', Auth::user()->id)}}" class="btn btn-primary ml-auto mb-lg-0 mb-4 transform-none">Check Out and Pay</a>
      </div>
    </div>
  </div>
</main>
@endsection