

@extends('layouts.app')

@section('content')

    <main class="position-relative container form-content mt-4">
      <h1 class="text-center text-white text-uppercase">dashboard</h1>
      <form method="POST" action="{{ route('add.cart') }}" class="mb-0">
      @csrf
      <input type="hidden" name="amount" id="amount" value="{{$transcriptPayment->amount}}" class="w-100" step="0.01">
        <input type="hidden" name="type" id="transcript_edit" value="custom" class="w-100" step="0.01">
      <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
        <p>Any changes requested after your approval will incur a $25 change fee.</a></p>
        <div class="text-center">
                     <p>Transcript Edit Request </p>
                     <button type="submit" class="btn btn-primary">Proceed to pay</button>
                   </div>
      </div>
      </form>
    </main>

 @endsection