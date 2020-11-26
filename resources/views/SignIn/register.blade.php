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
    <main class="position-relative container form-content mt-4">
      <div class="form-wrap border bg-light mb-4">
        <h2 class="text-capitalize">Create Your Account</h2>
        <p>Enter the information below and click “Submit.” An email with a link to activate your account will be sent to the email address you provide. You will then be able to sign in, enroll and purchase other services.</p>
        <div class="register-info">Don't have an account yet? <a href="#">Click this link to create one.</a></div>
      </div>

      <div class="form-wrap border bg-light py-5 px-25">
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div>
            <h2>Create your User ID</h2>

            <div class="form-group d-flex mb-1">
              <label for="">First name</label>
              <div>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">Preferred Nickname</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">Last Name</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">Email Address</label>
              <div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </div>
                @enderror
              </div>

            </div>
            <div class="form-group d-flex mb-1">
              <label for="">Cell Phone</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">Work/Home Phone</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>

          </div>


          <div class="text-center mt-2r">
            <a href="#parent-2info" aria-expanded="false" aria-controls="parent-2info" data-toggle="collapse" class="btn btn-primary">Add Parent 2</a>
          </div>
          <div class="collapse" id="parent-2info">
            <h2>Enter Parent 2 Information</h2>

            <div class="form-group d-flex mb-1">
              <label for="">First name</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">Preferred Nickname</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">Last Name</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">Email Address</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">Cell Phone</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">Work/Home Phone</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>

          </div>
          <div class="mt-2r">
            <h2>Mailing Address</h2>

            <div class="form-group d-flex mb-1">
              <label for="">Street Address</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">city</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">state</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">Zip Code</label>
              <div>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="">country</label>
              <div class="col-4 px-0">
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>united states</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            </div>

          </div>
          <div class="py-5 seperator">
            <label class="h3 w-100">Who referred you to WRA, or how did you learn about us?</label>
            <input type="text" class="form-control" id="" aria-describedby="emailHelp">
          </div>
          <div class="mt-2r">
            <h2>Create your Password using ONLY letters and numbers</h2>

            <div class="form-group d-flex mb-1">
              <label for="exampleInputEmail1">Password</label>
              <div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </div>
                @enderror
              </div>
            </div>
            <div class="form-group d-flex mb-1">
              <label for="exampleInputPassword1">Confirm Password</label>
              <div>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <div class="info-detail mt-3">
                  <p>After activating your account, you will log in.</p>
                  <p>Enter the email address of Parent 1 and your password.</p>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>


    </main>

    <!-- * =============== /Main =============== * -->

    @include('layouts.partials.footer')
</body>

</html>
