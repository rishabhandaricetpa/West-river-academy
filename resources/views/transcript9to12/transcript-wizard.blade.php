@extends('layouts.app')
@section('pageTitle', 'Transcript Wizard')
@section('content')
    <!-- * =============== Main =============== * -->
    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase">Transcript Information</h1>
        <div class="form-wrap border bg-light py-5 px-25 mb-4 school-record">
            <h2 class="mb-3">{{ $student->fullname }}</h2>
            <form method="POST" action="" class="mb-0">

                <div class="form-group d-sm-flex mb-2">
                    <label for="">Name</label>
                    <div>
                        {{ $student->fullname }}
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Date of Birth</label>
                    <div>
                        {{ $student->d_o_b->format('F j, Y') }}
                    </div>
                </div>
            </form>
        
        <div class="pt-2 ">

            @foreach ($transcriptDatas as $school)

                <div class="seperator mb-4">
                    <h2 class="mb-2">{{ $school->school_name }}</h2>

                    <a href="{{ route('delete.transcript.school', $school->id) }}" class="btn btn-primary float-right"
                        type="submit" value="Delete School Record">Delete School Record</a>

                    <p class="mb-0"><span class="font-weight-bold mr-2">Academic School
                            Year(s):</span>{{ $school->enrollment_year }} - {{ $school->enrollment_year + 1 }} </p>
                    <p> <span class="font-weight-bold mr-2"> Grade:</span> {{ $school->grade }}</p>

                    <div class="overflow-auto">
                        <table class="table-styling w-100">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Credit</th>
                                    <th class="hide">Grades</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($school->TranscriptCourse9_12 as $course)

                                    @foreach ($course->subjects as $subject)
                                        <tr>

                                            <td>{{ $subject->subject_name }}</td>
                                            <td>{{ $course->selectedCredit }}</td>
                                            <td>{{ $course->score }}</td>

                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="buttongroup">
                        <a href="{{ route('showCourseDetails', [$school->id, $school->student_profile_id]) }}"
                            class="btn btn-primary mt-4">Select Courses and Grade</a>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($transcriptWizStatus->transcript_wiz === 'Yes' && $transcriptWizStatus->status === 'pending')
            <div class=" pt-2">
                <p>If you are finished with this transcript and would like to see what it looks like, you can click the
                    "Preview Transcript" button to download a preview. If you would like to submit it to be reviewed click
                    the "Submit Transcript" button.</p>
                <div class="d-sm-flex align-items-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary ml-sm-2" role="button">Back to
                        Dashboard</a>
                    <form method="post" action="{{ route('transcript.purchase', $student->id) }}"
                        class="mb-0 label-large">
                        @csrf
                        <input type="hidden" name="transcript_wiz" value="{{ $transcriptWizStatus->transcript_wiz }}">
                        <input type="hidden" name="transcript_id" value="{{ $transcriptWizStatus->id }}">
                        <input type="hidden" name="type" value="9-12">
                        <button type="submit" class="btn btn-primary  ml-sm-2" role="button">Add To Cart</button>
                    </form>
                    <a href="{{ route('thankyoupage.save', [$student->id, $transcript_id]) }}"
                        class="btn btn-primary  ml-sm-2" role="button">Save As A Draft</a>
                </div>
            </div>
        @else
            <div class="pt-2">
                <p>If you are finished with this transcript and would like to see what it looks like, you can click
                    the
                    "Preview Transcript" button to download a preview. If you would like to submit it to be reviewed click
                    the "Submit Transcript" button.</p>
                <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3" role="button">Back to Dashboard</a>
                @if (count($details9_12) > 0)
                    <a href="{{ route('preview.transcript9_12', [$student->id, $transcript_id]) }}"
                        class="btn btn-primary mt-3 ml-2" role="button">Submit Transcript</a>
                @endif
            </div>

        @endif
    </div>
    </main>

    <!-- * =============== /Main =============== * -->
@endsection
