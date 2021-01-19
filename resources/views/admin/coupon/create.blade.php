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
          <div class="row form-group">
            <div class="col-6">
              <label for="exampleInputEmail1">Coupon Code:</label>
              <div class="row">
                <input type="text" class="form-control col-6" id="code" placeholder="Enter coupon code">
                <button type="button" id="generate-code" class="btn ml-2 w-50 col-4 btn-sm btn-info"> Generate Code</button>
              </div>
            </div>
            <div class="col-4">
              <label for="exampleInputEmail1">Amount:</label>
              <input type="number" class="form-control" id="amount" placeholder="Enter coupon amount">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-6">
              <label for="exampleInputEmail1">Redeem Count:</label>
              <input type="number" class="form-control w-50" id="redeem" placeholder="limit the times coupon can be used">
            </div>
            <div class="col-4">
              <label for="exampleInputEmail1">Expire at:</label>
              <input type="date" class="form-control" id="expire">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-6">
              <label for="exampleInputEmail1">Assign to:</label>
              <input type="text" class="form-control" id="assign" placeholder="enter user">
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