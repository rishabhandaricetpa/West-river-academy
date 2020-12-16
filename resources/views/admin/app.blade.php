<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.partials.header')


        <!-- * =============== NavBar =============== * -->
  @include('admin.layouts.partials.navbar')
  <!-- * =============== /Navbar =============== * -->
    <!-- * =============== Sidebar =============== * -->
  @include('admin.layouts.partials.sidebar')
  <!-- * =============== /Sidebar =============== * -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  @include('admin.layouts.partials.scripts')
</body>

</html>
