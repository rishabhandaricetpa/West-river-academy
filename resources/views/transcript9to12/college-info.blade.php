@extends('layouts.app')
@section('pageTitle', 'Transcript Information')
@section('content')

    <main class="position-relative container form-content mt-4">
        <div id="app">
            <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
                <college-course :student_id='@json($student_id)' :required_credit='@json($selectedCreditRequired)'
                    :transcript_id='@json($transcript_id)' :transcript9_12id='@json($transcript9_12id)'
                    :credits='@json($credits)'>
                </college-course>
            </div>


    </main>
    <!-- Choose Dates -->
    <div class="modal fade" id="GradeHelp" tabindex="-1" aria-labelledby="GradeHelpLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Yes means the course would appear in the list of AP courses here:
                        <a href="https://apstudents.collegeboard.org/course-index-page"
                            target="_blank">https://apstudents.collegeboard.org/course-index-page</a>
                    </p>
                    <p>It will receive an extra grade point. If you took elective courses which have no AP equivalent, you
                        should select NO.</p>
                    <div class="text-right mt-3"><button type="button" class="btn btn-primary"
                            data-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>
    </div>
@endsection
