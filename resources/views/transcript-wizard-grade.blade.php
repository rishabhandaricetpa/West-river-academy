@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Transcript Wizard for Grade School (Grades K-8)</h1>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <p class="mt-0 mb-3">You can edit the below Courses/Subjects.</p>
        <h2 class="mb-2">Student</h2>
        <form method="POST" action="" class="mb-0">
            <div class="form-group d-sm-flex mb-2">
                <label for="">Name</label>
                <div>
                    {{$studentInfo->first_name}}
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="">Date of Birth</label>
                <div>
                    {{$studentInfo->d_o_b->format('d M Y')}}
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="">School Name</label>
                <div>
                    {{$school->school_name}}
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
                        <th>Courses</th>
                        <th>Subjects</th>
                        <th>Grade</th>
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


                </tbody>
                <tfoot>
                    <tr>
                        <td class="pl-0 pt-4">
                            <a href="{{route('edit.englishCourse',[$student_id,$transcript_id])}}" class="btn btn-primary">Edit Courses
                            </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</main>

<!-- * =============== /Main =============== * -->
@endsection