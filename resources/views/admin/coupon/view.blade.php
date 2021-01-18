@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Coupon Management</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
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
                {{-- <h3 class="card-title">DataTable with default features</h3> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped data-table"">
                  <thead>
                  <tr>
                    <th>Code</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Redeem left</th>
                    <th>Expire at</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($coupons as $coupon)
                  <tr>
                    <td>{{$coupon->code}}</td>
                    <td>{{$coupon->amount}}</td>
                    <td>{{$coupon->status}}</td>
                    <td>{{$coupon->redeem_left}}</td>
                    <td>{{$coupon->expire_at->format('d M')}}</td>
                    <td>
                        {{-- <a href="{{ url('admin/coupon',$item->id)}}"> <i class="fas fa-edit"></i></a> --}}
                        {{-- <a href="{{ url('admin/delete',$item->id)}}"><i class="fas fa-trash-alt" onclick="return myFunction();"></i> --}}
                    </td>
                  </tr>
                  @endforeach
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