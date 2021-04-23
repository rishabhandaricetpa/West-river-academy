<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="noindex, nofollow">
  @include('layouts.partials.styles')
  <title> @yield('pageTitle', 'Home') | {{config('app.name')}}</title>
  <!-- jQuery and JS bundle w/ Popper.js -->

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <div class="overlay-black position-absolute main-bg h-100"><img src="/images/gradient-bg.jpg" class="h-100 o-cover" alt="bg-img"></div>

</head>
<!-- * =============== Header =============== * -->
<header class="site-header">
  <nav class="navbar navbar-expand-lg navbar-dark px-0">
    <a class="navbar-brand" href="{{route('dashboard')}}"><img src="/images/wra_logo.svg" alt="wra_logo"></a>
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

        @if(Auth::id())
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/logout') }}">logout</a>
        </li>
      </ul>
      <div class="action-buttons d-none">
        <a href="{{route('register')}}" role="button" class="btn btn-primary">enroll now</a>
        <a href="{{route('login')}}" class="user-login"><img class="o-contain" src="/images/login-img.png" alt=""></a>
      </div>
      <div id="notification-container">
        <notification-bell></notification-bell>
      </div>
      @else
      <div class="action-buttons">
        <a href="{{route('register')}}" role="button" class="btn btn-primary">enroll now</a>
        <a href="{{route('login')}}" class="user-login"><img class="o-contain" src="/images/login-img.png" alt=""></a>
      </div>
      @endif
    </div>

  </nav>
</header>