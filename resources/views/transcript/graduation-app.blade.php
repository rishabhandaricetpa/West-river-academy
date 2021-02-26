@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Purchase Transcript</h1>
    <div class="form-wrap border bg-light py-5 px-25">

        <h2 class="mb-3">Select the student who wishes to purchase transcript</h2>
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
                    @foreach($enroll_students as $enroll_student)
                    <tr>
                        <td>{{$enroll_student->fullname}}</td>
                        <td>{{$enroll_student->d_o_b->format('M d Y')}}</td>
                        <td>{{$enroll_student->student_Id}}</td>
                        <td>{{$enroll_student->email}}</td>
                        <td><a href="{{route('transcript.studentInfo',$enroll_student->id)}}" class="btn btn-primary">Apply</a></td>
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