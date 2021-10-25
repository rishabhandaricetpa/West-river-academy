@extends('layouts.app')
@section('pageTitle', 'Student Details')
@section('content')
    <!-- * =============== Main =============== * -->
    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase">Record Transfer Request</h1>
        <div class="form-wrap border bg-light py-5 px-25">

            <h2 class="mb-3">Select the student who needs records transferred.</h2>
            <div class="overflow-auto">
                <input type="hidden" value="{{ $parentId }}" name="parent_id">
                <table class="w-100 table-styling">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>National ID</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td><a
                                    href="{{ route('record.send', [$student->id, $parentId]) }}">{{ $student->fullname }}</a>
                                </td>
                                <td>{{ formatDate($student->birthdate) }}</td>
                                <td>{{ $student->student_Id }}</td>
                                <td class="transform-none">{{ $student->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">


            </div>

    </main>

    <!-- * =============== /Main =============== * -->
@endsection
