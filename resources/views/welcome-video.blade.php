<!-- * =============== Header =============== * -->
<title> @yield('pageTitle', 'Login') | {{ config('app.name') }}</title>
@include('layouts.partials.header')

<!-- * =============== /Header =============== * -->

<!-- * =============== Main =============== * -->
<main class="position-relative container">

    <div class="form-content">
        <div class="border bg-light form-wrap">
            <h2 class="mb-3">Welcome to West River Academy!</h2>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="images/WelcomeVideo.mp4" allowfullscreen></iframe>
            </div>
        </div>
        <div class="mt-4 text-right">
            <a href="{{ route('update.welcomestatus', $parentData->id) }}"
                class="btn btn-secondary float-right">next</a>
        </div>
    </div>
</main>

<!-- * =============== /Main =============== * -->

@include('layouts.partials.footer')
