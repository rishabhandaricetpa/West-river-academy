@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid position-relative">
            <h1>Student List</h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                    <li class="breadcrumb-item active">Student List</li>
                </ol>
            </div>
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
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="#example-1" class="table table-bordered table-striped data-table"">
                                                                       <thead>
                                                                         <tr>   
                                                                   <th>Date</th>
                                                                    <th>Transcation Id </th>
                                                                    <th>Payment Mode</th>
                                                                   <th>Amount</th>
                                                                  <th>Orders</th>
                                                                </tr>
                                                                </thead>
                                                                 <tbody>                                                                                                                                                                                                                                                 
                                                                              @foreach ($transcations as $transcation)
                                <tr>
                                    <td>{{ $transcation->created_at->format('M j,Y') }}</td>
                                    <td>{{ $transcation->transcation_id }}</td>
                                    <td>{{ $transcation->payment_mode }}</td>
                                    <td>{{ $transcation->amount }}</td>
                                    <?php $values = getOrders($transcation->transcation_id); ?>

                                    <td>{{ $values }}</td>
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
