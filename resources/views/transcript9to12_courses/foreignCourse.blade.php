@extends('layouts.app')
@section('pageTitle', 'Foreign Language Course')
@section('content')
    <div id="app">
        <main class="position-relative container form-content mt-4">
            <h1 class="text-center text-white text-uppercase">transcript wizard</h1>
            <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
                <h3> Select a Foreign Language course:</h3>
                <foreign-transcript-course :required_credit='@json($selectedCreditRequired)'
                :trans_id='@json($trans_id)'
                    :total_credits='@json($total_credits)' :all_credits='@json($all_credits)'
                    :foreignsubjects='@json($foreignSubjects)' :transcript_id='@json($transcript_id)'
                    :courses_id='@json($courses_id)' :student_id='@json($student_id)'
                    :remaining_credit='@json($remaining_credit)'
                    ></foreign-transcript-course>
            </div>

        </main>
        <!-- Choose Dates -->
        @include('transcript9to12_courses.chooseDates')

    @endsection
