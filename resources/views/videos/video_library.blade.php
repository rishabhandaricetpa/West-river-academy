@extends('layouts.app')
@section('pageTitle', 'Student Details')
@section('content')
<!-- * =============== Main =============== * -->

<main class="position-relative container form-content mt-4 media-library">
  <h1 class="text-center text-white text-uppercase">Video</h1>
  <ul class="nav nav-tabs justify-content-around " id="myTab" role="tablist ">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
        aria-selected="true">Video</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
        aria-selected="false">Audio</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
        aria-selected="false">Journal</a>
    </li>
  </ul>
  <div class="tab-content bg-light" id="myTabContent">
    <div class="tab-pane fade container video-library" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="row align-items-center py-2r ">
        <div class="col-md-4 my-2">
          <div class="embed-responsive embed-responsive-16by9">
            <video loop="" controls playsinline="" class="embed-responsive-item">
              <source src="images/FinalTranscriptTutorial.mp4" type="video/mp4">
            </video>
          </div>
        </div>
        <div class="col-md-8 my-2">
          <h3>dashboard overview</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt mollitia minus cupiditate maiores quam
            assumenda expedita tenetur aliquid, vel aliquam!</p>
        </div>
        <div class="col-md-4 my-2">
          <div class="embed-responsive embed-responsive-16by9">
            <video loop="" controls playsinline="" class="embed-responsive-item">
              <source src="images/FinalTranscriptTutorial.mp4" type="video/mp4">
            </video>
          </div>
        </div>
        <div class="col-md-8 my-2">
          <h3>dashboard overview</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt mollitia minus cupiditate maiores quam
            assumenda expedita tenetur aliquid, vel aliquam!</p>
        </div>
        <div class="col-md-4 my-2">
          <div class="embed-responsive embed-responsive-16by9">
            <video loop="" controls playsinline="" class="embed-responsive-item">
              <source src="images/FinalTranscriptTutorial.mp4" type="video/mp4">
            </video>
          </div>
        </div>
        <div class="col-md-8 my-2">
          <h3>dashboard overview</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt mollitia minus cupiditate maiores quam
            assumenda expedita tenetur aliquid, vel aliquam!</p>
        </div>
        <div class="col-md-4 my-2">
          <div class="embed-responsive embed-responsive-16by9">
            <video loop="" controls playsinline="" class="embed-responsive-item">
              <source src="images/FinalTranscriptTutorial.mp4" type="video/mp4">
            </video>
          </div>
        </div>
        <div class="col-md-8 my-2">
          <h3>dashboard overview</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt mollitia minus cupiditate maiores quam
            assumenda expedita tenetur aliquid, vel aliquam!</p>
        </div>
      </div>
    </div>
    <div class="tab-pane fade   container journal-library py-2r " id="profile" role="tabpanel"
      aria-labelledby="profile-tab">

      <h2 class="text-center mx-md-4">The WRA Journal</h2>
      <p class="text-center">click each Volume below to view our montly newletter </p>
      <div class="journal py-2">
        <h3><a href="#"> Volume 1: April 1,2021</a></h3>
        <p>Join our Private WFA Families group on the MeWe platform, listen to our Podcasts, read about "Our Story"
          and read blog posts about our natural learning approach</p>
      </div>
      <div class="journal py-2">
        <h3><a href="#"> Volume 2: April 1,2021</a></h3>
        <p>Join our Private WFA Families group on the MeWe platform, listen to our Podcasts, read about "Our Story"
          and read blog posts about our natural learning approach</p>
      </div>
      <div class="journal py-2">
        <h3><a href="#"> Volume 3: April 1,2021</a></h3>
        <p>Join our Private WFA Families group on the MeWe platform, listen to our Podcasts, read about "Our Story"
          and read blog posts about our natural learning approach</p>
      </div>
      <div class="journal py-2">
        <h3><a href="#"> Volume 4: April 1,2021</a></h3>
        <p>Join our Private WFA Families group on the MeWe platform, listen to our Podcasts, read about "Our Story"
          and read blog posts about our natural learning approach</p>
      </div>
      <div class="journal py-2">
        <h3><a href="#"> Volume 5: April 1,2021</a></h3>
        <p>Join our Private WFA Families group on the MeWe platform, listen to our Podcasts, read about "Our Story"
          and read blog posts about our natural learning approach</p>
      </div>
      <div class="journal-subscribtion text-center mt-md-4 mx-md-4 pt-4">
        <p>Haven't recieved our newsletter via mail ?</p>
        <a href="#" class="button-subscribtion bg-secondary">Subscribe</a>
      </div>
    </div>

    <div class="tab-pane fade container show active audio-library py-2r " id="contact" role="tabpanel"
      aria-labelledby="contact-tab">
      <h2>podcasts</h2>
      <div class="row">

        <div class="episodes col-md-6 pb-3">
          <h3 class="pt-3">Episode 1: Natural Learning and Accidental Homescholling</h3>
          <p><span class="time">13 min</span><span class="pl-sm-5 pl-3 date">April 1, 2021</span></p>
          <p>Peggy Webb and her daughter, Stacey. discuss...</p>
          <audio controls="controls" src="https://p.scdn.co/mp3-preview/0ba9d38f5d1ad30f0e31fc8ee80c1bebf0345a0c">
            Your browser does not support the HTML5 audio element.
          </audio>
        </div>
        <div class="episodes col-md-6 pb-3">
          <h3 class="pt-3">Episode 1: Natural Learning and Accidental Homescholling</h3>
          <p><span class="time">13 min</span><span class="pl-sm-5 pl-3 date">April 1, 2021</span></p>
          <p>Peggy Webb and her daughter, Stacey. discuss...</p>
          <audio controls="controls" src="https://p.scdn.co/mp3-preview/0ba9d38f5d1ad30f0e31fc8ee80c1bebf0345a0c">
            Your browser does not support the HTML5 audio element.
          </audio>
        </div>
        <div class="episodes col-md-6 pb-3">
          <h3 class="pt-3">Episode 1: Natural Learning and Accidental Homescholling</h3>
          <p><span class="time">13 min</span><span class="pl-sm-5 pl-3 date">April 1, 2021</span></p>
          <p>Peggy Webb and her daughter, Stacey. discuss...</p>
          <audio controls="controls" src="https://p.scdn.co/mp3-preview/0ba9d38f5d1ad30f0e31fc8ee80c1bebf0345a0c">
            Your browser does not support the HTML5 audio element.
          </audio>
        </div>
        <div class="episodes col-md-6 pb-4">
          <h3 class="pt-3">Episode 1: Natural Learning and Accidental Homescholling</h3>
          <p><span class="time">13 min</span><span class="pl-sm-5 pl-3 date">April 1, 2021</span></p>
          <p>Peggy Webb and her daughter, Stacey. discuss...</p>
          <audio controls="controls" src="https://p.scdn.co/mp3-preview/0ba9d38f5d1ad30f0e31fc8ee80c1bebf0345a0c">
            Your browser does not support the HTML5 audio element.
          </audio>
        </div>
      </div>
    </div>
  </div>


  <!-- <div class="border bg-light form-wrap mb-4">
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
    </div> -->
  </div>
  </div>
</main>
<!-- Choose Dates -->

@endsection
