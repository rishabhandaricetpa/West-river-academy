@extends('layouts.app')
@section('pageTitle', 'Student Details')
@section('content')
<!-- * =============== Main =============== * -->

<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Video</h1>
    <div class="border bg-light form-wrap mb-4">
        <div class="embed-responsive embed-responsive-16by9">
        <video loop="" autoplay controls playsinline="" class="embed-responsive-item">
                <source src="images/WelcomeVideo.mp4"  type="video/mp4">
            </video>
        </div>
    </div>
    <div class="border bg-light form-wrap mb-4">
        <div class="embed-responsive embed-responsive-16by9">
            <video loop="" controls playsinline="" class="embed-responsive-item">
                <source src="images/year-endreport.mp4"  type="video/mp4">
            </video>
        </div>
    </div>
    <div class="border bg-light form-wrap mb-4">
        <div class="embed-responsive embed-responsive-16by9">
            <video loop=""  controls playsinline="" class="embed-responsive-item">
                <source src="images/FinalTranscriptTutorial.mp4"  type="video/mp4">
            </video>
        </div>
    </div>
    </div>
    </div>
</main>
<!-- Choose Dates -->

@endsection
