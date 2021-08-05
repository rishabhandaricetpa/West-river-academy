@extends('layouts.app')
@section('pageTitle', 'Appostile')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- * =============== Main =============== * -->
    <main class="position-relative container form-content mt-4">
        <form class="mb-0" method="post" action="{{ route('add.cart') }}">
            @csrf
            <input type="hidden" name="type" value="apostille" class="form-control col-3">
            <div class="form-wrap border bg-light py-5 px-25 mb-4">
                <h2 class="mb-3">Order Apostille</h2>

                    <p><span class="font-weight-bold">Apostilles: ONLY</span>
                        for documents presented outside of the U.S. to countries who are members of The Hague
                        Convention. Includes notarization. $75 per document. Express Mail shipping is to each order at
                        checkout. Allow 3-6 weeks for processing plus shipping time.
                    </p>
                  
                        <div class="col-9 px-0 mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="font-weight-bold">Transcript(s) Quantity</p>
                                </div>
                                <div class="col-md-8 d-flex">
                                    <select class="form-control col-5" name="transcript_quan"
                                    onchange="getApostilleAmount(event,'{{ $appostile_fee }}')">
                                    <option value="">Select Quantity</option>
                                    <?php 
                                    for($i=1; $i<=10; $i++){
                                        echo'<option value="'.$i.'">'.$i.'</option>'; 
                                    }   
                                    ?>      
                                </select>
                                <span class="col-2 text-center">=</span>
                                <i class="fas fa-dollar-sign additional-sign"></i>
                                <input type="text" id="apostille_due" class="form-control col-3" name="apostille_due"
                                    readonly>
                                </div>
                            </div>
                          
                        </div>
                  
                    <div class="col-md-9  px-0 mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="font-weight-bold">Confirmation of Enrollment Letter(s) Quantity</p>
                            </div>
                            <div class="col-md-8 d-flex">
                                <select class="form-control col-5" name="confirm_quan"
                                onchange="getApostillforconfirmAmount(event,'{{ $appostile_fee }}')">
                                <option value="">Select Quantity</option>
                                <?php 
                                for($i=1; $i<=10; $i++){
                                    echo'<option value="'.$i.'">'.$i.'</option>'; 
                                }   
                                ?>      
                            </select>
                            <span class="col-2 text-center">=</span>
                            <i class="fas fa-dollar-sign additional-sign"></i>
                            <input type="text" id="apostille_due1" class="form-control col-3" name="apostille_due1"
                                readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 px-0 mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="font-weight-bold"> Custom Letter(s) Quantity</p>
                            </div>
                            <div class="col-md-8 d-flex">
                                <select class="form-control col-5" name="custom_quan"
                                onchange="getApostilleAmountforCustom(event,'{{ $appostile_fee }}')">
                                <option value="">Select Quantity</option>
                                <?php 
                                for($i=1; $i<=10; $i++){
                                    echo'<option value="'.$i.'">'.$i.'</option>'; 
                                }   
                                ?>      
                            </select>
                            <span class="col-2 text-center">=</span>
                            <i class="fas fa-dollar-sign additional-sign"></i>
                            <input type="text" id="apostille_due2" class="form-control col-3" name="apostille_due2"
                                readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9  px-0 mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="font-weight-bold">Country</p>
                            </div>
                            <div class="col-md-8">
                                <select name="apostille_country" class="form-control" required>
                                    <option value="">Select country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->country }}">{{ $country->country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <p class="font-weight-bold mb-1">Please enter the student name(s) and year(s) for the document(s)
                            you wish to have apostille and any other comments.</p>
                        <textarea cols="40" rows="10" class="form-control" name="message"
                            maxlength="2000" onKeyPress="if(this.value.length==2000) return false;" required></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <h2 class="mb-3 mt-5">Please provide the address to send the document to:</h2>
                        <div class="form-group d-sm-flex mb-2">
                            <label for="name">First Name</label>
                            <div>
                                <input type="text" name="first_name" id="name" value="" class="w-100 ml-sm-3 form-control"
                                    required>
                            </div>
                        </div>
                        <div class="form-group d-sm-flex mb-2">
                            <label for="name">Last Name</label>
                            <div>
                                <input type="text" name="last_name" id="name" value="" class="w-100 ml-sm-3 form-control"
                                    required>
                            </div>
                        </div>
                        <div class="form-group d-sm-flex mb-2">
                            <label for="street">Street</label>
                            <div>
                                <input type="text" name="street" id="street" value="" class="w-100 ml-sm-3 form-control"
                                    required>
                            </div>
                        </div>
                        <div class="form-group d-sm-flex mb-2">
                            <label for="city">City</label>
                            <div>
                                <input type="text" name="city" id="city" value="" class="w-100 ml-sm-3 form-control"
                                    required>
                            </div>
                        </div>
                        <div class="form-group d-sm-flex mb-2">
                            <label for="gcountry">State</label>
                            <div>
                                <input type="text" name="state" id="state" value="" class="w-100 ml-sm-3 form-control"
                                    required>
                            </div>
                        </div>
                        <div class="form-group d-sm-flex mb-2">
                            <label for="postal_code">Zip Code</label>
                            <div>
                                <input type="text" name="zip_code" id="zip_code" value="" class="w-100 ml-sm-3 form-control"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group d-sm-flex mb-2 col-xl-6">
                                <label for="county">Country</label>
                                <div>
                                    <select name="country_name" id="country_name" class="form-control mx-sm-3"
                                        onchange="getPostageCharges(event)" required>
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->country }}">{{ $country->country }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-group d-sm-flex mb-2 col-xl-6 px-0 pl-xl-3">
                                <label for="county">Shipping Charge</label>

                                <div class=" mb-xl-4 d-sm-flex pl-33">
                                    <i class="fas fa-dollar-sign additional-sign"></i>
                                    <input name="postage_charges" type="text" class="form-control" id="postage_charges"
                                        readonly>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="form-wrap border bg-light py-5 px-25 mb-4">
                <a onclick="goBack()" class="btn btn-primary" role="button">Back</a>
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

    function getApostillforconfirmAmount(e, fees) {
        var amount = fees * e.target.value;
        document.getElementById("apostille_due1").value = amount

    }
    function getApostilleAmountforCustom(e, fees) {
        var amount = fees * e.target.value;
        document.getElementById("apostille_due2").value = amount

    }
    // function getTotal(){
    // var amount1=  $("#apostille_due").val(total);  
    // var amount1=  $("#apostille_due").val(total);  
    // var amount1=  $("#apostille_due").val(total);  

    // }
    function getPostageCharges(e) {
        var country_name = e.target.value;
        // console.log(country_name);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('country/shipping') }}",
            type: "POST",
            data: {
                country_name: country_name,
            },
            success: function(response) {
                if (response) {
                    $("#postage_charges").val(response.postage_charges);
                }
            }
        });
    }

</script>
