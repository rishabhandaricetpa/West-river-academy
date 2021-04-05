@extends('layouts.app')
@section('pageTitle', 'Purchase Transcript')
@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Purchase Transcript</h1>
    <div class="form-wrap border bg-light py-5 px-25">

        <h2 class="mb-3">Start Creating Transcript</h2>
        <div class="overflow-auto">
            <table class="w-100 table-styling">
                <thead>
                    <tr>
                        <th>Transcript For</th>
                        <th>Amount Paid</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($transcriptPayments)
                    @foreach($transcriptPayments as $transcriptPayment)
                    <tr>
                        <td>{{$transcriptPayment->period}}</td>
                        <td>{{$transcriptPayment->amount}}</td>
                        @if($transcriptPayment->status=== 'paid')
                        <td>Paid</td>
                        @elseif($transcriptPayment->status=== 'active')
                        <td>Active</td>
                        @elseif($transcriptPayment->status=== 'completed')
                        <td>Completed & Submitted</td>
                        @endif
                        <td>{{$transcriptPayment->payment_mode}}</td>
                        <td><a href="{{route('transcript.create',[$transcriptPayment->transcript_id,$enroll_student->id])}}" class="btn btn-primary">Start Creating Transcript</a></td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>No Transcript Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-5">


        </div>

</main>

<!-- * =============== /Main =============== * -->
@endsection