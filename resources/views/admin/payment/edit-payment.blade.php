@extends('admin.app')

@section('content')


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card-header -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Payment Status of {{$student->first_name}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped data-table"">
                  <thead>
                  <tr>
                   
                    <th>Start Date of Enrollment</th>
                    <th>End Date of Enrollment</th>
                    <th>Grade Level</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($payment_info as $payment)
                  <tr>
                  
                      <td>{{$payment->start_date_of_enrollment}}</td>
                      <td>{{$payment->end_date_of_enrollment}}</td>
                      <td>{{$payment->grade_level}}</td>
                      <td>{{$payment->amount}}</td>
                      <td>{{$payment->status}}
                            </td>
                            <td>
                                <a href=" {{route('admin.edit.payment.status',$payment->id )}}"><i class=" fas fa-edit"
                                onclick="return myFunction();"></i></a>
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