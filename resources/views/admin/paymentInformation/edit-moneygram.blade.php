@extends('admin.app')

@section('content')
<section class="content">
  <div class="container-fluid position-relative">
    <h1>Edit Money Gram Address</h1>
    <div class="form-wrap border py-5 px-25 position-relative">
      <form method="post" class="row" action="{{url('admin/update/moneygram',$moneyGram->id)}}">
        @csrf

        <div class="form-group col-sm-6">
          <label>User Status<sup>*</sup></label>
          <select id="status" name="status" class="form-control" value="{{$moneyGram->status==1?'Active':'Inactive'}}" required>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
        <div class="form-group col-sm-6">
          <label>Name<sup>*</sup></label>
          <input class="form-control" id="name" value="{{$moneyGram->name}}" name="name" required>
        </div>
        <div class="form-group col-sm-6">
          <label>Address</label>
          <input class="form-control" id="address" name="address" value="{{$moneyGram->address}}" required>
        </div>
        <div class="form-group col-sm-6">
          <label>City <sup>*</sup></label>
          <input class="form-control" id="city" name="city" value="{{$moneyGram->city}}" required>
        </div>
        <div class="form-group col-sm-6">
          <label>State</label>
          <input class="form-control" name="state" id="state" value="{{$moneyGram->state}}" required>
        </div>
        <div class="form-group col-sm-6">
          <label>Zip Code</label>
          <input class="form-control" id="zip" name="zip" value="{{$moneyGram->zip}}" required>
        </div>
        <div class="form-group col-sm-12">
          <label>ID</label>
          <input class="form-control" id="money_gram_id" name="money_gram_id" value="{{$moneyGram->money_gram_id}}" required>
        </div>

        <div class="col-sm-12">
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="/admin/payment-address" class="btn btn-primary">Back</a>
        </div>
      </form>
    </div>
  </div>
  </div>
</section>

@endsection