@extends('layouts.app')
@section('pageTitle', 'Resend Verification')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @include('alert::bootstrap')

        <div class="card">
          <div class="card-header">{{ __('Resend Email Eerification') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('verification.resend') }}">
              @csrf

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                         value="{{ old('email') }}" required autocomplete="email" autofocus
                         placeholder="Enter your registered email address">

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
                    {{ __('Send Email Verification') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
