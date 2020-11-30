
<!DOCTYPE html>
<html lang="en">
<div class="container">
<body>
  <div id="app" class="app">
    <img src="/images/gradient-bg.jpg" class="img-absolute" alt="bg-img">
    <!-- * =============== Header =============== * -->
    @include('layouts.partials.header')
    <div class="row justify-content-center">
      <div class="col-md-8">
        @include('alert::bootstrap')
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
        <div class="card">
          <div class="card-header">{{ __('Reset Password') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('password.email') }}">
              @csrf

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                         value="{{ old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                  <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>
