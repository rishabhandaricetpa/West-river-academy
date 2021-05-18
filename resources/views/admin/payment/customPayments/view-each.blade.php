@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid position-relative">
            <h1>Custom Payment List</h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                    <li class="breadcrumb-item active">Custom Payment List</li>
                </ol>
            </div><!-- /.col -->
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
                            <table id="example1" class="table table-bordered table-striped data-table">
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
                                    @foreach ($customPaymentsData as $allcustomPayment)
                                        <tr>
                                            <td>{{ $allcustomPayment->ParentProfile->p1_first_name }}{{ $allcustomPayment->ParentProfile->p1_last_name }}
                                            </td>
                                            <td>{{ $allcustomPayment->amount }}</td>
                                            <td>{{ $allcustomPayment->paying_for }}</td>
                                            <td>{{ $allcustomPayment->transction_id }} </td>
                                            <td>{{ $allcustomPayment->payment_mode }} </td>
                                            <td>{{ $allcustomPayment->status }} </td>
                                            <td>
                                                <a href="{{ route('admin.edit.custompayment', $allcustomPayment->id) }}"><i
                                                        class="fas fa-edit"></i></a>
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
        if (!confirm("Are You Sure to delete this"))
            event.preventDefault();
    }

</script>
