@extends('layouts.app')
@section('pageTitle', 'Order Custom Letter')
@section('content')
<main class="position-relative container form-content mt-4">
    <div class="form-wrap border bg-light form-content small-container">
        <h2>Order Custom Letters</h2>
        <form method="POST" action="{{ route('add.cart') }}" class="mb-0">
            @csrf
            <div class="form-group d-sm-flex mb-2">
                <div>
                    <input type="hidden" name="amount" value="{{$custom_letter_fee}}" class="w-100" step="0.01">
                    <input type="hidden" name="type" id="custom_letter" value="custom_letter" class="w-100" step="0.01">
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="exampleInputPassword1">Quantity Needed</label>
                <div>
                    <input type="number" name="quantity" class="form-control" required>
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="exampleInputPassword1">What are you Paying for ?</label>
                <div>
                    <input type="text" name="paying_for" class="form-control">
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