<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="noindex, nofollow">
  <title> @yield('pageTitle', 'Home') | {{config('app.name')}}</title>
  <!-- Style Files -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <!-- jQuery and JS bundle w/ Popper.js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600;700;800;900&family=Judson:ital,wght@0,400;0,700;1,400&family=Lato:ital@1&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link href="{{mix('css/app.css')}}" rel="stylesheet" media="all">
  
  <img src="/images/gradient-bg.jpg" class="img-absolute" alt="bg-img">
</head>
<!-- * =============== Header =============== * -->
<header class="site-header">
  <nav class="navbar navbar-expand-lg navbar-dark px-0">
    <a class="navbar-brand" href="/"><img src="/images/wra_logo.svg" alt="wra_logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-header" aria-controls="main-header" aria-expanded="false" aria-label="Toggle navigation">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    <div class="collapse navbar-collapse" id="main-header">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" href="http://example.com" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Enrollment</a>
          <ul class="dropdown-menu" aria-labelledby="dropdown05">
            <li><a class="dropdown-item" href="#">international</a></li>
            <li> <a class="dropdown-item" href="#">graduation</a></li>
            <li> <a class="dropdown-item" href="#">Accreditation</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">our story <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">faq</a>
        </li>
      </ul>
    </div>
    <div class="action-buttons">
      <a href="{{route('register')}}" role="button" class="btn btn-primary">enroll now</a>
      <a href="{{route('login')}}" class="user-login"><img class="o-contain" src="/images/login-img.png" alt=""></a>
    </div>
  </nav>
</header>
<!-- * =============== /Header =============== * -->
