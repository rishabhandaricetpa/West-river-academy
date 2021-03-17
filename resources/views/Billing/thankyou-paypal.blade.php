@extends('layouts.app')
@section('pageTitle', 'Thankyou')
@section('content')

<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">dashboard</h1>

    <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
        <p>Thankyou!</p>
        <p>Payment With Paypal Successfully Done</p>
        <a href="{{url ('dashboard')}}" class="btn btn-primary mt-4 font-weight-bold">Go to Dashboard</a>

    </div>
</main>

@endsection