@extends('layouts.app')
@section('pageTitle', 'Notarization & Appostile')
@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-3">Order an Apostille or Notarization</h2>
        <form class="mb-0" method="post" action="{{route('add.cart')}}">
            <p><span class="font-weight-bold">Apostille:</span> If you will present your document(s) to a country that is a member of The Hague Convention, you may order an
               Apostille. The documents will first be notarized and then sent to the Secretary of State of Colorado for the Apostille. The
               fee is $75 for each document to be sent for an Apostille. The fee includes notarization. Allow 3-6 weeks for processing.</p>
            <p><span class="font-weight-bold">Notarization:</span>The document will be signed in front of a notary public, who will add the official stamp. The fee is $20 per
               document. Allow 3 days for processing.</p>
               <div class="form-group d-sm-flex mb-2">
               <div class="col-md-4 px-0">
               <p class="font-weight-bold">How many Apostilles would you like to order?</p>
               </div>
                <div class="col-md-4 row">
                <select class="form-control col-3" id="exampleFormControlSelect1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
 <span class="col-3 text-center">=</span>
 <input type="text" class="form-control col-3">
                </div>
            </div>
            <div class="form-group mb-2">
               <div class="col-md-4 px-0 d-sm-flex">
               <p class="font-weight-bold">Country</p>
               <select class="form-control mx-sm-3">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
               </div>
                
            </div>
            <div class="form-group d-sm-flex mb-2">
               <div class="col-md-4 px-0">
               <p class="font-weight-bold">How many Apostilles would you like to order?</p>
               </div>
                <div class="col-md-4 row">
                <select class="form-control col-3">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
 <span class="col-3 text-center">=</span>
 <input type="text" class="form-control col-3">
                </div>
            </div>
            <div class="form-group mb-2">
                <p class="font-weight-bold">Please tell us what documents are to be notarized and/or sent for Apostilles:</p>
                <div>
                    <textarea name="" id="" cols="40" rows="10" class="form-control" name="message"></textarea>
                </div>
            </div>
    </div>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <p id="GFG_UP">
        </p>

        <h2 class="mb-3">Available Documents</h2>
        <p>Select the documents you wish to have notarized or Apostilles for.</p>
        <form class="mb-0" method="post" action="{{route('add.cart')}}">
            @csrf
            <div class="overflow-auto max-table mb-2">
                <table class="table-styling w-100 enlarge-input">
                    <thead>
                        <tr>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transcriptdoc as $doc)
                        <tr>
                            <td><input class="form-check-input" type="checkbox" name="documents[]" value="{{$doc->pdf_link}}">{{$doc->pdf_link}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="">Message or Additional Information</label>
                <div>
                    <textarea name="" id="" cols="40" rows="10" class="form-control" name="message"></textarea>
                </div>
            </div>
    </div>

    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-3">Notarization or Apostille</h2>
        <p>Apostilles are optional for international students whose countries are members of The Hague Convention. An Apostille includes notarization. Express Mail is strongly recommended to ensure delivery.</p>
        <p class="mt-2r">Choose Apostille or Notarization, enter your mailing address, and select your postage option.</p>
        <input type="hidden" name="type" value="notarization">
        <div class="overflow-auto mb-2">
            <table class="table-styling w-100 enlarge-input">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Price (each)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input class="form-check-input" type="Radio" name="payfor" value="notarization_doc_fee" required>
                            <h3 class="mb-0 mt-1">Notarization</h3>
                            <p class="mb-1">Notarization of a document such as the confirmation of enrollment or transcript.</p>
                        </td>
                        <td>${{ getFeeDetails('notarization_doc_fee') }}</td>
                    </tr>
                    <tr>
                        <td><input class="form-check-input" type="Radio" name="payfor" value="apostille_doc_fee">
                            <h3 class="mb-0 mt-1">Apostille</h3>
                            <p class="mb-1">Student in the countries that are members of The Hague Convention can receive an Apostille on documents. Notarization included.</p>
                        </td>
                        <td>${{ getFeeDetails('apostille_doc_fee') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group d-sm-flex mb-2 seperator mt-4">
            <label for="">Apostille Country</label>
            <div class="col-sm-2 px-0">
                <select name="apostille_country" class="form-control">
                    <option value="">Select country</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country->country }}">{{ $country->country }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <h2 class="mb-3 mt-5">Mailling Address</h2>
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
        <div class="form-group d-sm-flex mb-2">
            <label for="county">Country</label>
            <div>
                <input type="text" name="country" value="" class="w-100 ml-sm-3 form-control">
            </div>
        </div>

        <h2 class="mb-3 mt-5">Postage</h2>
        <p>Please choose the level of expedited postage or tracking you would like your documents to be mailed to you with. Express mail is highly recommended to ensure receipt of your document. If you don’t order express mail, you risk the document not arriving and having to pay the Apostille fee again. We are not responsible for documents lost in the mail.</p>
        <div class="overflow-auto mb-2">
            <table class="table-styling w-100 enlarge-input">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Price (each)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input class="form-check-input" type="Radio" name="payment_for_postage" value="priority_international">
                            <h3 class="mb-0 mt-1">Priority Mail International</h3>
                            <p class="mb-1">6-10 business days to arrive, customs tracking until it leaves the U.S., but not past that.</p>
                        </td>
                        <td>${{ getFeeDetails('priority_international') }}</td>
                    </tr>
                    <tr>
                        <td><input class="form-check-input" type="Radio" name="payment_for_postage" value="express_international" required>
                            <h3 class="mb-0 mt-1">Priority Mail Express International</h3>
                            <p class="mb-1">3-5 business days to arrive, tracking door to door, $100 insurance included.</p>
                        </td>
                        <td>${{ getFeeDetails('express_international') }}</td>
                    </tr>
                    <tr>
                        <td><input class="form-check-input" type="Radio" name="payment_for_postage" value="united_postal_service">
                            <h3 class="mb-0 mt-1">United Postal Service (UPS)</h3>
                            <p class="mb-1">6-10 business days to arrive, customs tracking until it leaves the U.S., but not past that.</p>
                        </td>
                        <td>${{ getFeeDetails('united_postal_service') }}</td>
                    </tr>
                    <tr>
                        <td><input class="form-check-input" type="Radio" name="payment_for_postage" value="global_guaranteed_international">
                            <h3 class="mb-0 mt-1">Global Express Guaranteed</h3>
                            <p class="mb-1">6-10 business days to arrive, customs tracking until it leaves the U.S., but not past that.</p>
                        </td>
                        <td>${{ getFeeDetails('global_guaranteed_international') }}</td>
                    </tr>
                    <tr>
                        <td><input class="form-check-input" type="Radio" name="payment_for_postage" value="priority_usa">
                            <h3 class="mb-0 mt-1">USA Domestic Priority Mail</h3>
                        </td>
                        <td>${{ getFeeDetails('priority_usa') }}</td>
                    </tr>
                    <tr>
                        <td><input class="form-check-input" type="Radio" name="payment_for_postage" value="express_usa">
                            <h3 class="mb-0 mt-1">USA Domestic Priority Mail Express</h3>
                        </td>
                        <td>${{ getFeeDetails('express_usa') }}</td>
                    </tr>
                    <tr>
                        <td><input class="form-check-input" type="Radio" name="payment_for_postage" value="usa_domestic_prioirity_mail">
                            <h3 class="mb-0 mt-1">USA Domestic First Class Mail</h3>
                        </td>
                        <td>${{ getFeeDetails('usa_domestic_prioirity_mail') }}</td>
                    </tr>
                </tbody>
            </table>
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
</script>