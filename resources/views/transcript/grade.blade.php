@extends('layouts.app')
@section('pageTitle', 'Grade & School')

@section('content')
    <main class="position-relative container form-content mt-4 label-styling label-md">
        <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
        <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
            <h3 class="mb-3">Select a grade to put on your transcript:</h3>
            <form method="POST" class="mb-0" action="{{ route('transcript.grade', $student->id) }}">
                @csrf
                <div class="form-group mb-2 lato-italic info-detail pb-4">
                    <div class="row ">
                        <div class="col-sm-3">
                            <div class="form-check">
                                <input type="hidden" name="transcript_id" value="{{ $transcript->id }}">
                                <input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 3"
                                    required>
                                <label class="form-check-label" for="">
                                    Preschool Age 3
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 4">
                                <label class="form-check-label" for="">
                                    Preschool Age 4
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="student_grade" value="Kindergarten">
                                <label class="form-check-label" for="">
                                    Kindergarten
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="student_grade" value="1">
                                <label class="form-check-label" for="">
                                    1
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="student_grade" value="2">
                                <label class="form-check-label" for="">
                                    2
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="student_grade" value="3">
                                <label class="form-check-label" for="">
                                    3
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="student_grade" value="4">
                                <label class="form-check-label" for="">
                                    4
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="student_grade" value="5">
                                <label class="form-check-label" for="">
                                    5
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="student_grade" value="6">
                                <label class="form-check-label" for="">
                                    6
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="student_grade" value="7">
                                <label class="form-check-label" for="">
                                    7
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="student_grade" value="8">
                                <label class="form-check-label" for="">
                                    8
                                </label>
                            </div>
                        </div>
                    </div>
                    <h3 class="mb-3 mt-4">Where were you enrolled for this grade?</h3>
                    <div class="col-sm-6 px-0">
                        <div class="form-group d-sm-flex mb-2 form-check">
                            <input class="form-check-input" type="radio" id="wra_school" name="school_name"
                                value="West River Academy" required>
                            <label class="form-check-label" for="">
                                West River Academy
                            </label>
                        </div>
                        <div class="form-group d-sm-flex mb-2 form-check">
                            <input class="form-check-input " type="radio" id="other_school_name" name="school_name"
                                value="Others">
                            <label class="form-check-label" for="">
                                Other: Full Name of School
                            </label>
                            <div>
                                <input type="text" class="form-control other " id="other_school" name="other_school"
                                    autocomplete="">
                            </div>
                        </div>
                    </div>
                    <div class="info-detail mt-4">
                        <p>Note: Courses and grades must match exactly the transcript we have on file from the other school.
                        </p>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>
            </form>
    </main>
@endsection
