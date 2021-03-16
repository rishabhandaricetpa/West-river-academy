@extends('layouts.app')
@section('pageTitle', 'Thankyou')
@section('content')

<main class="position-relative container form-content mt-4">
  <div class="form-wrap border bg-light form-content small-container">
    <form>
      @csrf
      <h2 class="text-capitalize">Thank you!</h2>
      <h2 class="text-capitalize">Download Enrollment Confirmation</h2>
      <p class="mb-0">Your download will begin automatically. If it does not click <a href="{{ route('genrate.confirmition',$student_id) }}">here</a>. </p>
      <br />
      <a href="{{route('dashboard')}}" class="btn btn-primary">Go to Dashboard</a>
  </div>
  @endsection