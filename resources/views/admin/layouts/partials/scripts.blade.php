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
<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=mp0jjck0nvualenzblz7ig" async="true"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true
            , "lengthChange": false
            , "ordering": false
            , "pagination": true
            , "autoWidth": false
            , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        //parent datatable
        $("#family-table").DataTable({
            "ajax": "{{ route('admin.datatable.parent') }}"
          
            , "processing": true
            , "serverSide": true
            , "ordering": false
            , "pagination": true
            , "lengthChange": false
            , "responsive": true
            , "lengthChange": false
            , "autoWidth": false
             ,  "dom":"Bfrtip"
            , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "columns": [{
                    "data": "p1_first_name"
                }
                , {
                    "data": "country"
                }
                , {
                    "data": "state"
                }
                , {
                    "data": "status"
                    , "render": function(status) {
                        if (status === 0)
                            return `<td> Active User</td>`;
                        else
                            return `<td> Inactive User </td>`;
                    }
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="edit/${id}"><i class="fas fa-edit"></i></a>` +
                            `<a href="deactive/${id}"><i class="fas fa-ban"></i></a>` +
                            `<a href="delete/parent/${id}"><i class="fas fa-trash-alt"></i></a>`;


                    }
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="view-student/${id}">View Students</a>`;
                    }
                },

            ]
        }).buttons().container().appendTo('#family-table_wrapper .col-md-6:eq(0)');

        //fees -info table
        $("#fees-table").DataTable({
            "ajax": "{{ route('admin.datatable.fees') }}"
             , "dom":"Bfrtip"
            , "processing": true
            , "serverSide": true
            , "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            ,"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "columns": [{
                    "data": "id"
                    , "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                }
                , {
                    "data": "type"
                }
                , {
                    "data": "description"
                }
                , {
                    "data": "amount"
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="{{ route('admin.fees.services')}}/${id}/edit">Edit</a>`;
                    }
                }
            ]
        });



        //country postage
        $("#country_shipping").DataTable({
            "ajax": "{{ route('admin.datatable.shipping') }}"
             , "dom":"Bfrtip"
            , "processing": true
            , "serverSide": true
            , "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            ,"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "columns": [{
                    "data": "country"
                }
                , {
                    "data": "postage_charges"
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="{{ url('admin/country-services')}}/${id}/edit">Edit</a>`;
                    }
                }
            , ]
        });
        //student datatable
        $("#student-table").DataTable({
            "ajax": "{{ route('admin.datatable.student') }}"
              , "dom":"Bfrtip"
            , "processing": true
            , "serverSide": true
            , "responsive": true
            , "lengthChange": false
            , "autoWidth": false
          ,"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "columns": [{
                    "data": "fullname"
                }
                , {
                    "data": "birthdate"
                    , "render": function(data) {
                        return (moment(data).format("MMM DD YYYY"));
                    }
                }
                , {
                    "data": "gender"
                },
                // {
                //   "data": "parent_profile.state"
                // },
                {
                    "data": "parent_profile.country"
                }
                , {
                    "data": "email"
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="edit-student/${id}"><i class="fas fa-edit"></i></a>` +
                            `<a href="delete/${id}"><i class="fas fa-trash-alt"></i></a>`;
                    }
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="edit-payment/${id}">View Payments</a>`;
                    }
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="edit-transcript/${id}">Transcripts</a>`;
                    }
                }
                , {
                    "data": "graduation.id"
                    , "render": function(data) {
                        if (data == null) {
                            return `<label> Not Applied </label>`;
                        } else {
                            return `<a href="graduations/${data}/edit">Graduation</a>`;
                        }
                    }
                }
                , {
                    "data": "record_transfers.id"
                    , "render": function(data) {

                        if (data == null) {
                            return `<label> Not Applied </label>`;
                        } else {
                            return `<a href="student/record/transfer/${data}">Record Transfer</a>`;
                        }
                    }
                }
            , ]
        });

        //coupon datatable
        $("#coupons-table").DataTable({
            "ajax": "{{ route('admin.coupons.dt') }}"
             , "dom":"Bfrtip"
            , "processing": true
            , "serverSide": true
            , "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            , "ordering": false
            ,"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "columns": [{
                    "data": "id"
                    , "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                }
                , {
                    "data": "code"
                }
                , {
                    "data": "amount"
                }
                , {
                    "data": "status"
                },
                // { "data": "redeem_left" },
                {
                    "data": "expire_at"
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="{{ route('admin.view.coupon') }}/${id}/edit">Edit</a>`;
                    }
                }
            , ]
        });

        //graduation datatable
        $("#graduation-table").DataTable({
            "ajax": "{{ route('admin.graduation.dt') }}"
             , "dom":"Bfrtip"
            , "processing": true
            , "serverSide": true
            , "responsive": true
            , "lengthChange": false
            , "autoWidth": false
           ,"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "columns": [{
                    "data": "id"
                    , "render": function(data, type, row, meta) {
                        return meta.row + 1;
                        e
                    }
                }
                , {
                    "data": "student.fullname"
                }
                , {
                    "data": "student.email"
                }
                , {
                    "data": "student.birthdate"
                    , "render": function(data) {
                        return (moment(data).format("MMMM DD YYYY"));
                    }
                }
                , {
                    "data": "grade_9_info"
                    , "render": function(data, type, row, meta) {
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
                }
                , {
                    "data": "apostille_country"
                }
                , {
                    "data": "status"
                    , "render": function(status) {
                        if (status === 'pending')
                            return `<td> Pending</td>`;
                        if (status === 'approved')
                            return `<td> Approved </td>`;
                        if (status === 'paid')
                            return `<td> Paid </td>`;
                        if (status === 'completed')
                            return `<td> Completed </td>`;
                    }
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="{{ route('admin.view.graduation') }}/${id}/edit">Edit</a>`;
                    }
                }
            ]
        });

        //custom payments datatable
        $("#custom-table").DataTable({
            "ajax": "{{ route('admin.datatable.custom') }}"
             , "dom":"Bfrtip"
            , "processing": true
            , "serverSide": true
            , "responsive": true
            , "lengthChange": false
            ,"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "autoWidth": false
            , "columns": [{
                    "data": "parent_profile.p1_first_name"
                }
                , {
                    "data": "amount"
                }
                , {
                    "data": "paying_for"
                }
                , {
                    "data": "transcation_id"
                }
                , {
                    "data": "payment_mode"
                }
                , {
                    "data": "status"
                    , "render": function(status) {
                        if (status === 'pending')
                            return `<td> Pending</td>`;
                        if (status === 'paid')
                            return `<td> Paid </td>`;
                        if (status === 'active')
                            return `<td> Active </td>`;
                    }
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="custom-payments/${id}"><i class="fas fa-edit"></i></a>`;
                    }
                }
            ]
        });
        //order postage payments datatable
        $("#postage-table").DataTable({
            "ajax": "{{ route('admin.datatable.postage') }}"
             , "dom":"Bfrtip"
            , "processing": true
            , "serverSide": true
            , "responsive": true
            , "lengthChange": false
            , "autoWidth": false
             ,"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "columns": [{
                    "data": "parent_profile.p1_first_name"
                }
                , {
                    "data": "amount"
                }
                , {
                    "data": "paying_for"
                }
                , {
                    "data": "transcation_id"
                }
                , {
                    "data": "payment_mode"
                }
                , {
                    "data": "status"
                    , "render": function(status) {
                        if (status === 'pending')
                            return `<td> Pending</td>`;
                        if (status === 'approved')
                            return `<td> Approved </td>`;
                        if (status === 'paid')
                            return `<td> Paid </td>`;
                        if (status === 'completed')
                            return `<td> Completed </td>`;
                    }
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="edit-postage/${id}"><i class="fas fa-edit"></i></a>`;
                    }
                }
            ]
        });
        //notarization and postage
        $("#notarization-table").DataTable({
            "ajax": "{{ route('admin.datatable.notarization') }}"
             , "dom":"Bfrtip"
            , "processing": true
            , "serverSide": true
            , "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            ,"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "columns": [{
                    "data": "parent_profile.p1_first_name"
                }
                , {
                    "data": "amount"
                }
                , {
                    "data": "pay_for"
                }
                , {
                    "data": "transcation_id"
                }
                , {
                    "data": "payment_mode"
                }
                , {
                    "data": "status"
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="edit-notarization/${id}"><i class="fas fa-edit"></i></a>`;
                    }
                }
            ]
        });
        //custom letter payments datatable
        $("#customletter-table").DataTable({
            "ajax": "{{ route('admin.datatable.customletter')}}"
            , "processing": true
             , "dom":"Bfrtip"
            , "serverSide": true
            , "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            ,"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "columns": [{
                    "data": "parent_profile.p1_first_name"
                }
                , {
                    "data": "amount"
                }
                , {
                    "data": "type_of_payment"
                }
                , {
                    "data": "transcation_id"
                }
                , {
                    "data": "payment_mode"
                }
                , {
                    "data": "status"
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="edit-customletter/${id}"><i class="fas fa-edit"></i></a>`;
                    }
                }
            ]
        });
        //Order Cosltation datatable
        $("#orderConsltation-table").DataTable({
            "ajax": "{{ route('admin.datatable.conultation')}}"
            , "processing": true
              , "dom":"Bfrtip"
            , "serverSide": true
            , "responsive": true
            , "lengthChange": false
            , "autoWidth": false
             ,"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "columns": [{
                    "data": "parent.p1_first_name"
                }
                , {
                    "data": "amount"
                }
                , {
                    "data": "type_of_payment"
                }
                , {
                    "data": "transcation_id"
                }
                , {
                    "data": "payment_mode"
                }
                , {
                    "data": "status"
                }
                , {
                    "data": "id"
                    , "render": function(id) {
                        return `<a href="edit-conultation/${id}"><i class="fas fa-edit"></i></a>`;
                    }
                }
            ]
        });
        //generate coupon code

        $("#generate-code").on('click', function() {
            let _this = $(this);
            let text = _this.text();

            _this.attr('disabled', true);
            _this.text('Generating...');

            $.ajax({
                type: "get"
                , url: "{{route('admin.coupons.generate')}}"
                , success: function(response) {
                    $("#code").val(response);
                    _this.attr('disabled', false);
                    _this.text(text);
                }
                , error: function() {
                    _this.attr('disabled', false);
                    _this.text(text);
                }
            });
        });

        $('#assign-select').select2({
            placeholder: 'Select Parents to assign Coupon'
            , allowClear: true
        });

    });

    $(function() {
        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd"
        });
        $("#addressData").DataTable({
            "responsive": true
            , "lengthChange": false
            , "autoWidth": false
        , }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
    // edit Dashboard Record For Super Admin
    function editDashboard(event) {
        var id = $(event).data("id");
        console.log(id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: "{{url('assign/dashboard')}}"
            , type: "POST"
            , data: {
                assign_id: id
            , }
            , success: function(response) {
                if (response) {
                    $("#assigned_to").val(response.assigned_to);
                    $("#notes").val(response.notes);
                    $("#data_id").val(response.id);
                }
            }
        });
    }
    // assign Record of Dashboard For Super Admin
    function assignTo() {
        console.log('created');
        var assignee = $('#assigned_to').val();
        var notes = $('#notes').val();
        var id = $('#data_id').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: "{{url('update/dashboard')}}"
            , type: "POST"
            , data: {
                id: id
                , assigned: assignee
                , notes: notes
            }
            , success: function(response) {
                console.log(response);
            }
            , error: function(response) {

            }
        });
    }
    // provide status for sub admin - completed or pending
    function editDashboardForStatus(event) {
        var id = $(event).data("id");
        console.log(id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: "{{url('assign/status')}}"
            , type: "POST"
            , data: {
                assign_id: id
            , }
            , success: function(response) {
                console.log(response);
                if (response) {
                    $("#task_status").val(response.status);
                    $("#notes").val(response.notes);
                    $("#datarecord_id").val(response.id);
                }
            }
        });
    }
    // update the status for sub admin 

    function updateStatus() {
        console.log('created');
        var assignee = $('#task_status').val();
        var notes = $('#notes').val();
        var id = $('#datarecord_id').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: "{{url('update/record/status')}}"
            , type: "POST"
            , data: {
                id: id
                , assigned: assignee
                , notes: notes
            }
            , success: function(response) {
                console.log(response);
            }
            , error: function(response) {

            }
        });
    }

    // check the archieve status
    function archieve() {
        var checkedTasksId = [];
        $("input:checkbox[name=is_archived]:checked").each(function() {
            checkedTasksId.push($(this).val());
        });
        return checkedTasksId;
    }

    function sendArchieve() {
        var archieve_ids = archieve();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: "{{url('archieve/record')}}"
            , type: "POST"
            , data: {
                id: archieve_ids
            , }
            , success: function(response) {
                location.reload()
                console.log(response);
            }
            , error: function(response) {

            }
        });
    }

</script>



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
