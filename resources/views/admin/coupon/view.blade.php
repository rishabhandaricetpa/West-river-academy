@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid position-relative">
            <h1 class="text-center">Coupon Management</h1>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           <!-- /.card-header -->
            <div class="card">
              <div class="card-header">
                <a href="{{ route('admin.create.coupon') }}" class="btn btn-primary"> Generate New Coupon </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="coupons-table" class="table table-bordered table-striped data-table">
                  <thead>
                  <tr>
                    <th>Sno</th>
                    <th>Code</th>
                    <th>Amount</th>
                    <th>Status</th>
                    {{-- <th>Redeem left</th> --}}
                    <th>Expire at</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
  </div>
    <!-- /.content -->
@endsection
<script>
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }

 </script>