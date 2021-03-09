@extends('admin.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid position-relative">
        <h1 class="text-center">Custom Payments</h1>
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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="custom-table" class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>Sno</th>
                                    <th>Parent Name</th>
                                    <th>Amount Paid</th>
                                    <th>Paying for</th>
                                    <th>Transaction Id</th>
                                    <th>Payment Mode</th>
                                    <th>Status</th>
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