<div class="d-flex">
    <!-- * =============== Sidebar =============== * -->
    <!-- * =============== /Sidebar =============== * -->

    <div class="main-content position-relative ml-auto">
        <title> @yield('pageTitle') | {{ config('app.name') }}</title>
        <!-- <sup>*</sup> =============== Header =============== <sup>*</sup> -->
        @include('layouts.partials.header')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('layouts.partials.sidebar')
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.partials.sidebar')

        <!-- Control Sidebar -->
        @include('layouts.partials.footer')
    </div>

</div>
</body>

</html>
