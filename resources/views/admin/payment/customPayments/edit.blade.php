@extends('admin.app')

@section('content')

    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Custom Payment Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- form start -->
                <h3>Payment Status of Parent : {{ $customPaymentsData->ParentProfile->p1_first_name }}
                    <h3>

                        <form method="post" class="row"
                            action="{{ route('update.custompayment', $customPaymentsData->id) }}">

                            @csrf
                            <div class="form-group col-sm-6">
                                <label>Parent Name<sup>*</sup></label>
                                <input name="parent_name" class="form-control"
                                    value="{{ $customPaymentsData->ParentProfile->p1_first_name }}" disabled>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Transaction Id<sup>*</sup></label>
                                <input class="form-control" value="{{ $customPaymentsData->transcation_id }}"
                                    name="transcation_id">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Payment Method<sup>*</sup></label>
                                <input class="form-control" id="amount" value="{{ $customPaymentsData->payment_mode }}"
                                    name="payment_mode">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Amount<sup>*</sup></label>
                                <input class="form-control" type="number" min="0" id="amount"
                                    value="{{ $customPaymentsData->amount }}" name="amount" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Payment Status<sup>*</sup></label>
                                <select name="paymentStatus" class="form-control">
                                    <option value="pending" @if ($customPaymentsData->status == 'pending') selected="selected" @endif>Pending</option>
                                    <option value="paid" @if ($customPaymentsData->status == 'paid') selected="selected" @endif>Paid</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Paid For</label>
                                <textarea class="form-control" id="paying_for" value="{{ $customPaymentsData->paying_for }}"
                                    name="paying_for">{{ $customPaymentsData->paying_for }}</textarea>
                            </div>
                            @if($transactionData)
                            <div class="form-group col-sm-6">
                                <label>Coupon Applied<sup>*</sup></label>
                                <input name="coupon_code" id="coupon_code" class="form-control datepicker"
                                    value="{{$transactionData->coupon_code}}"
                                    disabled>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Coupon Amount<sup>*</sup></label>
                                <input name="coupon_amount" id="coupon_amount" class="form-control datepicker"
                                    value="{{$transactionData->coupon_amount}}"
                                    disabled>
                            </div>
                            @endif
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('admin.custom.payments')}}" class="btn btn-primary">Back</a>
                            </div>
                        </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection
