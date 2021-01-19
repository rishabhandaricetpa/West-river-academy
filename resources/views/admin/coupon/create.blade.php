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
          <div class="row">
            <div class="col-12">
                  
            </div>
        </form>
      </div>
    </section>
  </div>
  <!-- /.content -->
@endsection