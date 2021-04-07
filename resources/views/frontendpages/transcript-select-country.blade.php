@extends('layouts.app')
@section('pageTitle', 'Transcript Details')
@section('content')
<!-- * =============== Main =============== * -->

<main class="position-relative container form-content mt-4 label-styling label-md">
   <h1 class="text-center text-white text-uppercase">enroll students</h1>
   <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
      <form method="POST" class="mb-0" action="">
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
         <div class="form-group mb-2 lato-italic info-detail pb-3 col-sm-6 px-0">
            <h3 class="mb-3">Select the Country where the transcript will be presented.</h3>
            <div class="mb-2">
               <select class="my-1 mr-sm-2 w-100" id="">
                  <option selected>Select Country</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
               </select>
            </div>
         </div>
         <div class="text-center mt-5">
            <a href="select-grade" class="btn btn-primary">Continue</a>
         </div>
      </form>
</main>

@endsection