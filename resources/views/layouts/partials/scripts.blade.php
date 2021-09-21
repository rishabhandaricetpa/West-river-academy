@stack('select2_script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script src="{{ URL::asset('/js/custom.js') }}" crossorigin="anonymous"></script>

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

</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {
        var $form = $(".validation");
        $('form.validation').bind('submit', function(e) {
            var $form = $(".validation"),
                inputVal = ['input[type=email]', 'input[type=password]', 'input[type=text]',
                    'input[type=file]', 'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeHandleResponse);
            }

        });

        function stripeHandleResponse(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });

    // view order deatils

    function viewOrders(event) {
        $("#paymeny_history_wrapper").html("")
        var trans_id = $(event).data("id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('viewfull.orders') }}",
            type: "POST",

            data: {
                trans_id,
            },
            success: function(response) {
                console.log(response);
                var html = '';
                if (response.data.length) {
                    let html = '';
                    response.data.forEach(element => {

                        html += `<tr>
                        <td>${element.linked_to}</td>
                        <td> ${element.related_to}</td>
                        <td>$${element.amount} </td>
                       </tr>`
                    });

                    $("#paymeny_history_wrapper").html(html)
                }
                if (response.enrollmentdata.length) {
                    let html = '';

                    response.enrollmentdata.forEach(element => {

                        html += `<tr>
                        <td>${element.linked_to}</td>
                        <td> ${element.related_to} (${element.start_date_of_enrollment} - ${element.end_date_of_enrollment} )</td>
                        <td> $${element.amount} </td>
                       </tr>`
                    });

                    $("#paymeny_history_wrapper").append(html)
                }
            },
            error: function(response) {

            }
        });
    }

</script>
