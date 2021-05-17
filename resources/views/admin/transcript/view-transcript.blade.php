@extends('admin.app')

@section('content')

<main class="content">
    <div class="position-relative container-fluid mt-0">
        <div class="content-header">
            <h1 class="text-center text-white text-uppercase">Transcript Information</h1>
        </div>
        <div class="form-wrap border bg-light py-5 px-25 mb-4">
            <h2 class="mb-3">{{$student->fullname}}</h2>
            <form method="POST" action="" class="mb-0">

                <div class="form-group d-sm-flex mb-2">
                    <label for="">Name</label>
                    <div class="float-left">
                        {{$student->fullname}}
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Date of Birth</label>
                    <div class="float-left">
                        {{$student->d_o_b->format('M d Y ')}}
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Address</label>
                    <div class="float-left">
                        {{$student->ParentProfile->street_address}},
                        {{$student->ParentProfile->city}},
                        {{$student->ParentProfile->state}},
                        {{$student->ParentProfile->zip_code}},
                        {{$student->ParentProfile->country}}
                    </div>
                </div>
                <p>Click on Generate Signed Transcript to approve the transcript.</p>
                <a type="button" href="{{ route('admin.genrate.transcript',[$student->id,$transcript_id]) }}" class="btn btn-primary mr-2 mt-3">Generate Unsigned Transcript</a>
                <a type="button" href="{{ route('admin.signed.transcript',[$student->id,$transcript_id]) }}" class="btn btn-primary mr-2 mt-3">Generate Signed Transcript</a>
                <a type="button" href="{{ route('admin.file.upload',[$student->id,$transcript_id])}}" class="btn btn-primary mr-2 mt-3">Upload Approved Signed Transcript</a>
                <a href="{{route('admin.edit.transcript',$student->id)}}" class="btn btn-primary mr-2 mt-3">Back</a>
            </form>
        </div>

        @foreach($transcriptData as $school)
        <div class="form-wrap border bg-light py-5 px-25 mb-4">
            <h2 class="mb-3">{{$school->school_name}}</h2>
            <p>
                Academic School Year(s): {{$school->enrollment_year}}<br>
                Grade: {{$school->grade}}<br>
            </p>
            <table id="addressData" class="table table-bordered table-striped data-table mt-3">
                <a type=" button" href="{{ route('admin.deleteSchool',$school->id) }}" class="btn btn-primary mb-3 transform-none">Delete this Year from Transcript</a>
                <thead>
                    <tr>
                        <th>Subjects</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($school->TranscriptCourse as $course)
                    @foreach ($course->subjects as $subject)
                    <tr>
                        <td>{{$subject->subject_name}}</td>
                        <td>{{$course->score}}</td>
                        <td><a type=" button" href="{{ route('admin.edit.subGrades',[$subject->id,$school->transcript_id,$school->grade])}}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
            </form>
        </div>
        @endforeach
    </div>
    </div>
</main>
@endsection
<script>
    function myFunction() {
        if (!confirm("Are You Sure to delete this"))
            event.preventDefault();
    }

</script>
