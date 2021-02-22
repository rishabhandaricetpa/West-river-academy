@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Transcript Wizard for Grade School (Grades K-8)</h1>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <p class="mt-0 mb-3">Choose a subject for each category below.</p>
        <h2 class="mb-2">Student</h2>
        <form method="POST" action="" class="mb-0">
            <div class="form-group d-sm-flex mb-2">
                <label for="">Name</label>
                <div>

                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="">Date of Birth</label>
                <div>
                    Jan 1, 1970
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="">School</label>
                <div>
                    Solana Beach Elementary School
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="">School Year(s)</label>
                <div>
                    2017-2018
                </div>
            </div>

            <div class="form-group d-sm-flex mb-2">
                <label for="">Grade)</label>
                <div>
                    5
                </div>
            </div>
        </form>
    </div>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-3">Edit Courses/Subjects</h2>
        <div class="overflow-auto">
            <table class="table-styling w-100">
                <thead>

                    <tr>
                        <th>Course / Subject</th>
                        <th>Category</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                    <tr>
                        <td>{{$course->course_name}}</td>
                        <td>{{$course->subject_name}}</td>
                        <td>{{$course->score}}</td>
                    </tr>
                    @endforeach

                    <td>
                        <a href="{{route('edit.englishCourse',[$student_id,$transcript_id])}}" class="btn btn-primary">Edit
                        </a>
                    </td>
                </tbody>
            </table>
        </div>
        <a href="#" class="btn btn-primary mt-4" role="button">Add English/Language Arts</a>
    </div>
</main>

<!-- * =============== /Main =============== * -->
@endsection