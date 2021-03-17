@extends('layouts.app')
@section('pageTitle', 'Graduation Submitted')
@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">Dashboard</h1>
  <div class="form-wrap border bg-light py-5 px-25">
    <div class="col-sm-7 mx-auto text-center">
      <p>Congratulations! Your application to graduate has been approved. Please proceed to pay the fee of <span class="text-secondary">$395</span> for Graduation. You will then receive instructions for
        completing your Graduation Project and transcript.</p>
      <div><a href="#" class="btn btn-primary my-4">Click here to pay the fee</a></div>
      <a href="#" class="text-secondary">Back to Dashboard</a>
    </div>
  </div>
</main>

<!-- * =============== /Main =============== * -->
@endsection