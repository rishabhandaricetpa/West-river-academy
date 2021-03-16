@extends('layouts.app')
@section('pageTitle', 'Transcript Years')
@section('content')
<main class="position-relative container form-content mt-4 label-styling label-md">
  <h1 class="text-center text-white text-uppercase">enroll students</h1>
  <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
    <form method="post" class="mb-0" action="{{route('update.enrollYear',[$id,$transcript->id])}}">
      @csrf
      <div class="form-group mb-2 lato-italic info-detail pb-4">
        <input type="hidden" name="transcript_id" value="{{$transcript->id}}">
        <h3 class="mb-3">Select the year for this grade. It must be a year that you were either enrolled in West River Academy or you have provided a transcript from another school.</h3>
        @foreach ($result as $year)
        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" value="{{$year}}-{{$year+1}}" name="enrollment_year">
          <label class="form-check-label" for="">
            {{$year}}-{{$year+1}}
          </label>
        </div>
        @endforeach
        Choose Other Year <input type="text" name="other_year">
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary" data-dismiss="modal">Continue</button>
      </div>
    </form>
</main>
@endsection