@extends('layouts.app')
@section('pageTitle', 'Purchase Postage')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<main class="position-relative container form-content mt-4 label-styling label-md">
  <h1 class="text-center text-white text-uppercase">order postage</h1>
  <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
    <form method="POST" action="{{ route('add.cart') }}">
      @csrf
      <input type="hidden" name="type" id="postage" value="postage" class="w-100" step="0.01">
      <p>Select the country you are shipping to. We only ship Express outside the US.</p>
      <div class="form-row px-0">
        <div class="form-group col-lg-6 col-xl-3 d-md-flex">
          <label for="inputState">Country</label>
          <select name="country_name" id="country_name" class="form-control" onchange="getPostageCharges(event)">
            <option value="">Select country</option>
            @foreach ($countries as $country)
            <option value="{{ $country->country }}">{{ $country->country }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group  col-lg-3 d-md-flex ml-lg-auto">
          <p class="pr-md-3 space-pre ml-auto">Total Due:</p>
          <div class="d-flex">
            <i class="fas fa-dollar-sign additional-sign"></i>
            <input type="text" class="form-control" id="postage_charges" name="postage_charges">
          </div>
        </div>
      </div>
      <div id="select-us">
        <p>If country is US:</p>
        <div class="form-row px-0 seperator-top">

          <div class="form-group  col-lg-3  d-md-flex">
            <label for="inputCity">Country</label>
            <input type="text" class="form-control" id="country_name_usa" name="country_name_usa">
          </div>
          <div class="form-group  col-lg-3  d-md-flex">
            <label for="inputZip">Zip</label>
            <input type="text" class="form-control" id="Zip" name="zip">
          </div>
          <div class="form-group  col-lg-3  d-md-flex">
            <label for="inputState">Postage Type</label>
            <select id="postage_type" class="form-control" onchange="getUSAFees(event)">
              <option selected="" value="">Select Potage Type</option>
              <option value="express_usa">Express</option>
              <option value="priority_usa">Priority</option>
            </select>
          </div>
          <div class="form-group  col-lg-3  d-md-flex">
            <p class="pr-md-3 space-pre ml-auto">Total Due:</p>
            <div class="d-flex">
              <i class="fas fa-dollar-sign additional-sign"></i>
              <input type="text" class="form-control" id="usa_shiiping" name="usa_shiiping">
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="form-wrap border bg-light py-5 px-25 dashboard-info mt-4">
    <a href="/dashboard" class="btn btn-primary" role="button">cancel</a>
    <button type="submit" class="btn btn-primary ml-auto">Add to cart</button>
  </div>
  </div>
  </div>
  </form>
</main>
@endsection

<script>
  function getPostageCharges(e) {
    var country_name = e.target.value;
    if (country_name === 'United States') {
      document.getElementById("country_name_usa").value = country_name
      $("#select-us").show();
    }
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
      url: "{{ url('postage/type')}}",
      type: "POST",
      data: {
        postage_type: postage_type,
      },
      success: function(response) {
        if (response) {
          $("#usa_shiiping").val(response);
        }

      }
    });
  }
</script>