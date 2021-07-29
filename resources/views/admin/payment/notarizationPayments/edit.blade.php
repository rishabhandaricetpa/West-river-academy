@extends('admin.app')

@section('content')

    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Apostille And Notarization Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- form start -->
                <h3>Payment Status of Parent : {{ $notarizationData->ParentProfile->p1_first_name }} {{ $notarizationData->ParentProfile->p1_last_name }}
                    <h3>

                        <form method="post" class="row"
                            action="{{ route('admin.update.notarization', $notarizationData->id) }}">

                            @csrf
                            <div class="form-group col-sm-6">
                                <label>Parent Name<sup>*</sup></label>
                                <input name="parent_name" class="form-control"
                                    value="{{ $notarizationData->ParentProfile->p1_first_name }} {{ $notarizationData->ParentProfile->p1_last_name }}" disabled>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Transaction ID<sup>*</sup></label>
                                <input class="form-control" value="{{ $notarizationData->transcation_id }}"
                                    name="transcation_id">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Payment Method<sup>*</sup></label>
                                <input class="form-control" id="amount" value="{{ $notarizationData->payment_mode }}"
                                    name="payment_mode">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Amount<sup>*</sup></label>
                                <input class="form-control" type="number" min="0" id="amount"
                                    value="{{ $notarizationData->amount }}" name="amount" required>
                            </div>
                            @if ($notarizationData->notarization)
                                <div class="form-group col-sm-6">
                                    <label>Transcript Doc<sup>*</sup></label>
                                    <input class="form-control" id="amount"
                                        value="{{ $notarizationData->notarization->transcript_doc }}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Confirmation Doc<sup>*</sup></label>
                                    <input class="form-control" id="amount"
                                        value="{{ $notarizationData->notarization->confirmation_doc }}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Custom Letter Doc<sup>*</sup></label>
                                    <input class="form-control" id="amount"
                                        value="{{ $notarizationData->notarization->custom_doc }}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Postage Country<sup>*</sup></label>
                                    <input class="form-control" id="amount"
                                        value="{{ $notarizationData->notarization->country }}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Notes<sup></sup></label>
                                    <textarea class="form-control" name="notarization_message" disabled
                                        >{{$notarizationData->notarization->additional_message}}</textarea>
                                </div>
                            @endif
                            @if ($notarizationData->apostille)
                                <div class="form-group col-sm-6">
                                    <label>Transcript Doc<sup>*</sup></label>
                                    <input class="form-control" id="amount"
                                        value="{{ $notarizationData->apostille->transcript_doc }}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Confirmation Doc<sup>*</sup></label>
                                    <input class="form-control" id="amount"
                                        value="{{ $notarizationData->apostille->confirmation_doc }}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Custom Letter Doc<sup>*</sup></label>
                                    <input class="form-control" id="amount"
                                        value="{{ $notarizationData->apostille->custom_doc }}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Postage Country<sup>*</sup></label>
                                    <input class="form-control" id="amount"
                                        value="{{ $notarizationData->apostille->country }}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Notes<sup></sup></label>
                                    <textarea class="form-control" name="apostille_message" disabled
                                        >{{$notarizationData->apostille->additional_message}}</textarea>
                                </div>
                            @endif
                            <div class="form-group col-sm-6">
                                <label>Payment Status<sup>*</sup></label>
                                <select name="paymentStatus" class="form-control">
                                    <option value="pending" @if ($notarizationData->status == 'pending') selected="selected" @endif>Pending</option>
                                    <option value="paid" @if ($notarizationData->status == 'paid') selected="selected" @endif>Paid</option>
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
