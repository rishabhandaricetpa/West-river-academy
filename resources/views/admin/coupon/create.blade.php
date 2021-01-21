@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Generate Coupon</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <form action="{{ route('admin.store.coupon') }}" method="post">
          @csrf
          <div class="row form-group">
            <div class="col-6">
              <label for="generate-code">Coupon Code <small>(required)</small>:</label>
              <div class="row">
                <input type="text" class="form-control col-6" required id="code" placeholder="Enter coupon code">
                <button type="button" id="generate-code" class="btn ml-2 w-50 col-4 btn-sm btn-info"> Generate Code</button>
              </div>
            </div>
            <div class="col-4">
              <label for="amount">Amount <small>(required)</small>:</label>
              <input type="number" class="form-control" required id="amount" placeholder="Enter coupon amount">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-6">
              <label for="redeem">Redeem Count <small>(blank for no limit)</small>:</label>
              <input type="number" class="form-control w-50" id="redeem" placeholder="limit the times coupon can be used">
            </div>
            <div class="col-4">
              <label for="expire">Expire at <small>(blank for no limit)</small>:</label>
              <input type="date" class="form-control" id="expire">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-8 ">
              <label for="assign-select">Assign to <small>(blank for no limit)</small>:</label>
              <select name="assign[]" class="form-control select2-multiple" multiple="multiple" id="assign-select">
                @foreach ($parents as $parent)
                  <option value="{{ $parent['id'] }}">{{ $parent['p1_email'] }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-success" value="Save Coupon">
          </div>
        </form>

      </div>
    </section>
  <!-- /.content -->
@endsection