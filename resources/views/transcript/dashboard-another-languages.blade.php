@extends('layouts.app')
@section('pageTitle', 'Another')
@section('content')
<main class="position-relative container form-content mt-4 label-styling label-md">
  <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
  <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
    <h3 class="mb-3">Do you want to add another grade level?</h3>
    <!-- <form method="get" class="mb-0" action="{{ route ('download.transcript')}}"> -->
    <!-- @csrf -->
    <div class="form-group mb-2 lato-italic info-detail pb-4 py-2">
      <div class="row ">
        <div class="col-sm-3">
          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 3">
            <label class="form-check-label" for="">
              Yes
            </label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="student_grade" value="Preschool Age 4">
            <label class="form-check-label" for="">
              No
            </label>
          </div>
        </div>
        <div class="col-sm-12">
          <a type="button" href="{{ url ('preview-transcript')}}" class="btn btn-primary">Continue</a>
        </div>
        <!-- </form> -->
      </div>
    </div>
    </form>
</main>
@endsection