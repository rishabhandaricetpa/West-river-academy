<!-- * =============== Header =============== * -->
<title> @yield('pageTitle', 'Thankyou') | {{config('app.name')}}</title>
@include('layouts.partials.header')

<!-- * =============== /Header =============== * -->

<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
  <div class="form-wrap border bg-light form-content small-container">
    <h2 class="text-capitalize">Thank you!</h2>
    <p class="mb-0">We sent an email to "{{$user->email ?? ''}}" from "contact@westriveracademy.com". Please check your spam folder if the email does not apper. Click on the activation
      link in the email. You will then be able to sign in, enroll and purchase other services.</p>
  </div>
</main>

<!-- * =============== /Main =============== * -->

@include('layouts.partials.footer')