@extends('layouts.app')
@section('pageTitle', 'Notify')
@section('content')

    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase"></h1>

        <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
            <p>You can not request for record transfer for this Student. Because you have not paid for any enrollment.</a>
            </p>
            <p>We recommend that you have to first pay at least for one enrollment to request for record transfer.</p>
            <a href="{{ url('reviewstudents') }}" class="btn btn-primary mt-4 font-weight-bold">Pay Enrollment Fees</a>
        </div>
    </main>

@endsection
