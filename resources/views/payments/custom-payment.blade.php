@extends('layouts.app')

@section('content')
<main class="position-relative container form-content mt-4">
  <div class="form-wrap border bg-light form-content small-container">
    <h2>Make a Custom Payment</h2>
    <form method="POST" action="{{ route('add.cart') }}" class="mb-0">
      @csrf
      <div class="form-group d-sm-flex mb-2">
        <label for="">Amount</label>
        <div>
          <input type="number" name="amount" id="amount" value="" class="w-100" step="0.01" required>
          <input type="hidden" name="type" id="custom" value="custom" class="w-100" step="0.01">
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="exampleInputPassword1">What are you paying for?</label>
        <div>
          <input type="text" name="paying_for" class="form-control" required>
        </div>
      </div>
      <div class="mt-2r">
        <a href="{{route('dashboard')}}" class="btn btn-primary">Cancel</a>
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </form>
  </div>
</main>
@endsection