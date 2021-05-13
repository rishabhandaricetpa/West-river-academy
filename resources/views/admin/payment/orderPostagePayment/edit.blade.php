@extends('admin.app')

@section('content')

    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Order Postage Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- form start -->
                <h3>Payment Status of Parent : {{ $orderPostageData->ParentProfile->p1_first_name }}
                    <h3>

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
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('admin.order.postage')}}" class="btn btn-primary">Back</a>
                            </div>
                        </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection
