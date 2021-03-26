@extends('layouts.app')
@section('pageTitle', 'Another')
@section('content')
<main class="position-relative container form-content mt-4 label-styling label-md">
   <h1 class="text-center text-white text-uppercase">enroll students</h1>
   <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
      <h3 class="mb-3">Do you want to add another grade level?</h3>
      <form method="post" class="mb-0" action="{{route('another-transcript9_12.required')}}">
         @csrf
         <div class="form-group mb-2 lato-italic info-detail pb-4 py-2">
            <div class="row ">
               <div class="col-sm-3">
                  <div class="form-check mb-2">
                     <input class="form-check-input" type="radio" name="another_grade" value="Yes">
                     <label class="form-check-label" for="">
                        Yes
                     </label>
                     <input type="hidden" name="student_id" value="{{$student_id}}">
                     <input type="hidden" name="trans_id" value="{{$trans_id}}">
                     <input type="hidden" name="transcript9_12id" value="{{$transcript9_12_id}}">
                  </div>
                  <div class="form-check mb-2">
                     <input class="form-check-input" type="radio" name="another_grade" value="No">
                     <label class="form-check-label" for="">
                        No
                     </label>
                  </div>
               </div>
               <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary">Continue</button>
               </div>
               <!-- </form> -->
            </div>
         </div>
      </form>
</main>
@endsection