@extends('layouts.app')
@section('pageTitle', 'Thank you')
@section('content')

<main class="position-relative container form-content mt-4">
  <div class="form-wrap border bg-light form-content small-container">
    @csrf
    <h2 class="text-capitalize">Thank you!</h2>
    <p class="mb-0">Your transaction was successful. Please check Your email for the Receipt.</p>
    <br />
    <a href="{{route('dashboard')}}" class="btn btn-primary">Go to Dashboard</a>
  </div>
  @endsection