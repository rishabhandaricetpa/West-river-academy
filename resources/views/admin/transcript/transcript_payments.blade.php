@extends('admin.app')
@section('content')
<!-- Content Header (Page header) -->
<!-- Content Wrapper. Contains page content -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid position-relative">
        <h1>Transcript Payment</h1>
        <div class="d-flex">
            <ol class="breadcrumb ml-auto">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Transcript Payment</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.container-fluid -->
</div>

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
                                    <th>Student Name</th>
                                    <th>Transcript Period</th>
                                    <th>Amount</th>
                                    <th>Paymet Method</th>
                                    <th>Transaction Id</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getAlltranscriptPayments as $getAlltranscriptPayment)
                                <tr>
                                    <td>{{$getAlltranscriptPayment->transcript->student->fullname}}</td>
                                    <th>{{$getAlltranscriptPayment->transcript->period}}</th>
                                    <td>{{$getAlltranscriptPayment->amount}}</td>
                                    <td>{{$getAlltranscriptPayment->payment_mode}}</td>
                                    <td>{{$getAlltranscriptPayment->transcation_id}}</td>
                                    <td>{{$getAlltranscriptPayment->status}}</td>
                                    <td><a href="{{ route ('admin.transpayment.edit',$getAlltranscriptPayment->id)}}"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route ('admin.transpayment.delete',$getAlltranscriptPayment->id)}}"><i class=" fas fa-trash-alt" onclick="return myFunction();"></i></a>
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
<script type="text/javascript">
    function myFunction() {
        if (!confirm("Are You Sure to delete this"))
            event.preventDefault();
    }
</script>