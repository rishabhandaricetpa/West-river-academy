<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="noindex, nofollow">
  <title> West River Academy </title>
  <!-- Style Files -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="css/app.css" rel="stylesheet" media="all">
</head>

<body>
  <div id="app" class="app">
    <img src="/images/gradient-bg.jpg" class="img-absolute" alt="bg-img">
    <!-- * =============== Header =============== * -->
    @include('layouts.partials.header')

    <!-- * =============== /Header =============== * -->

    <!-- * =============== Main =============== * -->
    <main class="position-relative container">

      <div class="form-wrap border bg-light form-content">
        <h2>Login to My Account</h2>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group d-flex mb-1">
            <label for="exampleInputEmail1">Email Address</label>

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
          <div class="form-group d-flex mb-1">
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
          <div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('password.request') }}" class="ml-4">Forgot Password?</a>
          </div>
          <div class="register-info">Don't have an account yet? <a href="/registration">Click this link to create one.</a></div>
        </form>
      </div>
    </main>

    <!-- * =============== /Main =============== * -->

    @include('layouts.partials.footer')
</body>

</html>
