<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="noindex, nofollow">
  <title> Update Pwd </title>
  <!-- Style Files -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="css/app.css" rel="stylesheet" media="all">
</head>

<body>
  <div id="app" class="app">
    <img src="https://www.westriveracademy.com/cwp/img/banner.jpg" class="img-absolute" alt="bg-img">
    <!-- * =============== Header =============== * -->
    <header class="site-header">
      <nav class="navbar navbar-expand-lg navbar-dark p-0">
        <a class="navbar-brand" href="/"><img src="https://www.westriveracademy.com/cwp/img/wra_logo.svg" alt="wra_logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-header" aria-controls="main-header" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-header">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Enrollment</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown05">
                <li><a class="dropdown-item" href="#">international</a></li>
                <li> <a class="dropdown-item" href="#">graduation</a></li>
                <li> <a class="dropdown-item" href="#">Accreditation</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">our story <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">blog</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown05">
                <li><a class="dropdown-item" href="#">What Parents | Students Say</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">faq</a>
            </li>
          </ul>
        </div>
        <div>
          <a href="#" role="button" class="btn btn-primary">enroll now</a>
          <a href="#" class="user-login"><img class="o-contain" src="https://www.westriveracademy.com/cwp/img/login-img.png" alt=""></a>
        </div>
      </nav>
    </header>
    <!-- * =============== /Header =============== * -->

    <!-- * =============== Main =============== * -->
    <main class="position-relative container">
      <div class="form-wrap border bg-light form-content small-container">
        <h2>Update your password</h2>
        <form>
          <div class="form-group d-flex mb-1 seperator">
            <label for="">Old Password</label>
            <div>
              <input type="text" class="form-control" id="" aria-describedby="emailHelp">
            </div>
          </div>
          <div class="form-group d-flex mb-1 mt-2r">
            <label for="">New Password</label>
            <div>
              <input type="password" class="form-control" id="">
            </div>
          </div>
          <div class="form-group d-flex mb-1">
            <label for="">Confirm Password</label>
            <div>
              <input type="password" class="form-control" id="">
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </main>

    <!-- * =============== /Main =============== * -->

    <footer class="bg-dark position-relative text-center main-footer">
      <div class="container">
        <ul class="social-icons list-unstyled d-flex justify-content-center">
          <li><a href="#" class="mx-2"><i class="fab fa-facebook"></i></a></li>
          <li><a href="#" class="mx-2"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#" class="mx-2"><i class="fab fa-pinterest"></i></a></li>
          <li><a href="#" class="mx-2"><i class="fab fa-linkedin"></i></a></li>
          <li><a href="#" class="mx-2"><i class="fab fa-instagram-square"></i></a></li>
        </ul>
        <a href="#" role="button" class="btn btn-secondary text-uppercase mt-4 mb-3">contact us</a>
        <ul class="list-unstyled">
          <li><a href=""><i class="fas fa-phone-alt mr-2"></i>949 - 492 - 5240</a></li>
          <li><a href="#"><i class="fas fa-envelope mr-2"></i>contact@westriveracademy.com</a></li>
        </ul>
        <div class="copyright">
          Copyright © 2020 West River Academy.
          <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
          <a href="#" class="d-block">Website design, development and maintenance by eXcelisys, Inc.</a>
        </div>
      </div>
    </footer>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/app.js" async></script>
  <!-- Footer scripts -->
  @stack('before_vendor_scripts')
  <script defer src="{{ mix('js/manifest.js') }}"></script>
  <script defer src="{{ mix('js/vendor.js') }}"></script>
  @stack('after_vendor_scripts')
  @stack('before_app_scripts')
  <script defer async src="{{ mix('js/app.js') }}"></script>
  @stack('after_app_scripts')
</body>

</html>
