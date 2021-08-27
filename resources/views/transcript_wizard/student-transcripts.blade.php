@extends('layouts.app')
@section('pageTitle', 'Purchase Transcript')
@section('content')
    <!-- * =============== Main =============== * -->
    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
        <div class="form-wrap border bg-light py-5 px-25">

            <h2 class="mb-3">Start Creating Transcript</h2>
            <table class="w-100 table-styling">
                <thead>
                    <tr>

                        <th>Amount Paid</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                        <th>Preview</th>
                        <th>Draft</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($transcriptPayments)
                        @foreach ($transcriptPayments as $transcriptPayment)
                            <tr>

                                <td>{{ $transcriptPayment->amount }}</td>
                                @if ($transcriptPayment->status === 'paid')
                                    <td>Paid</td>
                                @elseif($transcriptPayment->status === 'completed')
                                    <td>Completed & Submitted</td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>{{ $transcriptPayment->payment_mode }}</td>
                                @if ($transcriptPayment->period == '9-12')
                                    @if (getTranscriptPaidDetails($transcriptPayment->id) === 'true')
                                        <td><a href="{{ route('preview.transcript9_12', [$enroll_student->id, $transcriptPayment->transcript_id]) }}"
                                                class="btn btn-primary">Preview Transcript</a></td>
                                    @else
                                        <td><a href="{{ route('preview.transcript9_12', [$enroll_student->id, $transcriptPayment->transcript_id]) }}"
                                                class="btn btn-primary disabled">Preview Transcript</a></td>
                                    @endif
                                @else
                                    @if (getTranscriptPaidDetails($transcriptPayment->id) === 'true')
                                        <td><a href="{{ route('preview.transcript', [$enroll_student->id, $transcriptPayment->transcript_id]) }}"
                                                class="btn btn-primary">Preview Transcript</a></td>
                                    @else
                                        <td><a href="{{ route('preview.transcript', [$enroll_student->id, $transcriptPayment->transcript_id]) }}"
                                                class="btn btn-primary disabled">Preview Transcript</a></td>
                                    @endif
                                @endif
                                @if ($transcriptPayment->period == '9-12')
                                    <td><a href="{{ route('display.grades', [$enroll_student->id, $transcriptPayment->transcript_id]) }}"
                                            class="btn btn-primary">View Saved Transcript</a></td>
                                @else
                                    <td><a href="{{ route('another.grade', [$enroll_student->id, $transcriptPayment->transcript_id]) }}"
                                            class="btn btn-primary">View Saved Transcript</a></td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>No Transcript Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>

    </main>

    <!-- * =============== /Main =============== * -->
@endsection
