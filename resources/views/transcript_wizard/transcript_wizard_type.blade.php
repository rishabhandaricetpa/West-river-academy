@extends('layouts.app')
@section('pageTitle', 'Create Transcript')
@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
    <div class="form-wrap border bg-light py-5 px-25">
        <div class="col-sm-6 mx-auto">
            <div class="text-center">
                <h2 class="mb-3">Welcome to the Transcript Wizard!</h2>
                <h3>You will be guided through the process of creating a transcript for:</h3>
            </div>
            <form method="post" action="{{route('transcriptwizard.create',$enroll_student->id)}}" class="mb-0 mt-5 label-large">
                @csrf
                <div class="form-group d-sm-flex mb-2">
                    <label for="">First name</label>
                    <div>
                        <input type="text" name="first_name" value="{{$enroll_student->first_name}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Middle name</label>
                    <div>
                        <input type="text" name="middle_name" value="{{$enroll_student->middle_name}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Last name</label>
                    <div>
                        <input type="text" name="last_name" value="{{$enroll_student->last_name}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="mt-2r">
                    <h3>Is the transcript for grades Kindergarten-8 or for high school (grades 9-12)?</h3>
                    <div class="d-sm-flex py-4 col-sm-6 mx-auto">
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="grade" value="K-8" required>
                            <label class="form-check-label" for="">K-8</label>
                        </div>
                        <input type="hidden" name="type_of_transcript" value="{{$type ?? ''=='K-8'?'transcript_K-8':'transcript_9-12'}}">
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="grade" value="9-12">
                            <label class="form-check-label" for="">9-12</label>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">continue</button>
                </div>
            </form>
        </div>

    </div>

</main>

<!-- * =============== /Main =============== * -->
@endsection
