@stack('select2_script')
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
<script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    //parent datatable

    $("#family-table").DataTable({
      "ajax": "{{ route('admin.datatable.parent') }}",
      "processing": true,
      "serverSide": true,
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "columns": [{
          "data": "id",
          "render": function(data, type, row, meta) {
            return meta.row + 1;
          }
        },
        {
          "data": "p1_first_name"
        },
        {
          "data": "country"
        },
        {
          "data": "state"
        },
        {
          "data": "status"
        },
        {
          "data": "created_at"
        },
        {
          "data": "updated_at"
        },
        {
          "data": "id",
          "render": function(id) {
            return `<a href="edit/${id}"><i class="fas fa-edit"></i></a>` +
              `<a href="deactive/${id}"><i class="fas fa-ban"></i></a>` +
              `<a href="delete/parent/${id}"><i class="fas fa-trash-alt"></i></a>`;
          }
        },
        {
          "data": "id",
          "render": function(id) {
            return `<a href="view-student">View Students</a>`;
          }
        },
      ]
    });

    $("#student-table").DataTable({
      "ajax": "{{ route('admin.datatable.student') }}",
      "processing": true,
      "serverSide": true,
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "columns": [{
          "data": "id",
          "render": function(data, type, row, meta) {
            return meta.row + 1;
          }
        },
        {
          "data": "fullname"
        },
        {
          "data": "d_o_b"
        },
        {
          "data": "email"
        },
        {
          "data": "id",
          "render": function(id) {
            return `<a href="edit-student/${id}"><i class="fas fa-edit"></i></a>` +
              `<a href="deactive/${id}"><i class="fas fa-ban"></i></a>` +
              `<a href="delete/${id}"><i class="fas fa-trash-alt"></i></a>`;
          }
        },
        {
          "data": "id",
          "render": function(id) {
            return `<a href="edit-payment/${id}">View Payments</a>`;
          }
        },
        {
          "data": "id",
          "render": function(id) {
            return `<a href="edit-transcript/${id}">Transcripts</a>`;
          }
        },
        {
          "data": "id",
          "render": function(id) {
            return `<a href="graduations/${id}/edit">Graduations</a>`;
          }
        },
      ]
    });
    //name country state active enrolled created modified 
    //coupon datatable
    $("#coupons-table").DataTable({
      "ajax": "{{ route('admin.coupons.dt') }}",
      "processing": true,
      "serverSide": true,
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "columns": [{
          "data": "id",
          "render": function(data, type, row, meta) {
            return meta.row + 1;
          }
        },
        {
          "data": "code"
        },
        {
          "data": "amount"
        },
        {
          "data": "status"
        },
        // { "data": "redeem_left" },
        {
          "data": "expire_at"
        },
        {
          "data": "id",
          "render": function(id) {
            return `<a href="{{ route('admin.view.coupon') }}/${id}/edit">Edit</a>`;
          }
        },
      ]
    });

    $("#graduation-table").DataTable({
      "ajax": "{{ route('admin.graduation.dt') }}",
      "processing": true,
      "serverSide": true,
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "columns": [{
          "data": "id",
          "render": function(data, type, row, meta) {
            return meta.row + 1;
            e
          }
        },
        {
          "data": "student.fullname"
        },
        {
          "data": "student.email"
        },
        {
          "data": "student.birthdate"
        },
        {
          "data": "grade_9_info",
          "render": function(data, type, row, meta) {
            return `
                          <ul>
                            <li>
                                Grade 9 : ${ row.grade_9_info }
                            </li>
                            <li>
                                Grade 10 : ${ row.grade_10_info }
                            </li>
                            <li>
                                Grade 11 : ${ row.grade_11_info }
                            </li>
                          </ul>
                        `;
                    }
          },
          { "data": "apostille_country" },
          { "data": "status" },
          { "data": "id",
            "render": function ( id ) {
                        return `<a href="{{ route('admin.view.graduation') }}/${id}/edit">Edit</a>`;
                      } 
          }
        },
        {
          "data": "status"
        },
        {
          "data": "id",
          "render": function(id) {
            return `<a href="{{ route('admin.view.graduation') }}/${id}/edit">Edit</a>`;
          }
        }
      ]
    });

    $("#generate-code").on('click', function() {
      let _this = $(this);
      let text = _this.text();

      _this.attr('disabled', true);
      _this.text('Generating...');

      $.ajax({
        type: "get",
        url: "{{route('admin.coupons.generate')}}",
        success: function(response) {
          $("#code").val(response);
          _this.attr('disabled', false);
          _this.text(text);
        },
        error: function() {
          _this.attr('disabled', false);
          _this.text(text);
        }
      });
    });

    $('#assign-select').select2({
      placeholder: 'Select Parents to assign Coupon',
      allowClear: true
    });

  });
  $(function() {
    $(".datepicker").datepicker({
      dateFormat: "yy-mm-dd"
    });
    $("#addressData").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>

<!-- ChartJS -->
<script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>
<script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type', 'info') }}";
  switch (type) {
    case 'info':
      toastr.info("{{ Session::get('message') }}");
      break;

    case 'warning':
      toastr.warning("{{ Session::get('message') }}");
      break;

    case 'success':
      toastr.success("{{ Session::get('message') }}");
      break;

    case 'error':
      toastr.error("{{ Session::get('message') }}");
      break;
  }
  @endif
</script>
<!-- DataTables  & Plugins -->