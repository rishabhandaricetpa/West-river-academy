@extends('admin.app')

@section('content')

    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Order Postage Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- form start -->
                        <h3 class="pr-3"> Payment Status of Parent :<a
                            href="{{ route('admin.parent.edit', $orderPostageData->parent_profile_id) }}">{{ $orderPostageData->ParentProfile->p1_first_name }}</a>
                        </h3>
                        <form method="post" class="row"
                            action="{{ route('admin.update.orderpostage', $orderPostageData->id) }}">

                            @csrf
                            <div class="form-group col-sm-6">
                                <label>Parent Name<sup>*</sup></label>
                                <input name="parent_name" class="form-control"
                                    value="{{ $orderPostageData->ParentProfile->p1_first_name }}" disabled>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Transaction Id<sup>*</sup></label>
                                <input class="form-control" value="{{ $orderPostageData->transcation_id }}"
                                    name="transcation_id">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Payment Method<sup>*</sup></label>
                                <input class="form-control" id="amount" value="{{ $orderPostageData->payment_mode }}"
                                    name="payment_mode">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Amount<sup>*</sup></label>
                                <input class="form-control" id="amount" type="number" min="0"
                                    value="{{ $orderPostageData->amount }}" name="amount" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Payment Status<sup>*</sup></label>
                                <select name="paymentStatus" class="form-control">
                                    <option value="pending" @if ($orderPostageData->status == 'pending') selected="selected" @endif>Pending</option>
                                    <option valu e="paid" @if ($orderPostageData->status == 'paid') selected="selected" @endif>Paid</option>
                                </select>
                            </div>
                            @if ($transactionData)
                                <div class="form-group col-sm-6">
                                    <label>Coupon Applied<sup>*</sup></label>
                                    <input name="coupon_code" id="coupon_code" class="form-control datepicker"
                                        value="{{ $transactionData->coupon_code }}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Coupon Amount<sup>*</sup></label>
                                    <input name="coupon_amount" id="coupon_amount" class="form-control datepicker"
                                        value="{{ $transactionData->coupon_amount }}" disabled>
                                </div>
                            @endif
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a onclick="goBack()" class="btn btn-primary">Back</a>
                            </div>
                        </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection
