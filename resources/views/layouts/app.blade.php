<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="strict-origin-when-cross-origin" name="referrer">

  <title>@yield('pageTitle', 'Home') | {{config('app.name')}}</title>

  @include('layouts.partials.styles')
  @php
    $appConfig = [
      'csrfToken' => csrf_token(),
      'env' => config('app.env'),
      'user'=> ['id' => auth()->id()],
    ];
  @endphp
  <script>
    window.appConfig = @json($appConfig)
  </script>
  @stack('after_app_config_script')
</head>
<body class="bg-light {{'env-'.config('app.env')}} @yield('bodyClass')">
  <div id="app" class="app">
  @include('layouts.partials.navbar')
    <!-- Main content starts -->
    <main class="main mt-3 mb-4" id="main" role="main">
      @yield('content')
    </main>
    @include('layouts.partials.footer')
  </div>
@include('layouts.partials.scripts')
</body>
</html>
