@extends('admin.app')

@section('content')


    <div class="container-fluid position-relative mt-5">
        <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
                <div class="card-header d-flex p-0">
                    <h3 class="card-title p-3 mb-0">UPLOAD PODCAST AUDIOS AND VIDEOS</h3>
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Podcasts</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Journals</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Videos</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <form action="{{ route('admin.podcast.store') }}" method="post" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label> HEADING <sup>*</sup></label>
                                    <input class="form-control" value="" name="heading" required>
                                    <label class="pt-3"> UPLOAD PODCAST<sup>*</sup></label>
                                    <input type="file" name="file" class="form-control choose-btn" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Content <sup>*</sup></label>
                                    <textarea class="form-control h-120" value="" name="content" required></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <input type="submit" class='btn btn-primary'>
                                </div>
                            </form>

                            @if (count($podcasts) > 0)

                                <h2 class="text-center border-top pt-4 mt-3">Uploaded Podcast</h2>
                                <div class="row pt-4">
                                    @foreach ($podcasts as $podcast)
                                        <div class="col-md-6">
                                            <h3>{{ $podcast->heading }}</h3>
                                            <p>{{ $podcast->content }}</p>
                                            <audio id="example_video_1"
                                                class="video-js vjs-default-skin vjs-big-play-centered" controls
                                                preload="auto">
                                                <source src="{{ $podcast->podcast_url }}" />
                                            </audio>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- /.tab-pane for journals-->

                        <div class="tab-pane" id="tab_2">
                            <form method="post" action="{{ route('admin.journal.store') }}" class="row">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label> HEADING <sup>*</sup></label>
                                    <input class="form-control" value="" name="heading" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Content <sup>*</sup></label>
                                    <textarea class="form-control" value="" name="content" required></textarea>
                                </div>

                                <div class="form-group col-12">
                                    <input type="submit" class='btn btn-primary'>
                                </div>

                                @if (count($journals) > 0)
                                    <div class="row  border-top pt-4 mt-3">
                                        <div class="col-12">
                                            <h2 class="text-center">Uploaded Journal</h2>

                                            @foreach ($journals as $journal)
                                                <h3 class="py-2"><a href="#">{{ $journal->heading }}</a></h3>
                                                <p>{{ $journal->content }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            </form>
                        </div>
                        <!-- /.tab-pane  for videos-->
                        <div class="tab-pane" id="tab_3">
                            <form method="post" action="{{ route('admin.videos.store') }}" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label> HEADING <sup>*</sup></label>
                                    <input class="form-control" value="" name="heading" required>
                                    <label class="pt-3"> UPLOAD VIDEOS<sup>*</sup></label>
                                    <input type="file" name="file" class="form-control choose-btn" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Content <sup>*</sup></label>
                                    <textarea class="form-control h-120" value="" name="content" required></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <input type="submit" class='btn btn-primary'>
                                </div>
                                <div class="col-12 border-top pt-4 mt-3">
                                    @if (count($videos) > 0)
                                        <h2 class="text-center"> Uploaded videos</h2>
                                        @foreach ($videos as $video)
                                            <div class="row align-items-center py-2r ">

                                                <div class="col-md-4 my-2">
                                                    <div class="embed-responsive embed-responsive-16by9">

                                                        <video id="example_video_1"
                                                            class="video-js vjs-default-skin vjs-big-play-centered" controls
                                                            preload="auto">
                                                            <source src="{{ $video->videos_url }}" />
                                                        </video>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 my-2">
                                                    <h2>{{ $video->heading }}</h2>
                                                    <p>{{ $video->content }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>

                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
