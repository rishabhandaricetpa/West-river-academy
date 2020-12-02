<!-- * =============== Header =============== * -->
<title> @yield('pageTitle', 'Forgot Password') | {{config('app.name')}}</title>
@include('layouts.partials.header')
<!-- * =============== /Header =============== * -->

<!-- * =============== Main =============== * -->
<form method="POST" action="{{route('password.email')}}">
  @csrf
  <main class="position-relative container">

    <div class="form-wrap border bg-light form-content small-container">
      <h2>Reset Your Password</h2>
      <p>Enter your parent 1 email address and click the submit button. You will be sent an email with a link to reset your password.</p>
      @include('alert::bootstrap')
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif
      <div class="form-group d-flex mb-1">

        <label for="">Parent 1 Email Address</label>
        <div>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
<!-- * =============== /Main =============== * -->

@include('layouts.partials.footer')
</body>

</html>
