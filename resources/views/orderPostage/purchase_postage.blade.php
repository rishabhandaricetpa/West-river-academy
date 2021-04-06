@extends('layouts.app')
@section('pageTitle', 'Purchase Postage')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4 label-styling label-md">
    <h1 class="text-center text-white text-uppercase">order postage</h1>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
            <form method="POST" action="{{ route('add.cart') }}">
                @csrf
                <input type="hidden" name="type" id="postage" value="postage" class="w-100" step="0.01">
                <p>Select the country you are shipping to. We only ship Express outside the US.</p>
                <div class="form-row col-md-10">
                    <div class="form-group col-md-9">
                        <select name="country_name" id="country_name" class="form-control col-md-4" onchange="getPostageCharges(event)">
                            <option value="">Select country</option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->country }}">{{ $country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3 d-md-flex">
                        <p class="pr-md-3 space-pre">Total Due:</p>
                        <div class="d-flex">
                            <i class="fas fa-dollar-sign additional-sign"></i>
                            <input type="text" class="form-control" id="postage_charges" name="postage_charges">
                        </div>
                    </div>
                </div>
                <div>
                    <p>If country is US:</p>
                    <div class="form-row col-md-10">
                        <div class="form-group col-md-10 form-row">
                            <select id="inputState" class="form-control col-md-4 mr-5">
                                <option selected="">United States of America</option>
                                <option>...</option>
                            </select>
                            <input type="text" class="form-control col-md-2 ml-4" id="inputZip">
                        </div>

                    </div>
                    <div class="form-row col-md-10">
                        <div class="form-group col-md-9 form-row">
                            <select id="postage_type" class="form-control col-md-2  offset-md-6" onchange="(event)">
                                <option selected="" value="express_usa">Express</option>
                                <option value="priority_usa">Priority</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 d-md-flex">
                            <p class="pr-md-3 space-pre">Total Due:</p>
                            <div class="d-flex">
                                <i class="fas fa-dollar-sign additional-sign"></i>
                                <input type="text" class="form-control" id="inputZip" name="usa_shiiping">

                            </div>

                        </div>
                    </div>
                </div>
        </div>
        <div class=" form-wrap border bg-light py-5 px-25 mb-4">
            <a href="/dashboard" class="btn btn-primary" role="button">cancel</a>
            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </div>
        </form>
</main>
@endsection

<script>
    function getPostageCharges(e) {
        var country_name = e.target.value;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('country/shipping')}}",
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

    function getUSAFees(e) {
        var postage_type = e.target.value;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('postage/type')}}",
            type: "POST",
            data: {
                postage_type: postage_type,
            },
            success: function(response) {
                if (response) {
                    $("#postage_charges").val(response.postage_charges);
                }
            }
        });
    }
</script>