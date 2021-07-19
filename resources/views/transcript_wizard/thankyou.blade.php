@extends('layouts.app')
@section('pageTitle', 'Thank you')
@section('content')

    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase"></h1>

        <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
            <p>Thank you!</p>
            <p>Your transcript is saved.</p>
            <a href="{{ route('order-transcript', $id) }}" class="btn btn-primary mt-4 font-weight-bold">Purchase
                Transcript</a>
            @if ($type->period === 'K-8')
                <a href="{{ route('another.grade', [$student_id, $transcript_id]) }}"
                    class="btn btn-primary mt-4 font-weight-bold">View Saved Transcript</a>
            @else
                <a href="{{ route('display.grades', [$student_id, $transcript_id]) }}"
                    class="btn btn-primary mt-4 font-weight-bold">View Saved Transcript</a>
            @endif
            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-4 font-weight-bold">Go To Dashboard</a>
        </div>
    </main>

@endsection
