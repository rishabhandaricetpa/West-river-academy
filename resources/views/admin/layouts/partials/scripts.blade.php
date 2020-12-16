@stack('select2_script')
<script src="backend/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="backend/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script src="backend/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="backend/plugins/jszip/jszip.min.js"></script>
  <script src="backend/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="backend/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>

  <!-- ChartJS -->
  <script src="backend/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="backend/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="backend/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="backend/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="backend/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="backend/plugins/moment/moment.min.js"></script>
  <script src="backend/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="backend/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="backend/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="backend/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="backend/dist/js/pages/dashboard.js"></script>
  <!-- DataTables  & Plugins -->
