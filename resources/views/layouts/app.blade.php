<div class="d-flex">
  <!-- * =============== Sidebar =============== * -->
  @include('layouts.partials.sidebar')
  <!-- * =============== /Sidebar =============== * -->

  <div class="main-content position-relative ml-auto">
    <title> @yield('pageTitle', 'Enroll Students') | {{config('app.name')}}</title>
    <!-- <sup>*</sup> =============== Header =============== <sup>*</sup> -->
    @include('layouts.partials.header')

    <!-- <sup>*</sup> =============== /Header =============== <sup>*</sup> -->

    <!-- * =============== Main =============== * -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  @include('layouts.partials.footer')
  </div>

</div>
</body>

</html>
