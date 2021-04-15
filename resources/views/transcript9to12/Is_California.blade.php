@extends('layouts.app')
@section('pageTitle', 'Transcript_deatils')
@section('content')
<main class="position-relative container form-content mt-4 label-styling label-md">
   <h1 class="text-center text-white text-uppercase">enroll students</h1>
   <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
      <form method="POST" class="mb-0" action="{{route('select.grade',$student_id)}}">
         @csrf
         <div class="form-group mb-2 lato-italic info-detail pb-4">
            <h3 class="mb-3">Is the transcript going to be presented in the United States?</h3>
            <input type="hidden" value="{{$transcript->id}}" name="transcript_id">
            <div class="form-check mb-2">
               <input class="form-check-input" type="radio" name="is_united_states" value="Yes" id="transcript-country">
               <label class="form-check-label" for="">
                  Yes
               </label>
            </div>
            <div class="form-check mb-2">
               <input class="form-check-input" type="radio" name="is_united_states" value="No" id="transcript-present">
               <label class="form-check-label" for="">
                  No
               </label>
            </div>
         </div>
         <div class="form-group mb-2 lato-italic info-detail pb-3 collapse transcript-detail">
            <h3 class="mb-3">Is the transcript going to be presented in California ?</h3>
            <div class="form-check mb-2">
               <input class="form-check-input" type="radio" name="is_california" value="Yes">
               <label class="form-check-label" for="">
                  Yes
               </label>
            </div>
            <div class="form-check mb-2">
               <input class="form-check-input" type="radio" name="is_california" value="No">
               <label class="form-check-label" for="">
                  No
               </label>
            </div>
         </div>
         <div class="form-group mb-2 lato-italic info-detail pb-3 collapse present-detail">
            <h3 class="mb-3">Select the Country where the transcript will be presented.</h3>
            <div class="form-group px-0 col-md-7">
               <select class="form-control text-uppercase" name="select_country">
                  <option value="">Please select one</option>
                  @foreach($countries as $country)
                  <option value="{{$country->country}}">
                     {{$country->country}}
                  </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="text-center">
            <button type="submit" class="btn btn-primary">Continue</button>
         </div>
      </form>
</main>
@endsection