@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Record Transfer Request</h1>
    <div class="form-wrap border bg-light py-5 px-25">

        <h2 class="mb-3">Select the student who wishes to send record transfer request.</h2>
        <div class="overflow-auto">
            <table class="w-100 table-styling enlarge-input">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as$student)
                    <tr>
                        <td> {{$student->fullname}}</td>
                        <td>{{$student->birthdate}}</td>
                        <td>{{$student->student_Id}}</td>
                        <td>{{$student->email}}</td>
                        <td><a href="" class="btn btn-primary">Send Record Transfer Request</a></td>
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