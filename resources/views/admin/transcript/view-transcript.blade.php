@extends('admin.app')

@section('content')

<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-3">{{$student->first_name}}</h2>
        <form method="POST" action="" class="mb-0">

            <div class="form-group d-sm-flex mb-2">
                <label for="">Name</label>
                <div>
                    {{$student->fullname}}
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="">Date of Birth</label>
                <div>
                    {{$student->d_o_b->format('d M Y ')}}
                </div>
            </div>
            <a type="button" href="{{ route('admin.genrate.transcript',[$student->id,$transcript_id]) }}" class="btn btn-primary">Generate Unsigned Transcript</a>
            <a type="button" href="{{ url('admin/file-upload')}}" class="btn btn-primary">Upload Signed Transcript</a>
        </form>
    </div>
        @foreach($transcriptData as $school)
        <div class="form-wrap border bg-light py-5 px-25 mb-4">
            <legend>{{$school->school_name}}</legend>
            <p>
                Academic School Year(s):{{$school->enrollment_year}}<br>
                Grade: {{$school->grade}}<br>
            </p>
            <table id="addressData" class="table table-bordered table-striped data-table"">
                <thead>
                    <tr>
                        <th>Courses</th>
                        <th>Subjects</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($school->TranscriptCourse as $course)
                    @foreach ($course->subjects as $subject)
                    <tr>

                        <td>
                            @php
                            $firstCourse = \Arr::first($course->course, function ($value, $key) use ($subject) {
                            return $value['id'] == $subject['courses_id'];
                            });
                            @endphp
                            {{$firstCourse->course_name}}
                        </td>
                        <td>{{$subject->subject_name}}</td>
                        <td>{{$course->score}}</td>
                        <td><a type=" button" href="{{ route('admin.edit.subGrades',[$subject->id,$school->transcript_id])}}" class="btn btn-primary">Edit</a></td>
            </tr>
            @endforeach
            @endforeach
            </tbody>
        </table>
        </form>
    </div>
    @endforeach
    </div>
</main>
@endsection
<script>
    function myFunction() {
        if (!confirm("Are You Sure to delete this"))
            event.preventDefault();
    }
</script>