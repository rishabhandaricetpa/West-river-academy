@extends('admin.app')

@section('content')

<section class="content">
    <div class="container-fluid position-relative">
        <h1>Custom Letter Details</h1>
        <div class="form-wrap border py-5 px-25 position-relative">
            <!-- form start -->
            <h3>Payment Status of Parent : {{$customLetter->ParentProfile->p1_first_name}}
                <h3>

                    <form method="post" class="row" action="{{route('admin.update.customletter',$customLetter->id)}}">

                        @csrf
                        <div class="form-group col-sm-6">
                            <label>Parent Name<sup>*</sup></label>
                            <input name="parent_name" class="form-control" value="{{$customLetter->ParentProfile->p1_first_name}}" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Transaction Id<sup>*</sup></label>
                            <input class="form-control" value="{{$customLetter->transcation_id}}" name="transcation_id">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Payment Method<sup>*</sup></label>
                            <input class="form-control" id="amount" value="{{$customLetter->payment_mode}}" name="payment_mode">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Amount<sup>*</sup></label>
                            <input class="form-control" id="amount" value="{{$customLetter->amount}}" name="amount">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Requested Quantity<sup>*</sup></label>
                            <input class="form-control" id="quanity" value="{{ getCustomLetterQuantity($customLetter->amount) }}" name="quanity" disabled>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Payment Status<sup>*</sup></label>
                            <select name="paymentStatus" class="form-control">
                                <option value="pending" @if($customLetter->status == 'pending')
                                    selected="selected" @endif>Pending</option>
                                <option valu e="paid" @if($customLetter->status== 'paid')
                                    selected="selected" @endif>Paid</option>
                                <option value="active" @if($customLetter->status == 'active')
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