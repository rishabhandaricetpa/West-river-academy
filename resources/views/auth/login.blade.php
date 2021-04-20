
<html>
<title> @yield('pageTitle', 'Login') | {{config('app.name')}}</title>
@include('layouts.partials.header')
<!-- * =============== Main =============== * -->
<main class="position-relative container">

  <div class="form-wrap border bg-light form-content small-container">
  @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h2>Log in to My Account</h2>
    <form method="POST" action="{{ route('login') }}" class="mb-0">
      @csrf
      <div class="form-group d-sm-flex mb-2">
        <label for="exampleInputEmail1">Parent 1 Email Address</label>

        <div>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <!--   <div class="alert alert-danger">Enter your user ID.</div> -->
          @include('alert::bootstrap')
          @error('email')
          <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="exampleInputPassword1">Password</label>
        <div>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
          <!--  <div class="alert alert-danger">Enter your password.</div> -->
          @error('password')
          <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </div>
          @enderror
        </div>
      </div>
      <div class="mt-2r">
        <button type="submit" class="btn btn-primary">Sign in</button>
        <a href="{{ route('password.request') }}" class="ml-4">Forgot Password?</a>
      </div>
      <!-- <div class="register-info">Don't have an account yet? <a href="{{route('register')}}">Click this link to create one.</a></div> -->
    </form>
  </div>
</main>
@include('layouts.partials.footer')