@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-3">{{$student->first_name}}</h2>
        <form method="POST" action="" class="mb-0">

            <div class="form-group d-sm-flex mb-2">
                <label for="">Name</label>
                <div>
                    {{$student->first_name}}
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="">Date of Birth</label>
                <div>
                    {{$student->d_o_b->format('d M Y ')}}
                </div>
            </div>
        </form>
    </div>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">

        <div class="overflow-auto">
            <table class="table-styling w-100">
                <thead>
                    <tr>

                    </tr>
                </thead>
                <tbody>



                </tbody>
            </table>
        </div>
        @foreach($transcriptDatas as $school)

        <div class="datablock">
            <legend>{{$school->school_name}}</legend>
            <p>
                Academic School Year(s):{{$school->enrollment_year}}<br>
                Grade: {{$school->grade}}<br>
            </p>
            <table>
                <thead>
                    <tr>
                        <th>Subjects</th>
                        <th class="hide">Courses</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($school->TranscriptCourse as $course)
                    @foreach ($course->subjects as $subject)
                    <tr>

                        <td>{{$subject->subject_name}}</td>
                        <td>
                            @php
                            $firstCourse = \Arr::first($course->course, function ($value, $key) use ($subject) {
                            return $value['id'] == $subject['courses_id'];
                            });
                            @endphp
                            {{$firstCourse->course_name}}
                        </td>
                        <td>{{$course->score}}</td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
            <div class="buttongroup">
                <form action="https://www.westriveracademy.com/cwp/pvt/transcript/setgrd/4EAEA8DC-F849-A842-8960-03C7170023B1" method="post" accept-charset="utf-8">
                    <input type="submit" name="edit" id="edit" value="Select Course Names and Grades" class="add">
                </form>
            </div>
        </div>
        @endforeach
    </div>


    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <p>You can use the button below to add classes from other schools, colleges, and universities. Course selection, credits, and grades must match exactly the transcript we have on file from the other school. Heading on transcript will indicate the name of the school.</p>
        <a href="#" class="btn btn-primary mt-3" role="button">Add Other School, College, or University</a>
    </div>
    <div class="form-wrap border bg-light py-5 px-25">
        <p>If you are finished with this transcript and would like to see what it looks like, you can click the "Preview Transcript" button to download a preview. If you would like to submit it to be reviewed click the "Submit Transcript" button.</p>
        <a href="#" class="btn btn-primary mt-3" role="button">Back to Dashboard</a>
        <a href="#" class="btn btn-primary mt-3 ml-2" role="button">Preview Transcript</a>
        <a href="#" class="btn btn-primary mt-3 ml-2" role="button">Submit Transcript</a>
    </div>
</main>

<!-- * =============== /Main =============== * -->
@endsection