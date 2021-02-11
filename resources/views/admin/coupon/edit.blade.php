@extends('admin.app')

@section('content')
<section class="content">
<div class="container-fluid position-relative">
              <h1>Edit Coupon</h1>
              <div class="form-wrap border py-5 px-25">
          <form action="{{ route('admin.update.coupon',$coupon->id) }}" method="post">
          @csrf
          @method('put')
          <div class="form-group col-sm-6">
              <label for="generate-code">Coupon Code <small>(required)</small>:</label>
                <input type="text" class="form-control col-6" value="{{ $coupon->code }}" required id="code" name="code" placeholder="Enter coupon code">
          </div>
          <div class="form-group col-sm-6">
                <button type="button" id="generate-code" class="btn ml-2 w-50 col-4 btn-sm btn-info"> Generate Code</button>
          </div>
          <div class="form-group col-sm-6">
              <label for="amount">Amount <small>(required)</small>:</label>
              <input type="number" class="form-control" min="0" required id="amount" value="{{ $coupon->amount }}" name="amount" placeholder="Enter coupon amount">
          </div>

            <div class="row form-group">
            {{-- <div class="col-4">
              <label for="redeem">Redeem Count <small>(blank for no limit)</small>:</label>
              <input type="number" class="form-control w-50" min="0" id="redeem" name="redeem_left" value="{{ $coupon->redeem_left }}" placeholder="limit the times coupon can be used">
            </div> --}}
            <div class="form-group col-sm-6">
              <label for="expire">Expire at <small>(blank for no limit)</small>:</label>
              <input type="date" class="form-control w-50" id="expire_at" value="{{ $coupon->expire_at }}" name="expire_at">
            </div>
            <div class="form-group col-sm-6">
              <label for="status">Status :</label>
              <select name="status" id="status" class="form-control w-50">
                <option @if ($coupon->status == 'active') selected @endif value="active">Active</option>
                <option @if ($coupon->status == 'inactive') selected @endif value="inactive">Inactive</option>
              </select>
            </div>
          </div>

          <div class="form-group col-sm-6">
              <label for="description">Description <small>(optional)</small>:</label>
              <textarea name="description" placeholder="Enter description.." class="w-100" id="description" cols="80" rows="2">{{ $coupon->description }}</textarea>
          </div>

          <div class="form-group col-sm-6">
              <label for="assign-select">Assign to <small>(blank for no limit)</small>:</label>
              <select name="assign[]" class="form-control select2-multiple" multiple="multiple" id="assign-select">
                @foreach ($parents as $parent)
                  <option @if ( in_array($parent['id'], $coupon->coupon_for)) selected @endif value="{{ $parent['id'] }}">{{ $parent['p1_email'] }}</option>
                @endforeach
              </select>
          </div>
          <div class="col-sm-12">
            <input type="submit" class="btn btn-primary" value="Save Coupon">
          </div>
        </form>
      </div>
      </div>
    </section>
  <!-- /.content -->
@endsection