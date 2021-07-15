@extends('layouts.app')
@section('pageTitle', 'English Language Course')
@section('content')
    <div id="app">
        <main class="position-relative container form-content mt-4">
            <h1 class="text-center text-white text-uppercase">transcript wizard</h1>
            <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
                <h3>Select a English/ Language Arts course:</h3>

                <english-transcript-course :total_credits='@json($total_credits)' :required_credit='@json($selectedCreditRequired)' :all_credits='@json($all_credits)'
                    :englishcourse='@json($englishCourse)' :transcript_id='@json($transcript_id)'
                    :courses_id='@json($courses_id)' :student_id='@json($student_id)' :component_index=0></english-transcript-course>
            </div>

        </main>
        <!-- Choose Dates -->
        @include('transcript9to12_courses.chooseDates')

    @endsection
