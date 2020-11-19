<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="strict-origin-when-cross-origin" name="referrer">

  <title>@yield('pageTitle', 'Home') | {{config('app.name')}}</title>

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,700,700i&display=swap" rel="stylesheet"
        crossorigin>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin>
  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.14/css/all.css" rel="stylesheet" crossorigin>
  <style>
    body {
      font-family: 'Nunito', var(--font-family-sans-serif);
    }
  </style>
</head>
<body class="bg-light {{'env-'.config('app.env')}} @yield('bodyClass')">
<div id="app" class="app">
  <main class="container main" id="main" role="main">
    @yield('content')
  </main>
</div>
</body>
</html>
