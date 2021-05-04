@extends('admin.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid position-relative">
        <h1 class="text-center">Notarization & Apostille Payments List</h1>
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
                        <div class="overflow-auto">
                        <table id="notarization-table" class="w-100 data-table table-styling">
                            <thead>
                                <tr>
                                    <th>Parent Name</th>
                                    <th>Amount Paid</th>
                                    <th>Paying for</th>
                                    <th>Transaction Id</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
</div>
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
