@extends('layouts.app')
@section('pageTitle', 'Notarization & Appostile')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <form class="mb-0" method="post" action="{{ route('add.cart')}}">
        @csrf
        <input type="hidden" name="type" value="notarization" class="form-control col-3">
        <div class="form-wrap border bg-light py-5 px-25 mb-4">
            <h2 class="mb-3">Order Notarization</h2>

            <div class="form-group mb-2 lato-italic info-detail pb-4 label-md">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="student_grade" value="Preschool Age 4" data-toggle="collapse" data-target="#notarization" aria-expanded="false" aria-controls="notarization">
                    <label class="form-check-label ml-1" for="">
                        Notarization
                    </label>
                </div>
            </div>
            <form class="mb-0" method="post" action="{{route('add.cart')}}">

                <div class="collapse" id="notarization">
                    <p>
                        <span class="font-weight-bold">Notarizations:</span>
                        $20 per document. Shipping First class in the US is free. Expedited shipping may be ordered separately. Express Mail shipping outside the USA is added at checkout. Allow 3 days for processing plus shipping time.
                    </p>
                    <div class="form-group d-md-flex mb-2">
                        <div class="col-md-6 d-sm-flex px-0 mb-4">
                            <p class="font-weight-bold">Quantity</p>
                            <div class="row ml-3 mx-0">
                                <select class="form-control col-3" onchange="getNotarizationAmount(event,'{{$notarization_fee}}')">
                                    <option value="">Select Quantity</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                                <span class="col-3 text-center">=</span>
                                <i class="fas fa-dollar-sign additional-sign"></i>
                                <input type="text" id="notarization_due" class="form-control col-3" name="notarization_due" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2 row">
                    <p class="font-weight-bold mb-1 col-sm-12">What is to be notarized and/or sent for Apostilles?</p>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="" class="w-auto">Transcript</label>
                        <div class="w-100">
                            <select name="transcript_doc[]" multiple="multiple" class="multiple-select form-control">
                                @foreach ($transcript as $transcripts)
                                <option value="{{ $transcripts->pdf_link }}">{{ $transcripts->pdf_link }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="" class="w-auto">Confirmation of Enrollment Letter</label>
                        <div class="w-100">
                            <select name="confirmation_doc" multiple="multiple" class="multiple-select form-control">
                                @foreach ($confirmationLetter as $enrollment)
                                <option value="{{ $enrollment->pdf_link }}">{{ $enrollment->pdf_link }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-3 mb-3">
                        <label for="" class="w-auto">Custom Letter</label>
                        <div class="w-100">
                            <select name="custom_doc" multiple="multiple" class="multiple-select form-control">
                                @foreach ($custom_letter as $letter)
                                <option value="{{ $letter->pdf_link }}">{{ $letter->pdf_link }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <p class="font-weight-bold mb-1">Use this space to add comments.</p>
                    <textarea name="" id="" cols="40" rows="10" class="form-control" name="message"></textarea>
                </div>

                <div class="form-group mb-2">
                    <h2 class="mb-3 mt-5">Please provide the address to send the document to:</h2>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="name">First Name</label>
                        <div>
                            <input type="text" name="first_name" id="name" value="" class="w-100 ml-sm-3 form-control">
                        </div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="name">Last Name</label>
                        <div>
                            <input type="text" name="last_name" id="name" value="" class="w-100 ml-sm-3 form-control">
                        </div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="street">Street</label>
                        <div>
                            <input type="text" name="street" id="street" value="" class="w-100 ml-sm-3 form-control">
                        </div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="city">City</label>
                        <div>
                            <input type="text" name="city" id="city" value="" class="w-100 ml-sm-3 form-control">
                        </div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="gcountry">State</label>
                        <div>
                            <input type="text" name="state" id="state" value="" class="w-100 ml-sm-3 form-control">
                        </div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="postal_code">Zip Code</label>
                        <div>
                            <input type="text" name="zip_code" id="zip_code" value="" class="w-100 ml-sm-3 form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group d-sm-flex mb-2 col-xl-6">
                            <label for="county">Country</label>
                            <div>
                                <select name="country_name" id="country_name" class="form-control mx-sm-3" onchange="getPostageCharges(event)" required>
                                    <option value="">Select country</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->country }}">{{ $country->country }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group d-sm-flex mb-2 col-xl-6 px-sm-0 pl-xl-3">
                            <label for="county">Shipping Charge</label>

                            <div class=" mb-xl-4 d-flex pl-33">
                                <i class="fas fa-dollar-sign additional-sign"></i>
                                <input name="postage_charges" type="text" class="form-control" id="postage_charges" readonly></div>

                        </div>
                    </div>
                </div>
        </div>
        <div class="form-wrap border bg-light py-5 px-25 mb-4">
            <a href="#" class="btn btn-primary" role="button">cancel</a>
            <button type="submit" class="btn btn-primary">continue</button>
        </div>
    </form>
</main>
<!-- * =============== /Main =============== * -->
@endsection
<script>
    $('#GFG_UP')
        .text('First check few elements then click on the button.');
    $('button').on('click', function() {
        var array = [];
        $("input:checkbox[name=documents[]]:checked").each(function() {
            array.push($(this).val());
        });
        $('#GFG_DOWN').text(array);
    });

    function getNotarizationAmount(e, fees) {
        var amount = fees * e.target.value;
        document.getElementById("notarization_due").value = amount

    }

    function getApostilleAmount(e, fees) {
        var amount = fees * e.target.value;
        document.getElementById("apostille_due").value = amount

    }

    function getPostageCharges(e) {
        var country_name = e.target.value;
        // console.log(country_name);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: "{{url('country/shipping')}}"
            , type: "POST"
            , data: {
                country_name: country_name
            , }
            , success: function(response) {
                if (response) {
                    $("#postage_charges").val(response.postage_charges);
                }
            }
        });
    }

</script>
