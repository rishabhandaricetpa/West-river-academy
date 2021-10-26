@extends('admin.app')

@section('content')

    <section class="content container-fluid  mt-3 pb-3">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- first card parent details -->

        <div class="card mt-3 px-4 py-5">
            <h2 class="py-4">Mails </h2>
            <a class="email-card m-1 p-3" href="{{ route('admin.studentEnrollment.mail', 'enrollment') }}">Student
                Enrollement Mail</a>
            <a class="email-card m-1 p-3" href="{{ route('admin.studentEnrollment.mail', 'moneygram') }}">MoneyGram
            </a>
            <a class="email-card m-1 p-3" href="{{ route('admin.studentEnrollment.mail', 'graduation') }}">Graduation</a>
            <a class="email-card m-1 p-3" href="{{ route('admin.studentEnrollment.mail', 'moneyorder') }}">Check Or Money
                Order</a>
        </div>
    </section>

@endsection
