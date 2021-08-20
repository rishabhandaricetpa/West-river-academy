<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.partials.header')


        <!-- * =============== NavBar =============== * -->
  @include('admin.layouts.partials.navbar')
  <!-- * =============== /Navbar =============== * -->
    <!-- * =============== Sidebar =============== * -->
    <aside class="main-sidebar pt-1">
    @include('admin.layouts.partials.sidebar')
  </aside>

  <!-- * =============== /Sidebar =============== * -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper admin-wrapper">
  <div class="overlay-black position-absolute main-bg h-100"><img src="/images/gradient-bg.jpg" class="h-100 o-cover" alt="bg-img"></div>
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  @include('admin.layouts.partials.scripts')
</body>

</html>
