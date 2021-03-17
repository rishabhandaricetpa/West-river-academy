@extends('layouts.app')
@section('pageTitle', 'Reset Password')
@section('content')

<main class="position-relative container">
  <div class="form-wrap border bg-light form-content small-container">
    <h2>Update your password</h2>
    <form method="post" action="{{ route('account-pass.update',Auth::user()->id) }}">
      @csrf
      <div class="form-group d-flex mb-2 seperator">
        <label for="">Old Password</label>
        <div>
          <input id="password" type="password" class="form-control  @error('old_password') is-invalid @enderror" name="old_password" autocomplete="email" autofocus>
          @error('old_password')
          <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>
      </div>
      <div class="form-group d-flex mb-2 mt-2r">
        <label for="">New Password</label>
        <div>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="new_password" required autocomplete="new-password">

          @error('password')
          <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>
      </div>
      <div class="form-group d-flex mb-2">
        <label for="">Confirm Password</label>
        <div>
          <input id="password-confirm" type="password" class="form-control" name="confirm_password" required autocomplete="new-password">
        </div>
      </div>
      <div class="mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</main>



@endsection