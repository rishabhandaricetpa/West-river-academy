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
        <form method="post" class="row" action="{{ route('update.welcomestatus', $parent_data->id) }}">
            @csrf
            <div class="checkbox">
                <label class="sSame">
                    <input type='checkbox' name='checkbox' onChange='submit();'>Skip Video
                </label>

            </div>
            <div class="mt-4 text-right">
                <a href="{{ url('/enroll-student') }}" class="btn btn-secondary">next</a>
            </div>
        </form>
    </div>
</main>

<!-- * =============== /Main =============== * -->

@include('layouts.partials.footer')
