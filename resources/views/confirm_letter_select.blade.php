@extends('layouts.app')
@section('pageTitle', 'Confirmation')
@section('content')
<div class="content-wrapper">
  <main class="position-relative container form-content mt-4">
    <div class="form-wrap border bg-light p-5 mb-4">
      <h2 class="mb-5">What would you like to do?</h2>
      <h3 class="mb-3">Select your Confirmation Letter Options</h3>
      <div class="row">
        <div class="col-12  confirmation-letter__options border-bottom pb-2">
          <div id="app">
            <list-confirmation :student='@json($student)' :gradeid='@json($grade_id)' :student_id='@json($student_id)'
              :confirmationdata='@json($confirmation_data)' :enrollments='@json($enrollments)'
              :countryData='@json($countryData)'></list-confirmation>
          </div>
        </div>
      </div>
    </div>
  </main>

  @endsection
