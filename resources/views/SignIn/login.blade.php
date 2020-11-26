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
        <form>
          <div class="form-group d-flex mb-1">
            <label for="exampleInputEmail1">Email Address</label>
            <div>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <!--   <div class="alert alert-danger">Enter your user ID.</div> -->
            </div>
          </div>
          <div class="form-group d-flex mb-1">
            <label for="exampleInputPassword1">Password</label>
            <div>
              <input type="password" class="form-control" id="exampleInputPassword1">
              <!--  <div class="alert alert-danger">Enter your password.</div> -->
            </div>
          </div>
          <div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="#" class="ml-4">Forgot Password?</a>
          </div>
          <div class="register-info">Don't have an account yet? <a href="#">Click this link to create one.</a></div>
        </form>
      </div>
    </main>

    <!-- * =============== /Main =============== * -->

    @include('layouts.partials.footer')
</body>

</html>
