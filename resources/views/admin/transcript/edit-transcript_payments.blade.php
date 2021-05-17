@extends('admin.app')

@section('content')

    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Transcript Payment Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- form start -->
                <h3>Payment Status of Student: {{ $geteachtranscriptPayments->transcript->student->fullname }}
                    <h3>
                        <form action="{{ route('admin.update.transcriptpay', $geteachtranscriptPayments->id) }}"
                            method="post" class="row">
                            @csrf
                            <div class="form-group col-sm-6">
                                <label>Student Name<sup>*</sup></label>
                                <input name="parent_name" class="form-control"
                                    value="{{ $geteachtranscriptPayments->transcript->student->fullname }}" disabled>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Transcript Period<sup>*</sup></label>
                                <input class="form-control" value="{{ $geteachtranscriptPayments->transcript->period }}"
                                    name="transcation_id">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Transaction Id<sup>*</sup></label>
                                <input class="form-control" value="{{ $geteachtranscriptPayments->transcation_id }}"
                                    name="transcation_id">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Payment Method<sup>*</sup></label>
                                <input class="form-control" id="amount"
                                    value="{{ $geteachtranscriptPayments->payment_mode }}" name="payment_mode" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Amount<sup>*</sup></label>
                                <input class="form-control" id="amount" value="{{ $geteachtranscriptPayments->amount }}"
                                    name="amount">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Payment Status<sup>*</sup></label>
                                <select name="paymentStatus" class="form-control">
                                    <option value="pending" @if ($geteachtranscriptPayments->status == 'pending') selected="selected" @endif>Pending</option>
                                    <option valu e="paid" @if ($geteachtranscriptPayments->status == 'paid') selected="selected" @endif>Paid</option>
                                </select>
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
                                <a href="{{route('admin.transcript.payments')}}" class="btn btn-primary">Back</a>
                            </div>
                        </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection
