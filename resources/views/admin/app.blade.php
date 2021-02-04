<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.partials.header')


        <!-- * =============== NavBar =============== * -->
  @include('admin.layouts.partials.navbar')
  <!-- * =============== /Navbar =============== * -->
    <!-- * =============== Sidebar =============== * -->
    <aside class="main-sidebar">
  @include('admin.layouts.partials.sidebar')
  </aside>

  <!-- * =============== /Sidebar =============== * -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper admin-wrapper">
  <img src="/images/gradient-bg.jpg" class="img-absolute" alt="bg-img">
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
