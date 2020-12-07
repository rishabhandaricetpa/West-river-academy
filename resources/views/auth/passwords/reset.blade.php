<!-- * =============== Header =============== * -->
<title> @yield('pageTitle', 'Reset Password') | {{config('app.name')}}</title>
@include('layouts.partials.header')
<!-- * =============== /Header =============== * -->

<!-- * =============== Main =============== * -->
<main class="position-relative container">
  <div class="form-wrap border bg-light form-content small-container">
    <h2>Update your password</h2>
    <form method="post" action="{{ route('password.update') }}">
      @csrf

      <input type="hidden" name="token" value="{{ $token }}">
      <div class="form-group d-flex mb-2 seperator">
        <label for="">Email Address</label>
        <div>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

          @error('email')
          <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>
      </div>
      <div class="form-group d-flex mb-2 mt-2r">
        <label for="">New Password</label>
        <div>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
      </div>
      <div class="mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</main>

<!-- * =============== /Main =============== * -->
@include('layouts.partials.footer')

