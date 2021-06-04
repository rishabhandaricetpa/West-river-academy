@extends('layouts.app')
@section('pageTitle', 'Enroll Students')
@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">enroll students</h1>

    <div class="form-wrap border bg-light py-5 px-25">
        <h2>Edit Student</h2>
        <div id="app">
            <edit-enroll :semesters='@json($countryData)' :date_of_birth='@json($birth)' :students='@json($studentData)' :periods='@json($enrollPeriods)' :semmonth='@json($semestermonth)' :countryname='@json($country_name)'></edit-enroll>
        </div>
</main>
<!-- Choose Dates -->
<div class="modal fade" id="chooseDates" tabindex="-1" aria-labelledby="chooseDatesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <p>Annual enrollment covers the 12 months from
                    {{ Carbon\Carbon::parse($countryData->start_date)->format('F j') }} -
                    {{ Carbon\Carbon::parse($countryData->end_date)->format('F j') }}.
                    Second Semester Only covers {{ Carbon\Carbon::parse($semestermonth)->format('F j') }} -
                    {{ Carbon\Carbon::parse($countryData->end_date)->format('F j') }}.
                    You can enter an earlier date to end your own academic year.That date will appear on your
                    Confirmation of Enrollment letter.
                </p>
                <p>
                    Regardless of the date you select, your enrollment will include the full 12-month period for Annual
                    or the full 7-month
                    period for Second Semester Only.</p>
                <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
</div>
<!-- Skip Year -->
<div class="modal fade" id="skipYear" tabindex="-1" aria-labelledby="skipYearLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <p>If you need to enroll for 2 periods that are not consecutive, complete the first enrollment period
                    and then click on Add Another Enrollment Period at the bottom of this form.
                </p>
                <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
</div>
<!-- Choose more grade -->
<div class="modal fade" id="chooseGrade" tabindex="-1" aria-labelledby="chooseGradeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="text-center mb-4">For NEW high school students grades 10, 11 and 12</h3>
                <p>
                    If you are newly enrolling in West River Academy for grades 10, 11 or 12, you will need to provide
                    transcripts issued from a public or private school for your previous high school years in order for
                    us to issue a complete high school transcript if you transfer out of West River Academy or when you
                    graduate. If transcripts cannot be provided, you will need to enroll with us for those years. Please
                    indicate that you understand this policy by checking the box below:
                </p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="student_grade" id="" value="10">
                    <label class="form-check-label w-100" for="">
                        I understand that by enrolling in West River Academy for grade 10, 11 or 12, I agree to provide
                        transcripts from a previous school or to enroll in West River Academy for previous years before
                        enrolling in the Graduation Program or requesting a high school transcript to transfer out of
                        West River Academy to another school.
                    </label>
                </div>
                <div class="text-right mt-3">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary ml-3" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * =============== /Main =============== * -->
@endsection
