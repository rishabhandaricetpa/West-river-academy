@extends('layouts.app')
@section('pageTitle', 'Transcript Information')
@section('content')
    <!-- * =============== Main =============== * -->
    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase">Transcript Information</h1>
        <div class="form-wrap border bg-light py-5 px-25 mb-4 school-record">
            <h2 class="mb-3">{{ $student->first_name }}</h2>

            <div class="form-group d-sm-flex mb-2">
                <label for="">Name</label>
                <div>
                    {{ $student->first_name }}
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="">Date of Birth</label>
                <div>
                    {{ $student->d_o_b->format('F j, Y') }}
                </div>
            </div>
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
            @foreach ($transcriptDatas as $school)
                <div class="seperator mb-4">
                    <h2 class="mb-2">{{ $school->school_name }}</h2>
                    @if (count($k8details) > 1)
                        <a href="{{ route('delete.school', $school->id) }}" class="btn btn-primary float-right"
                            type="submit" value="Delete School Record">Delete School Record</a>
                    @endif
                    <p class="mb-0"><span class="font-weight-bold mr-2">Academic School
                            Year(s):</span>{{ $school->enrollment_year }} </p>
                    <p> <span class="font-weight-bold mr-2"> Grade:</span> {{ $school->grade }}</p>

                    <div class="overflow-auto">
                        <table class="table-styling w-100">
                            <thead>
                                <tr>
                                    <th>Subjects</th>
                                    <th class="hide">Courses</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($school->TranscriptCourse as $course)
                                    @foreach ($course->subjects as $subject)
                                        <tr>

                                            <td>{{ $subject->subject_name }}</td>
                                            <td>
                                                @php
                                                    $firstCourse = \Arr::first($course->course, function ($value, $key) use ($subject) {
                                                        return $value['id'] == $subject['courses_id'];
                                                    });
                                                @endphp
                                                {{ $firstCourse->course_name }}
                                            </td>
                                            <td>{{ $course->score }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="buttongroup">
                        <a href="{{ route('displayAllCourse', [$school->id, $school->student_profile_id]) }}"
                            class="btn btn-primary mt-4">Select Courses and Grade</a>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($transcriptWizStatus->transcript_wiz === 'Yes' && $transcriptWizStatus->status === 'pending')
            <div class="form-wrap border bg-light py-5 px-25">
                <p>If you are finished with this transcript and would like to see what it looks like, you can click the
                    "Preview Transcript" button to download a preview. If you would like to submit it to be reviewed click
                    the "Submit Transcript" button.</p>
                <div class="d-sm-flex align-items-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary " role="button">Back to Dashboard</a>
                    <form method="post" action="{{ route('transcript.purchase', $student->id) }}"
                        class="mb-0  label-large">
                        @csrf
                        <input type="hidden" name="transcript_wiz" value="{{ $transcriptWizStatus->transcript_wiz }}">
                        <input type="hidden" name="type" value="K-8">
                        <input type="hidden" name="transcript_id" value="{{ $transcriptWizStatus->id }}">
                        <button type="submit" class="btn btn-primary  ml-sm-2" role="button">Add To Cart</button>
                    </form>
                    <a href="{{ route('thankyoupage.save', [$student->id, $trans_id]) }}" class="btn btn-primary ml-sm-2"
                        role="button">Save As A Draft</a>
                </div>
            </div>
        @else
            <div class="form-wrap border bg-light py-5 px-25">
                <p>If you are finished with this transcript and would like to see what it looks like, you can click the
                    "Preview Transcript" button to download a preview. If you would like to submit it to be reviewed click
                    the "Submit Transcript" button.</p>
                <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3" role="button">Back to Dashboard</a>
                @if (count($k8details) > 0)
                    <a href="{{ url('preview-transcript', [$student->id, $trans_id]) }}"
                        class="btn btn-primary mt-3 ml-2" role="button">Submit Transcript</a>
                @endif
            </div>

        @endif
    </main>

    <!-- * =============== /Main =============== * -->
@endsection
