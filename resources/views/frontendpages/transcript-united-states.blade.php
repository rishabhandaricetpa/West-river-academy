@extends('layouts.app')
@section('pageTitle', 'Transcript Details')
@section('content')
<!-- * =============== Main =============== * -->

<main class="position-relative container form-content mt-4 label-styling label-md">
   <h1 class="text-center text-white text-uppercase">enroll students</h1>
   <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
      <form method="POST" class="mb-0" action="{{ route('enroll') }}">
         @csrf
         <div class="form-group mb-2 lato-italic info-detail pb-4">
            <h3 class="mb-3">Is the transcript going to be presented in the United States?</h3>
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
         <div class="text-center">
            <a href="transcript-select-country" class="btn btn-primary">Continue</a>
         </div>
      </form>
</main>
<!-- * =============== /Main =============== * -->
@endsection