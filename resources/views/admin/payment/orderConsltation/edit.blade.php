@extends('admin.app')

@section('content')

    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Order Consltation Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- form start -->
                <h3>Payment Status of Parent : {{ $order_conultation->parent->p1_first_name }}
                    <h3>

                        <form method="post" class="row"
                            action="{{ route('admin.update.conultation', $order_conultation->id) }}">

                            @csrf
                            <div class="form-group col-sm-6">
                                <label>Parent Name<sup>*</sup></label>
                                <input name="parent_name" class="form-control"
                                    value="{{ $order_conultation->parent->p1_first_name }}" disabled>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Transaction Id<sup>*</sup></label>
                                <input class="form-control" value="{{ $order_conultation->transcation_id }}"
                                    name="transcation_id">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Payment Method<sup>*</sup></label>
                                <input class="form-control" id="amount" value="{{ $order_conultation->payment_mode }}"
                                    name="payment_mode">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Amount<sup>*</sup></label>
                                <input class="form-control" type="number" min="0" id="amount"
                                    value="{{ $order_conultation->amount }}" name="amount" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Preferred Languages<sup>*</sup></label>
                                <input class="form-control" id="amount"
                                    value="{{ $order_conultation->preferred_language }}" name="preferred_language"
                                    required>
                            </div>
                            @if ($order_conultation->preferred_language === 'English')
                                <div class="form-group col-sm-6">
                                    <label>Call Type</label>
                                    <input class="form-control" id="amount" value="{{ $order_conultation->en_call_type }}"
                                        name="en_call_type">
                                </div>
                            @else
                                <div class="form-group col-sm-6">
                                    <label>Call Type</label>
                                    <input class="form-control" id="amount" value="{{ $order_conultation->sp_call_type }}"
                                        name="sp_call_type">
                                </div>
                            @endif
                            <div class="form-group col-sm-6">
                                <label>Consutation about</label>
                                <textarea class="form-control" id="amount"
                                    value="{{ $order_conultation->consulting_about }}" name="consulting_about"></textarea>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Payment Status<sup>*</sup></label>
                                <select name="paymentStatus" class="form-control">
                                    <option value="pending" @if ($order_conultation->status == 'pending') selected="selected" @endif>Pending</option>
                                    <option valu e="paid" @if ($order_conultation->status == 'paid') selected="selected" @endif>Paid</option>
                                    <option value="active" @if ($order_conultation->status == 'active') selected="selected" @endif>Active</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection
