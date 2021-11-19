@extends('layouts.app')
@section('pageTitle', 'AP Course')
@section('content')

    <div id="app">
        <main class="position-relative container form-content mt-4">
            <h1 class="text-center text-white text-uppercase">TRANSCRIPT WIZARD</h1>
            <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
                <div class="d-flex">
                    <h3 class="mb-3">Did you take any AP courses and pass the AP Test?</h3>
                    <a href="#HelpmeDecide" data-toggle="modal" role="button" class="btn btn-primary ml-auto">Help me
                        Decide</a>
                </div>
                <div>
                    <a data-toggle="collapse" href="#ap-courses" role="button" aria-expanded="false"
                        aria-controls="ap-courses" class="btn btn-primary px-2r py-1">yes</a>
                    <a href="{{ route('english.transcript.course', [$student_id, $transcript_id]) }}" role="button"
                        class="btn btn-primary px-2r py-1 ml-4">no</a>
                </div>
                <ap-course :transcript_id='@json($transcript_id)' :student_id='@json($student_id)'
                    :all_credits='@json($all_credits)' :trans_id='@json($trans_id)'></ap-course>
            </div>


        </main>
        <!-- Help me decide -->
        <div class="modal fade" id="HelpmeDecide" tabindex="-1" aria-labelledby="HelpmeDecideLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>AP means Advanced Placement. To put AP in front of a course name, you must have taken and passed
                            with a grade of A, B or C an actual AP course listed on this website:
                            <a href='https://apstudents.collegeboard.org/course-index-page'>
                                https://apstudents.collegeboard.org/course-index-page</a>
                        </p>
                        <p>Enter the exact name of the course and the grade you received. You will need to show us proof of
                            taking and passing the course.</p>
                        <div class="text-right mt-3"><button type="button" class="btn btn-primary"
                                data-dismiss="modal">Close</button></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * =============== /Main =============== * -->
    @endsection
