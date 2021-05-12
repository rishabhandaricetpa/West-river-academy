@extends('layouts.app')
@section('pageTitle', 'Thank you')
@section('content')

    <main class="position-relative container form-content mt-4">
        <div class="form-wrap border bg-light form-content small-container">
            @csrf
            <h2 class="text-capitalize">Thank you!</h2>
            <p class="mb-0">Your record request is successfully sent.</p>
            <br />
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
            <a href="{{ route('record.transfer', $parent_id) }}" class="btn btn-primary">Submit Request for another
                Student</a>
        </div>
    @endsection
