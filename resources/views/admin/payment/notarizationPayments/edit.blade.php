@extends('admin.app')

@section('content')

<section class="content">
    <div class="container-fluid position-relative">
        <h1>Apostille And Notrization Details</h1>
        <div class="form-wrap border py-5 px-25 position-relative">
            <!-- form start -->
            <h3>Payment Status of Parent : {{$notarizationData->ParentProfile->p1_first_name}}
                <h3>

                    <form method="post" class="row" action="{{route('admin.update.notarization',$notarizationData->id)}}">

                        @csrf
                        <div class="form-group col-sm-6">
                            <label>Parent Name<sup>*</sup></label>
                            <input name="parent_name" class="form-control" value="{{$notarizationData->ParentProfile->p1_first_name}}" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Transaction Id<sup>*</sup></label>
                            <input class="form-control" value="{{$notarizationData->transcation_id}}" name="transcation_id">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Payment Method<sup>*</sup></label>
                            <input class="form-control" id="amount" value="{{$notarizationData->payment_mode}}" name="payment_mode">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Amount<sup>*</sup></label>
                            <input class="form-control" id="amount" value="{{$notarizationData->amount}}" name="amount">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Apostille Country<sup>*</sup></label>
                            <input class="form-control" value="{{$notarizationData->notarization->apostille_country}}" name="transcation_id">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Transcript Doc<sup>*</sup></label>
                            <input class="form-control" id="amount" value="{{$notarizationData->notarization->transcript_doc}}" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Confirmation Doc<sup>*</sup></label>
                            <input class="form-control" id="amount" value="{{$notarizationData->notarization->confirmation_doc}}" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Custom Letter Doc<sup>*</sup></label>
                            <input class="form-control" id="amount" value="{{$notarizationData->notarization->custom_doc}}" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Postage Country<sup>*</sup></label>
                            <input class="form-control" id="amount" value="{{$notarizationData->notarization->country}}" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Payment Status<sup>*</sup></label>
                            <select name="paymentStatus" class="form-control">
                                <option value="pending" @if($notarizationData->status == 'pending')
                                    selected="selected" @endif>Pending</option>
                                <option valu e="paid" @if($notarizationData->status== 'paid')
                                    selected="selected" @endif>Paid</option>
                                <option value="active" @if($notarizationData->status == 'active')
                                    selected="selected" @endif>Active</option>
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