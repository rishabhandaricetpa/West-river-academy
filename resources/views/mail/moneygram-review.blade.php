
@extends('layouts.app')

@section('content')


<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
  <div class="form-wrap border bg-light form-content small-container">
    <h2 class="text-capitalize">Thank you!</h2>
    <p class="mb-0">We sent an email to {{$email}} .Please check your email receipt for information about paying by Money Gram.
</p>
  </div>
</main>

<!-- * =============== /Main =============== * -->
@endsection