@extends('layouts.app')
@section('pageTitle', 'Purchase Transcript')
@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
  <form method="POST" action="{{ route('add.cart') }}">
    @csrf
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
      <h2 class="mb-3">Purchase Transcripts</h2>
      <p>The first transcript created for a student is $80. Additional transcripts in subsequent years are $25.</p>
      <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-3">Transcript Payment Total</h2>
        <div class="row">
          <div class="col-sm-6 d-flex justify-content-center align-items-center">
            <div class="text-center">
              <p class="mb-0">Amount Due:</p>
              <span class="total-amount">${{ $transcript_fee }}</span>
            </div>
          </div>
          <input type="hidden" name="transcript_id" value="{{$transcript_id}}">
          <input type="hidden" name="type" value="transcript">
          <input type="hidden" name="student_id" value="{{ $student->id }}">
          <input type="hidden" name="type_for_cart" value="{{$type}}">
          <div class="col-sm-6 d-flex justify-content-center align-items-center">
            <div class="text-center">
              <p>Make an Online Payment:</p>
              <button type="submit" class="btn btn-primary">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</main>
<!-- * =============== /Main =============== * -->
@endsection