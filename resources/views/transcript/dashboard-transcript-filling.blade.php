@extends('layouts.app')

@section('content')

<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">dashboard</h1>

  <div class="form-wrap border bg-light py-2r px-25 dashboard-info">
    <form class="mb-0 inner-form-wrapper" method="post" action="{{route('update.studentProfile',$studentProfile->id)}}">
      @csrf
      <div class="form-group d-sm-flex mb-2">
        <label for="exampleInputEmail1">First name</label>

        <div>
          <input type="text" class="form-control " name="first_name" value="{{$studentProfile->first_name}}" required="" autofocus="">
          <!--   <div class="alert alert-danger">Enter your user ID.</div> -->
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Middle Name</label>
        <div>
          <input type="text" class="form-control " name="middle_name" required="" value="{{$studentProfile->middle_name}}" autocomplete="">
          <!--  <div class="alert alert-danger">Enter your password.</div> -->
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Last Name</label>
        <div>
          <input type="text" class="form-control " name="last_name" value="{{$studentProfile->last_name}}" required="" autocomplete="">
          <!--  <div class="alert alert-danger">Enter your password.</div> -->
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Country to present transcript</label>
        <div>
          <select name="country" class="form-select w-100 form-control" aria-label="Default select example">
            <option value="United States" name="country">United States</option>
            @foreach($countries as $country)
            <option name="country" value="{{$country->country}}">{{$country->country}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="text-left">
        <a href="#HelpmeDecide" class="btn btn-primary" data-toggle="modal">Help me decide</a>
      </div>
      <div class="mt-5 text-center">
        <button type="submit" class="btn btn-primary">Continue</button>
      </div>
      <!-- <div class="register-info">Don't have an account yet? <a href="http://127.0.0.1:8000/register">Click this link to create one.</a></div> -->
    </form>
  </div>
</main>
<!-- Choose Dates -->
<div class="modal fade" id="HelpmeDecide" tabindex="-1" aria-labelledby="HelpmeDecideLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
        <p>Select the country where the transcript will be used. It may be a country other than where you live.</p>
        <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></div>
      </div>
    </div>
  </div>
</div>
@endsection