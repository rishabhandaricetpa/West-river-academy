@extends('admin.app')

@section('content')


<!-- Main content -->
<section class="content">
  <div class="container-fluid position-relative">
    <h1 class="text-center">Generate Coupon</h1>
    <div class="form-wrap border py-5 px-25 position-relative generate-Coupon">
      <form action="{{ route('admin.store.coupon') }}" class="row" method="post">
        @csrf
        <div class="col-sm-6 form-group">
          <label for="generate-code">Coupon Code <small>(required)</small>:</label>
          <div class="d-sm-flex w-100">
            <input type="text" class="form-control" required id="code" name="code" placeholder="Enter coupon code">
            <button type="button" id="generate-code" class="btn btn-secondary text-uppercase mt-3 mt-sm-0 ml-sm-3"> Generate Code</button>
          </div>
        </div>
        <div class="col-sm-6 form-group">
          <label for="amount">Amount <small>(required)</small>:</label>
          <input type="number" class="form-control" min="0" required id="amount" name="amount" placeholder="Enter coupon amount">
        </div>



        {{-- <div class="col-sm-4 form-group">
              <label for="redeem">Redeem Count <small>(blank for no limit)</small>:</label>
              <input type="number" class="form-control" min="0" id="redeem" name="redeem_left" placeholder="limit the times coupon can be used">
            </div> --}}
        <div class="col-sm-4 form-group">
          <label for="expire">Expire at <small>(blank for no limit)</small>:</label>
          <input type="date" class="form-control" id="expire_at" name="expire_at">
        </div>
        <div class="col-sm-4 form-group">
          <label for="status">Status :</label>
          <select name="status" id="status" class="form-control">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
        <div class="col-sm-4 form-group">
          <label for="description">Description <small>(optional)</small>:</label>
          <textarea name="description" placeholder="Enter description.." class="w-100" id="description" cols="80" rows="2"></textarea>
        </div>

        <div class="form-group col-sm-12">
          <label for="assign-select" class="w-100">Assign to <small>(blank for no limit)</small>:</label>
          <select name="assign[]" class="form-control select2-multiple mb-3" multiple="multiple" id="assign-select">
            @foreach ($parents as $parent)
            <option value="{{ $parent['id'] }}">{{ $parent['p1_email'] }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group col-sm-12 mt-4">
          <input type="submit" class="btn btn-primary" value="Save Coupon">
        </div>
      </form>
    </div>
  </div>
</section>
<!-- /.content -->
@endsection