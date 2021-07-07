 @extends('admin.app')

 @section('content')
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid position-relative">
             <h1>Order List</h1>
             <div class="d-flex">
                 <ol class="breadcrumb ml-auto">
                     <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.notification') }}">Home</a></li>
                     <li class="breadcrumb-item active">Order List</li>
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
                         @if (count($transcript_payments) > 0)
                             <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                                 <h2 class="mb-3">Paid For: Transcripts</h2>
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
                                             @foreach ($transcript_payments as $transcript_payment)
                                                 <tr>

                                                     <td>${{ $transcript_payment->amount }}
                                                     </td>
                                                     <td>{{ $transcript_payment->payment_mode }}
                                                     </td>
                                                     <td>{{ $transcript_payment->transcation_id }}
                                                     </td>
                                                 </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                     <div>
                                     </div>
                                 </div>
                             </div>
                         @endif

                         <!-- Custom Payment History Start-->
                         @if (count($customPayments) > 0)
                             <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                                 <h2 class="mb-3">Paid For: Custom Payments</h2>
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

                         <!-- Custom  Letter History Start-->
                         @if (count($customLetter) > 0)
                             <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                                 <h2 class="mb-3">Paid For: Custom Letter Payments</h2>
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
                                             @foreach ($customLetter as $cl)
                                                 <tr>

                                                     <td>{{ $cl['ParentProfile']['p1_first_name'] }}</td>
                                                     <td>${{ $cl['amount'] }}</td>
                                                     <td>{{ $cl['payment_mode'] }}</td>
                                                     <td>{{ $cl['transcation_id'] }}</td>

                                                 </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                     <div>
                                     </div>

                                 </div>
                             </div>
                         @endif
                         <!-- Graduation Payment History Start-->

                         @if (count($graduationPayments) > 0)
                             <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                                 <h2 class="mb-3">Paid For: Graduations </h2>
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

                         @if (count($graduationPayments) > 0)
                             <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                                 <h2 class="mb-3">Paid For: Notarizations </h2>
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

                                                     <td>{{ $notirizationPayment['ParentProfile']['p1_first_name'] }}
                                                     </td>
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
                                                     <td>{{ $orderConsulationPayment['parent']['p1_first_name'] }}
                                                     </td>
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
                         </main>
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
