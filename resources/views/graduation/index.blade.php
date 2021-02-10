@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">Graduation application</h1>
  <div class="form-wrap border bg-light py-5 px-25">
     
        <h2 class="mb-3">Select the student who wishes to apply for graduation</h2>
        <form action="{{ route('graduation.application') }}">
            <div class="overflow-auto">
                <table class="w-100 table-styling enlarge-input">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Graduation Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>
                                    <input class="form-check-input" @if ($student->graduation !== null) disabled @endif required type="radio" value="{{ $student->id }}" name="student">
                                    {{ $student->fullname }}
                                </td>
                                <td>{{ $student->dob }}</td>
                                <td>{{ $student->gender }}</td>
                                @if ($student->graduation === null)
                                    <td>Not Applied</td>
                                @elseif($student->graduation->status === 'pending')
                                    <td>Pending Approval</td>
                                @elseif($student->graduation->status === 'approved')
                                    <td>Approved (Pending Payment)</td>
                                @elseif($student->graduation->status === 'paid')
                                    <td>Paid</td>
                                @elseif($student->graduation->status === 'completed')
                                    <td>Graduation Completed</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <input type="submit" class="btn btn-primary" value="Continue">
            </div>
        </form>
</main>

<!-- * =============== /Main =============== * -->
@endsection
