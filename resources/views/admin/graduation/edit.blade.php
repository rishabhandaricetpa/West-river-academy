@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Graduation</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="" method="post">
          @csrf
          @method('put')
          <div class="row form-group">
            <div class="col-4">
              Student Name: {{ $graduation->student->fullname }}
            </div>
            <div class="col-4">
              Student Email: {{ $graduation->student->email }}
            </div>
            <div class="col-4">
              Birthdate: {{ $graduation->student->birthdate }}
            </div>
          </div>
         
          <div class="row form-group">
            <div class="col-12">
              Parent Email: {{ $graduation->parent->p1_email }}
            </div>
          </div>

          <div class="row form-group">
            <div class="col-6">
              <label for="generate-code">Coupon Code <small>(required)</small>:</label>
              <div class="row">
                {{-- <input type="text" class="form-control col-6" value="{{ $coupon->code }}" required id="code" name="code" placeholder="Enter coupon code"> --}}
              </div>
            </div>
            <div class="col-4">
              <label for="amount">Amount <small>(required)</small>:</label>
              {{-- <input type="number" class="form-control" min="0" required id="amount" value="{{ $coupon->amount }}" name="amount" placeholder="Enter coupon amount"> --}}
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