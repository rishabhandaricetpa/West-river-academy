@extends('admin.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card-header -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="pr-3"> Payment Status of Parent :<a
                                href="{{ route('admin.parent.edit',  $student->parent_profile_id) }}">View Parent</a>
                            </h3>
                            <h3 class="card-title"> Enrollment Status of {{ $student->fullname }} </h3>

                            <a href="{{ route('admin.view.students.parent', $student->parent_profile_id) }}"
                                class="btn btn-primary float-left">View Parent</a>
                            <a onclick="goBack()" class="btn btn-primary float-right">Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>

                                        <th class="transform-none">Start Date of Enrollment</th>
                                        <th class="transform-none">End Date of Enrollment</th>
                                        <th>Grade Level</th>
                                        <th>Amount</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment_info as $payment)
                                        <tr>

                                            <td>{{ Carbon\Carbon::parse($payment->start_date_of_enrollment)->format('M j, Y') }}
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($payment->end_date_of_enrollment)->format('M j, Y') }}
                                            </td>
                                            <td>{{ $payment->grade_level }}</td>
                                            <td>{{ $payment->amount }}</td>
                                            @if ($payment->status === 'paid')
                                                <td>Paid</td>
                                            @elseif($payment->status ==='pending')
                                                <td>Pending</td>
                                            @endif
                                            <td>
                                                <a href=" {{ route('admin.edit.payment.status', $payment->id) }}"><i
                                                        class=" fas fa-edit" onclick="return myFunction();"></i></a>
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
@endsection
