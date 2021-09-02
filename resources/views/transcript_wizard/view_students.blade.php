@extends('layouts.app')
@section('pageTitle', 'Purchase Transcript')
@section('content')
    <!-- * =============== Main =============== * -->
    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
        <div class="form-wrap border bg-light py-5 px-25">

            <div class="overflow-auto">
                <table class="w-100 table-styling">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="transform-none">Date of Birth</th>
                            <th>Create transcript</th>
                            <th>View Saved Transcript</th>
                            {{-- <th>View All Purchase</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enroll_students as $enroll_student)
                            <tr>
                                <td>{{ $enroll_student->fullname }}</td>
                                <td>{{ $enroll_student->d_o_b->format('M j, Y') }}</td>
                                <td><a href="{{ route('transcriptwizard.viewall', $enroll_student->id) }}"
                                        class="btn btn-primary">Create Transcript</a></td>
                                @if (getTranscriptdeatils($enroll_student->id) === 'true')
                                    <td><a href="{{ route('transcriptwizard.details', $enroll_student->id) }}"
                                            class="btn btn-primary">View Saved Transcript</a></td>
                                    {{-- <td><a href="{{ route('transcript.viewall', $enroll_student->id) }}"
                                            class="btn btn-primary">View Recent Purchase</a></td> --}}
                                @else
                                    <td><a href="{{ route('transcriptwizard.details', $enroll_student->id) }}"
                                            class="btn btn-primary disabled">View Saved Transcript</a></td>
                                    {{-- <td><a href="{{ route('transcript.viewall', $enroll_student->id) }}"
                                            class="btn btn-primary disabled">View Recent Purchase</a></td> --}}
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
            </div>
    </main>
@endsection
