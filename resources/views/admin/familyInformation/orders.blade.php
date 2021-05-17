@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid position-relative">
            <h1 class="m-0 text-center">Parent</h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                    <li class="breadcrumb-item active">Parent</li>
                </ol>
            </div><!-- /.container-fluid -->
        </div>
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
                            <a href="{{route('admin.view.parent')}}" class="btn btn-primary">Back</a>
                        </div>
                        <!-- /.card-header -->

                        @if (count($customPayments) > 0)
                            <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                                <h2 class="mb-3">Paid For: Custom Payment</h2>
                                <div class="overflow-auto max-table">
                                    <table class="table-styling w-100 table-vertical_scroll">
                                        <thead>
                                            <tr>
                                                <th scope="col">Parent Name</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Transcation Id</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customPayments as $customPayment)
                                                <tr>

                                                    <td>{{ $customPayment['ParentProfile']['p1_first_name'] }}</td>
                                                    <td>${{ $customPayment['amount'] }}</td>
                                                    <td>{{ $customPayment['payment_mode'] }}</td>
                                                    <td>{{ $customPayment['transcation_id'] }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                    </div>

                                </div>
                            </div>
                        @endif


                        <!-- Enrollment Payment History Start-->
                        @if (count($enrollmentPayments) > 0)
                            <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                                <h2 class="mb-3">Paid For: Enrollment Payments</h2>
                                <div class="overflow-auto max-table">
                                    <table class="table-styling w-100 table-vertical_scroll">
                                        <thead>
                                            <tr>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Transcation Id</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($enrollmentPayments as $enrollmentPayment)
                                                <tr>
                                                    <td>{{ $enrollmentPayment->first_name }}</td>
                                                    <td>${{ $enrollmentPayment->amount }}</td>
                                                    <td>{{ $enrollmentPayment->payment_mode }}</td>
                                                    <td>{{ $enrollmentPayment->transcation_id }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif


                        <!-- Graduation Payment History Start-->

                        @if (count($graduationPayments) > 0)
                            <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                                <h2 class="mb-3">Paid For: Graduation </h2>
                                <div class="overflow-auto max-table">
                                    <table class="table-styling w-100 table-vertical_scroll">
                                        <thead>
                                            <tr>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Transcation Id</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($graduationPayments as $graduationPayment)
                                                <tr>
                                                    <td>{{ $graduationPayment->first_name }}</td>
                                                    <td>${{ $graduationPayment->amount }}</td>
                                                    <td>{{ $graduationPayment->payment_mode }}</td>
                                                    <td>{{ $graduationPayment->transcation_id }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Notirization Payment History Start-->

                        @if (count($notirizationPayments) > 0)
                            <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                                <h2 class="mb-3">Paid For: Notarization </h2>
                                <div class="overflow-auto max-table">
                                    <table class="table-styling w-100 table-vertical_scroll">
                                        <thead>
                                            <tr>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Transcation Id</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notirizationPayments as $notirizationPayment)
                                                <tr>

                                                    <td>{{ $notirizationPayment['ParentProfile']['p1_first_name'] }}</td>
                                                    <td>${{ $notirizationPayment->amount }}</td>
                                                    <td>{{ $notirizationPayment->payment_mode }}</td>
                                                    <td>{{ $notirizationPayment->transcation_id }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                    </div>
                                </div>

                            </div>

                        @endif

                        <!-- Order Personal Consulation Payment History Start-->
                        @if (count($orderConsulationPayments) > 0)
                            <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                                <h2 class="mb-3">Paid For: Order Consulation Payments</h2>
                                <div class="overflow-auto max-table">
                                    <table class="table-styling w-100 table-vertical_scroll">
                                        <thead>
                                            <tr>
                                                <th scope="col">Parent Name</th>
                                                <th scope="col">Preferred Language</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Transcation Id</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderConsulationPayments as $orderConsulationPayment)
                                                <tr>
                                                    <td>{{ $orderConsulationPayment['parent']['p1_first_name'] }}</td>
                                                    <td>{{ $orderConsulationPayment->preferred_language }}</td>
                                                    <td>${{ $orderConsulationPayment->amount }}</td>
                                                    <td>{{ $orderConsulationPayment->payment_mode }}</td>
                                                    <td>{{ $orderConsulationPayment->transcation_id }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                </div>
                            </div>
                        @endif
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>

    <!-- /.content -->
@endsection
