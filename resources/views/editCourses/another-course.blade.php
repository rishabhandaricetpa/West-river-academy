@extends('layouts.app')
@section('pageTitle', 'Another Course')
@section('content')

    <div id="app">
        <main class="position-relative container form-content mt-4">
            <h1 class="text-center text-white text-uppercase"></h1>
            <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
                <h3>Enter an elective, such as MUSIC, ART, DANCE. DRAMA. etc:</h3>
                <edit-another :anothercourse='@json($another_course)' :transcripts='@json($transcripts)'
                    :trans_id='@json($trans_id)' :student_id='@json($student_id)' :courses_id='@json($courses_id)'
                    :transcript_id='@json($transcript_id)'> </edit-another>
            </div>
        </main>
        <div class="modal fade" id="chooseGrades" tabindex="-1" aria-labelledby="chooseGradesLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>A = 90-100% Excellent</p>
                        <p>B = 80-89% Good</p>
                        <p>C = 70-79% Satisfactory </p>
                        <p>D = 90-100% Unsatisfactory but passing</p>
                        <p>Pass = Course was studied and no garde was given</p>
                        <div class="text-right mt-3"><button type="button" class="btn btn-primary"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
