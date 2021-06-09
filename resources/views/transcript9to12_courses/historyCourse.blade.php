@extends('layouts.app')
@section('pageTitle', 'History Language Course')
@section('content')
    <div id="app">
        <main class="position-relative container form-content mt-4">
            <h1 class="text-center text-white text-uppercase">transcript wizard</h1>
            <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
                <h3> Select an History / Social Science course:</h3>
                <history-transcript-course :total_credits='@json($total_credits)' :all_credits='@json($all_credits)'
                    :required_credit='@json($selectedCreditRequired)' :historycourse='@json($historyCourse)'
                    :transcript_id='@json($transcript_id)' :courses_id='@json($courses_id)'
                    :student_id='@json($student_id)'></history-transcript-course>
            </div>

        </main>
        <!-- Choose Dates -->
        <div class="modal fade" id="GradeHelp" tabindex="-1" aria-labelledby="GradeHelpLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <ul class="list-unstyled">
                            <li>A=90-100% <sub>4</sub> Grade Points, Excellent</li>
                            <li>A=80-89% <sub>3</sub> Grade Points, Good</li>
                            <li>A=90-100% <sub>4</sub> Grade Points, Satisfactory</li>
                            <li>A=90-100% <sub>4</sub> Grade Points, Unsatisfactory but passing</li>
                        </ul>
                        <div class="text-right mt-3"><button type="button" class="btn btn-primary"
                                data-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
