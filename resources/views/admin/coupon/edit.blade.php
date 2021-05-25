@extends('admin.app')

@section('content')
    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Edit Coupon</h1>
            <div class="form-wrap border py-5 px-25 position-relative generate-Coupon">
                <form action="{{ route('admin.update.coupon', $coupon->id) }}" class="row" method="post">
                    @csrf
                    @method('put')
                    <div class="col-sm-6 form-group">
                        <label for="generate-code">Coupon Code <small>(required)</small>:</label>
                        <div class="d-sm-flex w-100">
                            <input type="text" class="form-control col-6" value="{{ $coupon->code }}" required id="code"
                                name="code" placeholder="Enter coupon code">
                            <button type="button" id="generate-code" class="btn ml-2 w-50 col-4 btn-sm btn-info"> Generate
                                Code</button>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="amount">Amount <small>(required)</small>:</label>
                        <input type="number" class="form-control" min="0" required id="amount"
                            value="{{ $coupon->amount }}" name="amount" placeholder="Enter coupon amount">
                    </div>

                    {{-- <div class="col-4">
              <label for="redeem">Redeem Count <small>(blank for no limit)</small>:</label>
              <input type="number" class="form-control w-50" min="0" id="redeem" name="redeem_left" value="{{ $coupon->redeem_left }}" placeholder="limit the times coupon can be used">
    </div> --}}
                    <div class="col-sm-6 form-group">
                        <label for="expire">Expiration Date <small>(blank for no limit)</small>:</label>
                        <input type="text" class="form-control w-50 datepicker" id="expire_at"
                            value="{{ Carbon\Carbon::parse($coupon->expire_at)->format('M d Y') }}" name="expire_at">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="status">Status :</label>
                        <select name="status" id="status" class="form-control w-50">
                            <option @if ($coupon->status == 'active') selected @endif value="active">Active</option>
                            <option @if ($coupon->status == 'inactive') selected @endif value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="description">Description <small>(optional)</small>:</label>
                        <textarea name="description" placeholder="Enter description.." class="w-100" id="description"
                            cols="80" rows="2" maxlength="2000">{{ $coupon->description }}</textarea>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="assign-select">Assign to <small>(blank for no limit)</small>:</label>
                        <select name="assign[]" class="form-control select2-multiple" multiple="multiple"
                            id="assign-select">
                            @foreach ($parents as $parent)
                                <option @if (in_array($parent['id'], $coupon->coupon_for)) selected @endif value="{{ $parent['id'] }}">
                                    {{ $parent['p1_email'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12 mt-4">
                        <input type="submit" class="btn btn-primary" value="Save Coupon">
                        <a onclick="goBack()" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
