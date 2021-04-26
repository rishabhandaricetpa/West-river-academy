@extends('layouts.app')
@section('pageTitle', 'Edit & Account')
@section('content')
<!-- * =============== Main =============== * -->
<form method="POST" action="{{route('update.account',$user_id)}}">
  @csrf
  <main class="position-relative container">

    <div class="form-wrap border bg-light form-content small-container">
      <h2>Enter the Login Information below</h2>

      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif
      <div class="form-group d-sm-flex mb-2">
        <label for="">First Name</label>
        <div>
          <input class="form-control " name="first_name" value="{{$parent->p1_first_name}}" required autocomplete="p1_first_name" autofocus>
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Last Name</label>
        <div>
          <input class="form-control " name="last_name" value="{{$parent->p1_last_name}}" required autocomplete="p1_last_name" autofocus>
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Parent 1 Email Address</label>
        <div>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{$parent->p1_email}}" name="email" required autocomplete="p1_email" autofocus>
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Phone Number</label>
        <div>
          <input class="form-control " name="phone" value="{{$parent->p1_cell_phone}}" required autocomplete="p1_cell_phone" autofocus>
          @error('email')
          <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>
      </div>
      <div class="mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </main>
</form>
@endsection