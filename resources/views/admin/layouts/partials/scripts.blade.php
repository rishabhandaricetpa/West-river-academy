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
<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=mp0jjck0nvualenzblz7ig" async="true">
</script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "ordering": false,
            "pagination": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        //parent datatable
        $("#family-table").DataTable({
            "ajax": "{{ route('admin.datatable.parent') }}"

                ,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "pagination": true,
            "lengthChange": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "dom": "Bfrtip",
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "columns": [{
                    "data": function(row, type, val, meta) {
                        return `<a href="edit/${row.id}">${row.p1_first_name}</a>`
                    },
                },
                {
                    "data": function(row, type, val, meta) {
                        return row.p1_email
                    },
                    defaultContent: '',
                    "render": function(data) {
                        if (data === null) {
                            return `<label> </label>`;
                        } else {
                            return `<a class="transform-none" href="mailto:${data}">${data}</a>`;
                        }
                    }
                },
                {
                    "data": "country"
                }, {
                    "data": "state"
                }, {
                    "data": "status",
                    "render": function(status) {
                        if (status === 0)
                            return `<td> Active</td>`;
                        else
                            return `<td> Inactive</td>`;
                    }
                },
                {
                    "data": "student_profile.length"
                },
                {
                    "data": "created_at",
                    "render": function(data) {
                        return (moment(data).format("LL"));
                    }
                },

            ]
        }).buttons().container().appendTo('#family-table_wrapper .col-md-6:eq(0)');

        //fees -info table
        $("#fees-table").DataTable({
            "ajax": "{{ route('admin.datatable.fees') }}",
            "dom": "Bfrtip",
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "columns": [{
                "data": "id",
                "render": function(data, type, row, meta) {
                    return meta.row + 1;
                }
            }, {
                "data": "description"
            }, {
                "data": "amount"
            }, {
                "data": "id",
                "render": function(id) {
                    return `<a href="{{ route('admin.fees.services') }}/${id}/edit">Edit</a>`;
                }
            }]
        });



        //country postage
        $("#country_shipping").DataTable({
            "ajax": "{{ route('admin.datatable.shipping') }}",
            "dom": "Bfrtip",
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "columns": [{
                "data": "country"
            }, {
                "data": "postage_charges"
            }, {
                "data": "id",
                "render": function(id) {
                    return `<a href="{{ url('admin/country-services') }}/${id}/edit">Edit</a>`;
                }
            }, ]
        });
        //student datatable
        $("#student-table").DataTable({
            "ajax": "{{ route('admin.datatable.student.data') }}",
            "dom": "Bfrtip",
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ordering": false,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "columns": [{
                    "data": function(row, type, val, meta) {
                        return `<a href="edit-student/${row.id}">${row.fullname}</a>`
                    },
                }, {
                    "data": "birthdate",
                    "render": function(data) {
                        return (moment(data).format("LL"));
                    }
                }, {
                    "data": "gender"
                },
                // {
                //   "data": "parent_profile.state"
                // },
                {
                    "data": "parent_profile.country"
                }, {
                    "data": function(row, type, val, meta) {
                        return row.email
                    },
                    defaultContent: '',
                    "render": function(data) {
                        if (data === null) {
                            return `<label> </label>`;
                        } else {
                            return `<a class="transform-none" href="mailto:${data}">${data}</a>`;
                        }
                    }
                }, {
                    "data": "id",
                    "render": function(id) {
                        return `<a href="delete/${id}"><i class="fas fa-trash-alt"></i></a>`;
                    }
                }, {
                    "data": "id",
                    "render": function(id) {
                        return `<a href="edit-payment/${id}">View Payments</a>`;
                    }
                }, {
                    "data": "id",
                    "render": function(id) {
                        return `<a href="edit-transcript/${id}">Transcripts</a>`;
                    }
                }, {

                    "data": function(row, type, val, meta) {
                        return row.graduation?.id
                    },
                    defaultContent: '',
                    "render": function(data) {

                        if (data == null) {
                            return `<label> Not Applied </label>`;
                        } else {
                            return `<a href="graduations/${data}/edit">Graduation</a>`;
                        }
                    }
                }, {

                    "data": function(row, type, val, meta) {
                        return row.record_transfers?.id
                    },
                    defaultContent: '',
                    "render": function(data) {

                        if (data == null) {
                            return `<label> Not Applied </label>`;
                        } else {
                            return `<a href="student/record/transfer/${data}">Record Transfer</a>`;
                        }
                    }
                },
                {
                    "data": "id",
                    "render": function(data) {

                        if (data == null) {
                            return `<label> Not Applied </label>`;
                        } else {
                            return `<a href="view-documents/${data}">View</a>`;
                        }
                    }
                },
                {
                    "data": "id",
                    "render": function(data) {

                        if (data == null) {
                            return `<label> Not Applied </label>`;
                        } else {
                            return `<a href="edit-upload/${data}">Upload</a>`;
                        }
                    }
                },
            ]
        });

        //coupon datatable
        $("#coupons-table").DataTable({
            "ajax": "{{ route('admin.coupons.dt') }}",
            "dom": "Bfrtip",
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "columns": [{
                    "data": "id",
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                }, {
                    "data": "code"
                }, {
                    "data": "amount"
                }, {
                    "data": "status"
                },
                // { "data": "redeem_left" },
                {
                    "data": "expire_at",
                    "render": function(data) {
                        return (moment(data).format("LL"));
                    }
                }, {
                    "data": "id",
                    "render": function(id) {
                        return `<a href="{{ route('admin.view.coupon') }}/${id}/edit">Edit</a>`;
                    }
                },
            ]
        });

        //graduation datatable
        $("#graduation-table").DataTable({
            "ajax": "{{ route('admin.graduation.dt') }}",
            "dom": "Bfrtip",
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "columns": [{
                "data": "id",
                "render": function(data, type, row, meta) {
                    return meta.row + 1;
                    e
                }
            }, {
                "data": "student.fullname"
            }, {
                "data": function(row, type, val, meta) {
                    return row.student.email
                },
                defaultContent: '',
                "render": function(data) {
                    if (data === null) {
                        return `<label> </label>`;
                    } else {
                        return `<a  class="transform-none" href="mailto:${data}">${data}</a>`;
                    }
                }
            }, {
                "data": "student.birthdate",
                "render": function(data) {
                    return (moment(data).format("LL"));
                }
            }, {
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
            }, {
                "data": "apostille_country"
            }, {
                "data": "status",
                "render": function(status) {
                    if (status === 'pending')
                        return `<td> Pending</td>`;
                    if (status === 'approved')
                        return `<td> Approved </td>`;
                    if (status === 'paid')
                        return `<td> Paid </td>`;
                    if (status === 'completed')
                        return `<td> Completed </td>`;
                }
            }, {
                "data": "id",
                "render": function(id) {
                    return `<a href="{{ route('admin.view.graduation') }}/${id}/edit">Edit</a>`;
                }
            }]
        });

        //custom payments datatable
        $("#custom-table").DataTable({
            "ajax": "{{ route('admin.datatable.custom') }}",
            "dom": "Bfrtip",
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ordering": false,
            "lengthChange": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "autoWidth": false,
            "columns": [{
                "data": "parent_profile.p1_first_name"
            }, {
                "data": "amount"
            }, {
                "data": "paying_for"
            }, {
                "data": "transcation_id"
            }, {
                "data": "payment_mode"
            }, {
                "data": "status",
                "render": function(status) {
                    if (status === 'pending')
                        return `<td> Pending</td>`;
                    if (status === 'paid')
                        return `<td> Paid </td>`;
                }
            }, {
                "data": "id",
                "render": function(id) {
                    return `<a href="custom-payments/${id}"><i class="fas fa-edit"></i></a>`;
                }
            }]
        });
        //order postage payments datatable
        $("#postage-table").DataTable({
            "ajax": "{{ route('admin.datatable.postage') }}",
            "dom": "Bfrtip",
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "columns": [{
                "data": "parent_profile.p1_first_name"
            }, {
                "data": "amount"
            }, {
                "data": "paying_for"
            }, {
                "data": "transcation_id"
            }, {
                "data": "payment_mode"
            }, {
                "data": function(row, type, val, meta) {
                    return row.status
                },
                defaultContent: '',
                "render": function(data) {
                    if (data === 'pending')
                        return `<td> Pending</td>`;
                    if (data === 'paid')
                        return `<td> Paid </td>`;
                }
            }, {
                "data": "id",
                "render": function(id) {
                    return `<a href="edit-postage/${id}"><i class="fas fa-edit"></i></a>`;
                }
            }]
        });
        //notarization and postage
        $("#notarization-table").DataTable({
            "ajax": "{{ route('admin.datatable.notarization') }}",
            "dom": "Bfrtip",
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ordering": false,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "columns": [{
                "data": "parent_profile.p1_first_name"
            }, {
                "data": "amount"
            }, {
                "data": "pay_for"
            }, {
                "data": "transcation_id"
            }, {
                "data": "payment_mode"
            }, {
                "data": "status"
            }, {
                "data": "id",
                "render": function(id) {
                    return `<a href="edit-notarization/${id}"><i class="fas fa-edit"></i></a>`;
                }
            }]
        });
        //custom letter payments datatable
        $("#customletter-table").DataTable({
            "ajax": "{{ route('admin.datatable.customletter') }}",
            "processing": true,
            "dom": "Bfrtip",
            "serverSide": true,
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "columns": [{
                "data": "parent_profile.p1_first_name"
            }, {
                "data": "amount"
            }, {
                "data": "type_of_payment"
            }, {
                "data": "transcation_id"
            }, {
                "data": "payment_mode"
            }, {
                "data": "status"
            }, {
                "data": "id",
                "render": function(id) {
                    return `<a href="edit-customletter/${id}"><i class="fas fa-edit"></i></a>`;
                }
            }]
        });
        //Order Cosltation datatable
        $("#orderConsltation-table").DataTable({
            "ajax": "{{ route('admin.datatable.conultation') }}",
            "processing": true,
            "dom": "Bfrtip",
            "serverSide": true,
            "responsive": true,
            "ordering": false,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "columns": [{
                "data": "parent.p1_first_name"
            }, {
                "data": "amount"
            }, {
                "data": "type_of_payment"
            }, {
                "data": "transcation_id"
            }, {
                "data": "payment_mode"
            }, {
                "data": "status"
            }, {
                "data": "id",
                "render": function(id) {
                    return `<a href="edit-conultation/${id}"><i class="fas fa-edit"></i></a>`;
                }
            }]
        });
        //generate coupon code

        $("#generate-code").on('click', function() {
            let _this = $(this);
            let text = _this.text();

            _this.attr('disabled', true);
            _this.text('Generating...');

            $.ajax({
                type: "get",
                url: "{{ route('admin.coupons.generate') }}",
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

    // dashboard admin upload doc for student
    $("#add-documents").on("submit", function(event) {
        event.preventDefault();

        var student_id = $('#student_idd').val();
        var parent_id = $('#parent_id').val();
        var doc_type = $('#doc_type').val();
        var is_upload = $('#is_upload:checked').val();
        data = new FormData();
        data.append('file', $('#file')[0].files[0]);
        data.append('parent_id', parent_id);
        data.append('student_id', student_id);
        data.append('doc_type', doc_type);
        data.append('is_upload', is_upload);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.dashboard.documents') }}",
            processData: false,
            contentType: false,
            type: "POST",
            data: data,
            success: function(response) {
                location.reload();
            },
            error: function(response) {

            }
        });
    });



    // dashboard admin record transfer doc for student
    $("#add-record-request").on("submit", function(event) {
        event.preventDefault();
        console.log('created');
        var student_id = $('#student_id').val();
        var parent_id = $('#parent_id').val();
        var school_name = $('#school_name').val();
        var email_add = $('#email_add').val();
        var street_address = $('#street_address1').val();
        var fax_number = $('#fax_number').val();
        var phone_number = $('#phone_number').val();
        var city = $('#city1').val();
        var state = $('#state1').val();
        var zipcode = $('#zipcode1').val();
        var country = $('#country1').val();
        var last_grade = $('#last_grade').val();
        console.log(zipcode);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.dashboard.recordtrasnfer') }}",
            type: "POST",

            data: {
                parent_id: parent_id,
                student_id: student_id,
                school_name: school_name,
                email_add: email_add,
                street_address: street_address,
                fax_number: fax_number,
                phone_number: phone_number,
                city: city,
                state: state,
                zipcode: zipcode,
                country: country,
                last_grade: last_grade
            },
            success: function(response) {
                location.reload();
            },
            error: function(response) {

            }
        });
    });
    // add student information
    $(".students_store").on("submit", function(event) {
        event.preventDefault();
        var students_id = $('#students_id').val();
        var parent_id = $('#parent_id').val();
        var first_name = $('#first_name').val();
        var middle_name = $('#middle_name').val();
        var last_name = $('#last_name').val();
        var d_o_b = $('#d_o_b').val();
        var gender = $("input[type='radio']:checked").val();
        var email = $('#email').val();
        var cell_phone = $('#cell_phone').val();
        var mothers_name = $('#mothers_name').val();
        var birth_city = $('#birth_city').val();
        var student_Id = $('#student_Id').val();
        var immunized_status = $('#immunized_status').val();
        var student_situation = $('#student_situation').val();
        var url = "{{ route('admin.edit-student.update', ':students_id') }}";
        url = url.replace(':students_id', students_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",

            data: {
                parent_id: parent_id,
                students_id: students_id,
                student_Id: student_Id,
                first_name: first_name,
                middle_name: middle_name,
                last_name: last_name,
                d_o_b: d_o_b,
                email: email,
                cell_phone: cell_phone,
                gender: gender,
                mothers_name: mothers_name,
                birth_city: birth_city,
                immunized_status: immunized_status,
                student_situation: student_situation,
            },
            success: function(response) {

            },
            error: function(response) {
                console.log(error);
            }
        });
    });


    // add new student from admin 
    $("#new-student-record").on("submit", function(event) {
        event.preventDefault();
        var parents_id = $('#parents_id').val();
        var student_first_name = $('#student_first_name').val();
        var student_middle_name = $('#student_middle_name').val();
        var student_last_name = $('#student_last_name').val();
        var student_gender = $('#student_gender').val();
        var student_d_o_b = $('#student_d_o_b').val();
        var student_email = $('#student_email').val();
        var student_phone = $('#student_phone').val();
        var student_student_id = $('#students_student_id').val();
        var student_immunized_status = $('#student_immunized_status').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.create.newstudent') }}",
            type: "POST",

            data: {
                parents_id: parents_id,
                student_first_name: student_first_name,
                student_middle_name: student_middle_name,
                student_last_name: student_last_name,
                student_gender: student_gender,
                student_d_o_b: student_d_o_b,
                student_email: student_email,
                student_phone: student_phone,
                student_student_id: student_student_id,
                student_immunized_status: student_immunized_status,
            },
            success: function(response) {
                location.reload();
            },
            error: function(response) {

            }
        });
    });


    // add new student from admin 
    $("#add-new-student").on("submit", function(event) {
        event.preventDefault();
        var parent_id = $('#parent_id').val();
        var first_name = $('#first_name').val();
        var middle_name = $('#middle_name').val();
        var last_name = $('#last_name').val();
        var gender = $("input[type='radio']:checked").val();
        var d_o_b = $('#d_o_b').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var student_id = $('#student_id').val();
        var immunized_status = $('#immunized_status').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.create.students') }}",
            type: "POST",

            data: {
                parent_id: parent_id,
                first_name: first_name,
                middle_name: middle_name,
                last_name: last_name,
                gender: gender,
                d_o_b: d_o_b,
                email: email,
                phone: phone,
                student_id: student_id,
                immunized_status: immunized_status,
            },
            success: function(response) {
                location.reload();
            },
            error: function(response) {

            }
        });
    });
    // update student from admin student side
    $("#studentForm1").on("submit", function(event) {
        event.preventDefault();
        var parent_id = $('#parent_id').val();
        var first_name = $('#first_name').val();
        var middle_name = $('#middle_name').val();
        var last_name = $('#last_name').val();
        var gender = $("input[type='radio']:checked").val();
        var d_o_b = $('#d_o_b').val();
        var email = $('#email').val();
        var phone = $('#cell_phone').val();
        var student_id = $('#student_id').val();
        var national_ID = $('#national_ID').val();
        var birth_city = $('#birth_city').val();
        var immunized_status = $('#immunized_status').val();
        var student_situation = $('#student_situation').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.update.student.profile') }}",
            type: "POST",

            data: {
                parent_id: parent_id,
                first_name: first_name,
                middle_name: middle_name,
                last_name: last_name,
                gender: gender,
                d_o_b: d_o_b,
                email: email,
                phone: phone,
                student_id: student_id,
                national_ID: national_ID,
                birth_city: birth_city,
                immunized_status: immunized_status,
                student_situation: student_situation
            },
            success: function(response) {
                location.reload();
            },
            error: function(response) {

            }
        });
    });

    // add new order 
    $("#add-new-order").on("submit", function(event) {
        event.preventDefault();
        var type = $('#order_detail_val').val();
        if (type == 'order-detail_transcript') {
            var order_detail_val = $('#order_detail_val').val();
            var student_id_val = $('#student_id_val').val();
            var parent_id = $('#parent_id').val();
            var parent_name = $('#parent_name').val();
            var transcript_period = $('#transcript_period').val();
            var amount = $('#amount').val();
            var quantity = $('#quantity').val();
            var notes = $('#notes').val();
            var status = $('#status').val();
            var total_val = $('#total_val').val();
            var transcript_transaction_id = $('#transcript_transaction_id').val();
            var transcript_pay_mode = $('#transcript_pay_mode').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.create.orders') }}",
                type: "POST",

                data: {
                    order_detail_val: order_detail_val,
                    student_id_val: student_id_val,
                    parent_id: parent_id,
                    parent_name: parent_name,
                    transcript_period: transcript_period,
                    amount: amount,
                    quantity: quantity,
                    notes: notes,
                    status: status,
                    total_val: total_val,
                    transcript_pay_mode: transcript_pay_mode,
                    transcript_transaction_id: transcript_transaction_id,
                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {

                }
            });
        }
        if (type == 'order-detail_enrollment') {
            var order_detail_val = $('#order_detail_val').val();
            var parent_id = $('#parent_id').val();
            var student_id = $('#order-student-name').val();
            var start_date = $('#order-start_date').val();
            var end_date = $('#order-end-date').val();
            var amount = $('#order-amount').val();
            var grade = $('#order-grade').val();
            var type = $('#order-type').val();
            var status = $('#custom_letter_status').val();
            var enrollment_transction_id = $('#enrollment_transction_id').val();
            var enrollment_pay_mode = $('#enrollment_pay_mode').val();

            var order_name = 'enrollment';
            console.log(status);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.create.orders') }}",
                type: "POST",

                data: {
                    order_detail_val: order_detail_val,
                    parent_id: parent_id,
                    student_id: student_id,
                    start_date: start_date,
                    end_date: end_date,
                    amount: amount,
                    grade: grade,
                    type: type,
                    status: status,
                    order_name: order_name,
                    enrollment_pay_mode: enrollment_pay_mode,
                    enrollment_transction_id: enrollment_transction_id
                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {

                }
            });
        }
        if (type == 'order-detail_OrderPostage') {
            var order_detail_val = $('#order_detail_val').val();
            var parent_value = $('#parent_value').val();
            var postage_country = $('#postage_country').val();
            var postage_charge = $('#postage_charge').val();
            var paying_for = $('#paying_for').val();
            var postage_quantity = $('#postage_quantity').val();
            var notes_val = $('#notes_val').val();
            var postage_total = $('#postage_total').val();
            var paymentDetails = $('#OrderPostage-paymentDetails').val();
            var postage_payment_mode = $('#postage_payment_mode').val();
            var postage_transaction_id = $('#postage_transaction_id').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.create.orders') }}",
                type: "POST",

                data: {
                    order_detail_val: order_detail_val,
                    parent_value: parent_value,
                    postage_country: postage_country,
                    postage_charge: postage_charge,
                    paying_for: paying_for,
                    postage_quantity: postage_quantity,
                    notes_val: notes_val,
                    postage_total: postage_total,
                    postage_payment_mode: postage_payment_mode,
                    postage_transaction_id: postage_transaction_id,
                    paymentDetails: paymentDetails,
                },
                success: function(response) {
                    location.reload();

                },
                error: function(response) {

                }
            });
        }
        if (type == 'order-detail_OrderConsultaion') {

            var order_detail_val = $('#order_detail_val').val();
            var p1_profile_id = $('#p1_profile_id').val();
            var language = $('#language').val();
            var consul_amount = $('#consul_amount').val();
            var consul_paying_for = $('#consul_paying_for').val();
            var consul_quantity = $('#consul_quantity').val();
            var consul_total = $('#consul_total').val();
            var consul_payment_mode = $('#consul_payment_mode').val();
            var paymentDetails = $('#OrderPostage-paymentDetails').val();
            var consul_transaction_id = $('#consul_transaction_id').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.create.orders') }}",
                type: "POST",

                data: {
                    order_detail_val: order_detail_val,
                    p1_profile_id: p1_profile_id,
                    language: language,
                    consul_amount: consul_amount,
                    consul_paying_for: consul_paying_for,
                    consul_quantity: consul_quantity,
                    consul_total: consul_total,
                    consul_payment_mode: consul_payment_mode,
                    consul_transaction_id: consul_transaction_id,
                    paymentDetails: paymentDetails,

                },
                success: function(response) {
                    location.reload();

                },
                error: function(response) {

                }
            });
        }

        if (type == 'order-detail_Notarization') {

            var order_detail_val = $('#order_detail_val').val();
            var parent_profile_id = $('#parent_profile_id').val();
            var notarization_quantity = $('#studnotarization_quantityent_name').val();
            var shipping_country = $('#shipping_country').val();
            var notar_amount = $('#notar_amount').val();
            var shipping_amount = $('#shipping_amount').val();
            var notar_notes = $('#notar_notes').val();
            var noatrization_status = $('#noatrization_status').val();
            var notar_total = $('#notar_total').val();
            var notar_payment_mode = $('#notar_payment_mode').val();
            var notar_transaction_id = $('#notar_transaction_id').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.create.orders') }}",
                type: "POST",

                data: {
                    order_detail_val: order_detail_val,
                    parent_profile_id: parent_profile_id,
                    notarization_quantity: notarization_quantity,
                    shipping_country: shipping_country,
                    notar_amount: notar_amount,
                    shipping_amount: shipping_amount,
                    notar_notes: notar_notes,
                    noatrization_status: noatrization_status,
                    notar_total: notar_total,
                    notar_payment_mode: notar_payment_mode,
                    notar_transaction_id: notar_transaction_id
                },
                success: function(response) {
                    location.reload();

                },
                error: function(response) {

                }
            });
        }
        if (type == 'order-detail_ApostilePackage') {
            var order_detail_val = $('#order_detail_val').val();
            var parent_profile_id = $('#parent_profile_id').val();
            var apostille_quantity = $('#apostille_quantity').val();
            var apostille_country = $('#apostille_country').val();
            var shipp_country = $('#shipp_country').val();
            var apostille_amount = $('#apostille_amount').val();
            var ship_amount = $('#ship_amount').val();
            var apostille_notes = $('#apostille_notes').val();
            var apostille_status = $('#apostille_status').val();
            var apostille_payment_mode = $('#apostille_payment_mode').val();
            var apostille_transaction_id = $('#apostille_transaction_id').val();
            var apostille_total = $('#apostille_total').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.create.orders') }}",
                type: "POST",

                data: {
                    order_detail_val: order_detail_val,
                    parent_profile_id: parent_profile_id,
                    apostille_quantity: apostille_quantity,
                    apostille_country: apostille_country,
                    shipp_country: shipp_country,
                    apostille_amount: apostille_amount,
                    ship_amount: ship_amount,
                    apostille_notes: apostille_notes,
                    apostille_status: apostille_status,
                    apostille_payment_mode: apostille_payment_mode,
                    apostille_transaction_id: apostille_transaction_id,
                    apostille_total: apostille_total

                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {

                }
            });
        }

        if (type == 'order-detail_CustomPayment') {
            var order_detail_val = $('#order_detail_val').val();
            var custom_amount = $('#custom_amount').val();
            var custom_paying_for = $('#custom_paying_for').val();
            var custom_transcation = $('#custom_transcation').val();
            var custom_payment_mode = $('#custom_payment_mode').val();
            var custom_status = $('#custom_status').val();
            var parent_id = $('#parent_id').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.create.orders') }}",
                type: "POST",

                data: {
                    order_detail_val: order_detail_val,
                    custom_amount: custom_amount,
                    custom_paying_for: custom_paying_for,
                    custom_transcation: custom_transcation,
                    custom_payment_mode: custom_payment_mode,
                    custom_status: custom_status,
                    parent_id: parent_id
                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {

                }
            });
        }

        if (type == 'order-detail_CustomLetter') {
            var order_detail_val = $('#order_detail_val').val();
            var custom_letter_amount = $('#custom_letter_amount').val();
            var custom_letter_paying = $('#custom_letter_paying').val();
            var custom_letter_transction = $('#custom_letter_transction').val();
            var custom_letter_payment_mode = $('#custom_letter_payment_mode').val();
            var custom_letter_status = $('#custom_l_status').val();
            var parent_id = $('#parent_id').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.create.orders') }}",
                type: "POST",

                data: {
                    order_detail_val: order_detail_val,
                    custom_letter_amount: custom_letter_amount,
                    custom_letter_paying: custom_letter_paying,
                    custom_letter_transction: custom_letter_transction,
                    custom_letter_payment_mode: custom_letter_payment_mode,
                    custom_letter_status: custom_letter_status,
                    parent_id: parent_id
                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {

                }
            });
        }
        if (type == 'order-detail_Graduation') {
            var order_detail_val = $('#order_detail_val').val();
            var parent_id = $('#parent_id').val();
            var student_id = $('#student_ids').val();
            var grade_9 = $('#grade_9').val();
            var grade_10 = $('#grade_10').val();
            var grade_11 = $('#grade_11').val();
            var status = $('#status-graduation').val();
            var grad_transction_id = $('#grad_transction_id').val();
            var custom_payment_mode = $('#custom_payment_mode').val();
            var apostille_package = $('#apostille_package').val();
            var apostille_country_gard = $('#apostille_country_gard').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.add.graduation') }}",
                type: "POST",

                data: {
                    order_detail_val,
                    parent_id,
                    student_id,
                    grade_9,
                    grade_10,
                    grade_11,
                    status,
                    grad_transction_id,
                    custom_payment_mode,
                    apostille_package,
                    apostille_country_gard
                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {

                }
            });
        }
    });

    // add parent information
    $("#sampleForm").on("submit", function(event) {
        event.preventDefault();
        var parent_id = $('#parent_id').val();
        var p1_first_name = $('#p1_first_name').val();
        var p1_middle_name = $('#p1_middle_name').val();
        var p1_last_name = $('#p1_last_name').val();
        var p1_email = $('#p1_email').val();
        var p1_cell_phone = $('#p1_cell_phone').val();
        var p1_home_phone = $('#p1_home_phone').val();
        var street_address = $('#street_address').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var country = $('#country').val();
        var zip_code = $('#zip_code').val();
        var reffered = $('#reffered').val();
        var p2_first_name = $('#p2_first_name').val();
        var p2_middle_name = $('#p2_middle_name').val();
        var p2_last_name = $('#p2_last_name').val();
        var p2_email = $('#p2_email').val();
        var p2_cell_phone = $('#p2_cell_phone').val();
        var p2_home_phone = $('#p2_home_phone').val();
        var p2_street_address = $('#p2_street_address').val();
        var p2_city = $('#p2_city').val();
        var p2_state = $('#p2_state').val();
        var p2_country = $('#p2_country').val();
        var p2_zip_code = $('#p2_zip_code').val();
        var url = "{{ route('admin.parent.update', ':parent_id') }}";
        url = url.replace(':parent_id', parent_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",

            data: {
                p1_first_name: p1_first_name,
                p1_middle_name: p1_middle_name,
                p1_last_name: p1_last_name,
                p1_email: p1_email,
                p1_cell_phone: p1_cell_phone,
                p1_home_phone: p1_home_phone,
                street_address: street_address,
                city: city,
                state: state,
                country: country,
                zip_code: zip_code,
                reffered: reffered,
                p2_first_name: p2_first_name,
                p2_middle_name: p2_middle_name,
                p2_last_name: p2_last_name,
                p2_email: p2_email,
                p2_cell_phone: p2_cell_phone,
                p2_home_phone: p2_home_phone,
                p2_street_address: p2_street_address,
                p2_city: p2_city,
                p2_state: p2_state,
                p2_country: p2_country,
                p2_zip_code: p2_zip_code,
            },
            success: function(response) {
                location.reload();
            },
            error: function(response) {}
        });
    });
    //edit-student-profile

    //add notes to family 
    $("#add-new-notes").on("submit", function(event) {
        event.preventDefault();
        var parent_id = $('#parent_id').val();
        var student_name_for_notes = $('#student_name_for_notes').val();
        var message_text = $('#message_text').val();
        console.log(student_name_for_notes);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.create.notes') }}",
            type: "POST",

            data: {
                parent_id: parent_id,
                student_name_for_notes: student_name_for_notes,
                message_text: message_text,
            },
            success: function(response) {
                location.reload();
            },
            error: function(response) {

            }
        });
    });

    //Add student enrollment
    $("#add-new-enrollments").on("submit", function(event) {
        event.preventDefault();
        var parent_id = $('#parent_id').val();
        var student_name = $('#student_name').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var grade_level = $("input[type='radio']:checked").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.create.enrollments') }}",
            type: "POST",

            data: {
                parent_id: parent_id,
                student_name: student_name,
                start_date: start_date,
                end_date: end_date,
                grade_level: grade_level,
            },
            success: function(response) {
                location.reload();
            },
            error: function(response) {

            }
        });
    });
    // edit Dashboard Record For Super Admin
    function editDashboard(event) {
        var id = $(event).data("id");
        console.log(id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('admin/assign/dashboard') }}",
            type: "POST",
            data: {
                assign_id: id,
            },
            success: function(response) {
                if (response) {
                    $("#assigned_to").val(response.assigned_to);
                    $("#notes").val(response.notes);
                    $("#data_id").val(response.id);
                }
            }
        });
    }
    // assign Record of Dashboard For Super Admin
    $("#assign-form").on("submit", function(event) {
        console.log('created');
        event.preventDefault();

        var assignee = $('#assigned_to').val();
        var notes = $('#notes').val();
        var id = $('#data_id').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.update.assignee') }}",
            type: "POST",
            data: {
                id: id,
                assigned: assignee,
                notes: notes
            },
            success: function(response) {
                location.reload();
            },
            error: function(response) {

            }
        });
    });
    // provide status for sub admin - completed or pending
    function editDashboardForStatus(event) {
        var id = $(event).data("id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('admin/assign/status') }}",
            type: "POST",
            data: {
                assign_id: id,
            },
            success: function(response) {
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
            },
            url: "{{ url('admin/update/record/status') }}",
            type: "POST",
            data: {
                id: id,
                assigned: assignee,
                notes: notes
            },
            success: function(response) {

                console.log(response);
            },
            error: function(response) {

            }
        });
    }


    // add parent  record on click information
    $("#add-new-parent").on("submit", function(event) {
        event.preventDefault();
        var parent1_first_name = $('#parent1_first_name').val();
        var parent1_middle_name = $('#parent1_middle_name').val();
        var parent1_last_name = $('#parent1_last_name').val();
        var parent1_email = $('#parent1_email').val();
        var parent1_cell_phone = $('#parent1_cell_phone').val();
        var parent1_home_phone = $('#parent1_home_phone').val();
        var reference = $('#reference').val();
        var parent2_first_name = $('#parent2_first_name').val();
        var parent2_middle_name = $('#parent2_middle_name').val();
        var parent2_last_name = $('#parent2_last_name').val();
        var parent2_email = $('#parent2_email').val();
        var parent2_cell_phone = $('#parent2_cell_phone').val();
        var parent2_home_phone = $('#parent2_home_phone').val();
        var parent1_street_address = $('#parent1_street_address').val();
        var parent1_city = $('#parent1_city').val();
        var parent1_state = $('#parent1_state').val();
        var parent2_country = $('#parent2_country').val();
        var parent2_zip_code = $('#parent2_zip_code').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.create.parent') }}",
            type: "POST",

            data: {
                parent1_first_name: parent1_first_name,
                parent1_middle_name: parent1_middle_name,
                parent1_last_name: parent1_last_name,
                parent1_email: parent1_email,
                parent1_cell_phone: parent1_cell_phone,
                parent1_home_phone: parent1_home_phone,
                parent2_first_name: parent2_first_name,
                parent2_last_name: parent2_last_name,
                parent2_email: parent2_email,
                parent2_cell_phone: parent2_cell_phone,
                parent2_home_phone: parent2_home_phone,
                parent1_street_address: parent1_street_address,
                parent1_city: parent1_city,
                parent1_state: parent1_state,
                parent2_country: parent2_country,
                parent2_zip_code: parent2_zip_code,
                reference: reference,
            },
            success: function(response) {
                location.reload();
            },
            error: function(response) {}
        });
    });

    // add parent  record on click information
    $("#orderForm1").on("submit", function(event) {
        event.preventDefault();
        var parent_address_id = $('#parent_address_id').val();
        var address_id = $('#address_id').val();
        var parent1_first_name = $('#p1_first_name').val();
        var parent1_last_name = $('#p1_last_name').val();
        var parent1_email = $('#p1_email').val();

        var billing_street_address = $('#billing_street_address').val();
        var billing_city = $('#billing_city').val();
        var billing_state = $('#billing_state').val();
        var billing_zip_code = $('#billing_zip_code').val();
        var billing_country = $('#billing_country').val();


        var shipping_street_address2 = $('#shipping_street_address2').val();
        var shipping_city2 = $('#shipping_city2').val();
        var shipping_state2 = $('#shipping_state2').val();
        var shipping_zip_code2 = $('#shipping_zip_code2').val();
        var shipping_country2 = $('#shipping_country2').val();
        var shipping_email = $('#shipping_email').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.edit.order.address') }}",
            type: "POST",

            data: {
                parent_address_id,
                address_id,
                parent1_first_name,
                parent1_last_name,
                parent1_email,
                billing_street_address,
                billing_city,
                billing_state,
                billing_zip_code,
                billing_country,
                shipping_street_address2,
                shipping_city2,
                shipping_state2,
                shipping_zip_code2,
                shipping_country2,
                shipping_email

            },
            success: function(response) {
                // location.reload();
            },
            error: function(response) {}
        });
    });
    // upload student upload documents
    $("#student-document-table").DataTable({
        "ajax": "{{ route('admin.datatable.student') }}",
        "dom": "Bfrtip",
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "ordering": false,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "columns": [{
                "data": "fullname"
            }, {
                "data": "birthdate",
                "render": function(data) {
                    return (moment(data).format("LL"));
                }
            }, {
                "data": "gender"
            },
            {
                "data": "parent_profile.country"
            },
            {
                "data": function(row, type, val, meta) {
                    return row.email
                },
                defaultContent: '',
                "render": function(data) {
                    if (data === null) {
                        return `<label> </label>`;
                    } else {
                        return `<a  class="transform-none" href="mailto:${data}">${data}</a>`;
                    }
                }
            },
            {
                "data": "id",
                "render": function(id) {
                    return `<a href="edit-upload/${id}">Upload Document</a>`
                }
            },
            {
                "data": "id",
                "render": function(id) {

                    return `<a href="view-documents/${id}">View Document</a>`;
                }
            }


        ]
    });

    // student panel - add graduation

    $("#add-graduation").on("submit", function(event) {
        event.preventDefault();
        var parent_id = $('#parent_id').val();
        var student_id = $('#student_ids').val();
        var grade_9 = $('#grade_9').val();
        var grade_10 = $('#grade_10').val();
        var grade_11 = $('#grade_11').val();
        var status = $('#status-graduation').val();
        var grad_transction_id = $('#grad_transction_id').val();
        var custom_payment_mode = $('#custom_payment_mode').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.add.graduation') }}",
            type: "POST",

            data: {
                parent_id,
                student_id,
                grade_9,
                grade_10,
                grade_11,
                status,
                grad_transction_id,
                custom_payment_mode
            },
            success: function(response) {},
            error: function(response) {

            }
        });
    });


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
            },
            url: "{{ url('admin/archieve/record') }}",
            type: "POST",
            data: {
                id: archieve_ids,
            },
            success: function(response) {
                location.reload()
                console.log(response);
            },
            error: function(response) {

            }
        });
    }

    // for validating start and end date 
    $("#end_date_of_enrollment").change(function() {
        var startDate = document.getElementById("start_date_of_enrollment").value;
        var endDate = document.getElementById("end_date_of_enrollment").value;

        if ((Date.parse(startDate) >= Date.parse(endDate)) && (Date.parse(startDate) !== Date.parse(
                endDate))) {
            alert("End date should be greater than Start date");
            document.getElementById("end_date_of_enrollment").value = "";
        }
    });



    //// table enable 

    document.querySelector(".js-cancel").addEventListener("click", () => {
        var form = document.getElementById("sampleForm");
        form.classList.add("is-readonly");
        form.classList.remove("is-editing");
        let elements = document.getElementsByTagName("input");
        for (let i = 0; i < elements.length; i++) {
            elements[i].disabled = true;
        }
    })
    document.querySelector(".js-cancel").addEventListener("click", () => {
        var form = document.getElementById("studentForm1");
        form.classList.add("is-readonly");
        form.classList.remove("is-editing");
        let elements = document.getElementsByTagName("input");
        for (let i = 0; i < elements.length; i++) {
            elements[i].disabled = true;
        }
    })
    document.querySelector(".js-cancel").addEventListener("click", () => {
        var form = document.getElementById("orderForm1");
        form.classList.add("is-readonly");
        form.classList.remove("is-editing");
        let elements = document.getElementsByTagName("input");
        for (let i = 0; i < elements.length; i++) {
            elements[i].disabled = true;
        }
    })
    /////form enable 
    document.querySelectorAll(".form-enable").forEach((link) => {
        link.addEventListener("click", () => {
            var form = document.getElementById("sampleForm");
            if (form.classList.contains("is-readonly")) {
                form.classList.remove("is-readonly");
                form.classList.add("is-editing");
                let elements = document.getElementsByTagName("input");
                for (let i = 0; i < elements.length; i++) {
                    elements[i].disabled = false;
                }
            } else {
                form.classList.add("is-readonly");
                form.classList.remove("is-editing");
                let elements = document.getElementsByTagName("input");
                for (let i = 0; i < elements.length; i++) {
                    elements[i].disabled = true;
                }
            }
        });
    });

    document.querySelectorAll(".form-enable").forEach((link) => {
        link.addEventListener("click", () => {
            var form = document.getElementById("studentForm1");
            if (form.classList.contains("is-readonly")) {
                form.classList.remove("is-readonly");
                form.classList.add("is-editing");
                let elements = document.getElementsByTagName("input");
                for (let i = 0; i < elements.length; i++) {
                    elements[i].disabled = false;
                }
            } else {
                form.classList.add("is-readonly");
                form.classList.remove("is-editing");
                let elements = document.getElementsByTagName("input");
                for (let i = 0; i < elements.length; i++) {
                    elements[i].disabled = true;
                }
            }
        });
    });
    document.querySelectorAll(".form-enable").forEach((link) => {
        link.addEventListener("click", () => {
            var form = document.getElementById("orderForm1");
            if (form.classList.contains("is-readonly")) {
                form.classList.remove("is-readonly");
                form.classList.add("is-editing");
                let elements = document.getElementsByTagName("input");
                for (let i = 0; i < elements.length; i++) {
                    elements[i].disabled = false;
                }
            } else {
                form.classList.add("is-readonly");
                form.classList.remove("is-editing");
                let elements = document.getElementsByTagName("input");
                for (let i = 0; i < elements.length; i++) {
                    elements[i].disabled = true;
                }
            }
        });
    });

    // for graduation hide and show payment mode inaccordance to status
    document.getElementById("status-graduation").addEventListener("change", function() {

        var value = this.value;
        console.log(value);
        if (value == "paid") {
            $("#grad-div-transction").show();
            $('#payment-div-grad').show();
        } else {
            $("#grad-div-transction").hide();
            $("#payment-div-grad").hide();

        }
    })

    function calculateLetterAmount() {
        var quantity = $('#custom_letter_quantity').val();
        $("#custom_letter_amount").val(quantity * 35);
    }

    document.getElementById("custom_letter_status").addEventListener("change", function() {

        var value = this.value;
        console.log(value);
        if (value == "paid") {
            $("#transction-div").show();
            $('#payment-div').show();
        } else {
            $("#payment-div").hide();
            $("#transction-div").hide();

        }
    })

    function calculateType() {
        var start_date = $('#order-start_date').val();
        var end_date = $('#order-end-date').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.calculate.annualtype') }}",
            type: "POST",

            data: {
                start_date: start_date,
                end_date: end_date
            },
            success: function(response) {
                console.log(response);
                $("#order-type").val(response.type);
                $('#order-amount').val(response.amount);
            },
            error: function(response) {

            }
        });
    }


    document.getElementById("order_detail_val").addEventListener("change", function() {
        var elem = this;
        var value = this.value;
        $("#order-detail_transcript").hide();
        $("#order-detail_enrollment").hide();
        $("#order-detail_Graduation").hide();
        $("#order-detail_CustomPayment").hide();
        $("#order-detail_OrderPostage").hide();
        $("#order-detail_Notarization").hide();
        $("#order-detail_ApostilePackage").hide();
        $("#order-detail_CustomLetter").hide();
        $("#order-detail_OrderConsultaion").hide();



        if (value == "order-detail_transcript") {
            $("#order-detail_transcript").show();
        } else if (value == "order-detail_enrollment") {
            $("#order-detail_enrollment").show();
        } else if (value == "order-detail_Graduation") {
            $("#order-detail_Graduation").show();
        } else if (value == "order-detail_CustomPayment") {
            $("#order-detail_CustomPayment").show();
        } else if (value == "order-detail_OrderPostage") {
            $("#order-detail_OrderPostage").show();
        } else if (value == "order-detail_Notarization") {
            $("#order-detail_Notarization").show();
        } else if (value == "order-detail_ApostilePackage") {
            $("#order-detail_ApostilePackage").show();
        } else if (value == "order-detail_CustomLetter") {
            $('#custom_letter_quantity').attr('required', 'required');
            $('#custom_letter_amount').attr('required', 'required');
            $('#custom_letter_paying').attr('required', 'required');
            $('#custom_l_status').attr('required', 'required');
            $("#order-detail_CustomLetter").show();
        } else if (value == "order-detail_OrderConsultaion") {
            $("#order-detail_OrderConsultaion").show();
        }

    })

    document.querySelectorAll(".paymentDisplay").
    forEach((element) => {
        element.addEventListener("change", function() {
            var value = this.value;
            if (value == "paid") {
                $(".transction-div").show();
                $('.payment-div').show();
                $('#custom_letter_transction').attr('required', 'required');
                $('#custom_letter_payment_mode').attr('required', 'required');

            } else {
                $(".payment-div").hide();
                $(".transction-div").hide();
                $('#custom_letter_transction').removeAttr('required');
                $('#custom_letter_payment_mode').removeAttr('required');
            }
        })
    });


    $('input[name=apostille_package]').change(function() {
        if ($(this).is(':checked')) {
            $("#apostille_country_pac").show();
        } else {
            $("#apostille_country_pac").hide();
        }
    });

    document.getElementById("postage_country").addEventListener("change", function() {

        var value = this.value;
        if (value == "India") {
            $("#postage_charge").val() = 100;
        }
    })


    $('#check').click(function() {
        $("#p2_street_address").val($("#street_address").val());
        $("#p2_city").val($("#city").val());
        $("#p2_country").val($("#country").val());
        $("#p2_state").val($("#state").val());
        $("#p2_zip_code").val($("#zip_code").val());

    });

    $('#parent_status').change(function() {
        var parent_status = $('#parent_status').val();
        var parent_id = $('#parent_id').val();
        var url = "{{ route('admin.deactive.parent', ':parent_id') }}";
        url = url.replace(':parent_id', parent_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",
            data: {
                parent_status: parent_status,
                parent_id: parent_id,
            },
            success: function(response) {

                location.reload()
            },
            error: function(response) {

            }
        });

    })

    //change student status

    $('#student_status').change(function() {
        var student_status = $('#student_status').val();
        var id = $('#id').val();
        var url = "{{ route('admin.deactive.student', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",
            data: {
                student_status: student_status,
                id: id,
            },
            success: function(response) {

                location.reload()
            },
            error: function(response) {

            }
        });

    })

    function getTranscriptval() {
        var transcript = $('#transcript_period').val();
        var student_id = $('#student_name_order').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.get.transcriptcharges') }}",
            type: "POST",

            data: {
                transcript: transcript,
                student_id: student_id,
            },
            success: function(response) {
                $("#amount").val(response);
            },
            error: function(response) {

            }
        });
    }

    function getCountryVal() {
        var countryname = $('#postage_country').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.get.postagecharges') }}",
            type: "POST",

            data: {
                countryname: countryname,
            },
            success: function(response) {
                $("#postage_charge").val(response);
            },
            error: function(response) {

            }
        });
    }

    function getCountryValnotar() {
        var countryname = $('#shipping_country').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.get.postagecharges') }}",
            type: "POST",

            data: {
                countryname: countryname,
            },
            success: function(response) {
                $("#shipping_amount").val(response);
                $("#apostille_shipping_amount").val(response);

            },
            error: function(response) {

            }
        });
    }

    function getCountryValappostille() {
        var countryname = $('#shipp_country').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.get.postagecharges') }}",
            type: "POST",

            data: {
                countryname: countryname,
            },
            success: function(response) {
                $("#ship_amount").val(response);

            },
            error: function(response) {

            }
        });
    }

    function getApostilleAmount() {
        var quantity = $('#apostille_quantity').val();
        var amount = 75;
        var total = amount * quantity;
        $("#apostille_amount").val(total);

    }

    function getNoatrizationAmount() {
        var quantity = $('#notarization_quantity').val();
        var amount = 20;
        var total = amount * quantity;
        $("#notar_amount").val(total);

    }

    function getTotal() {
        var type = $('#order_detail_val').val();
        console.log(type);
        if (type == 'order-detail_OrderPostage') {
            var amount = $('#postage_charge').val();
            var quantity = $('#postage_quantity').val();
            var total = amount * quantity;
            $("#postage_total").val(total);
        }
        if (type == 'order-detail_Notarization') {
            var amount1 = $('#notar_amount').val();
            var shipp1 = $('#shipping_amount').val();
            var total1 = (1 * amount1) + (1 * shipp1);
            $("#notar_total").val(total1);
        }
        if (type == 'order-detail_ApostilePackage') {
            var amount2 = $('#apostille_amount').val();
            var shipp2 = $('#ship_amount').val();
            var total2 = (1 * amount2) + (1 * shipp2);
            $("#apostille_total").val(total2);
        }
    }

    function getTotalTranscript() {
        var amount = $('#amount').val();
        var quantity = $('#quantity').val();
        var total = amount * quantity;
        $("#total_val").val(total);
    }

    function getConsulatationAmount() {
        var hours = $('#consul_quantity').val();
        var total = hours * 80;
        $("#consul_amount").val(total);
    }

</script>




{{-- </script> --}}
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
    @if (Session::has('message'))
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

    function goBack() {
        window.history.back();
    }

</script>
<!-- DataTables  & Plugins -->
