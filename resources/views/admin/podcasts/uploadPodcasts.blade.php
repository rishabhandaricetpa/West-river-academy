@extends('admin.app')

@section('content')


    <div class="container-fluid position-relative mt-5">
        <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
                <div class="card-header d-flex p-0">
                    <h3 class="card-title p-3">UPLOAD PODCAST AUDIOS AND VIDEOS</h3>
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
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Content <sup>*</sup></label>
                                    <textarea class="form-control" value="" name="content" required></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> UPLOAD PODCAST<sup>*</sup></label>
                                    <input type="file" name="file" class="form-control choose-btn" required>
                                </div>
                                <div class="form-group col-12">
                                    <input type="submit" class='btn btn-primary'>
                                </div>

                            </form>
                            @if (count($podcasts) > 0)
                                Uploaded Podcast
                                @foreach ($podcasts as $podcast)
                                    <h2>{{ $podcast->heading }}</h2>
                                    <p>{{ $podcast->content }}</p>
                                    <audio id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
                                        controls preload="auto">

                                        <source src="{{ $podcast->podcast_url }}" />
                                    </audio>
                                @endforeach
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
                                    Uploaded Journals
                                    @foreach ($journals as $journal)
                                        Heading <h2>{{ $journal->heading }}</h2>
                                        Content <p>{{ $journal->content }}</p>
                                    @endforeach
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
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Content <sup>*</sup></label>
                                    <textarea class="form-control" value="" name="content" required></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> UPLOAD VIDEOS<sup>*</sup></label>
                                    <input type="file" name="file" class="form-control choose-btn" required>
                                </div>
                                <div class="form-group col-12">
                                    <input type="submit" class='btn btn-primary'>
                                </div>
                                @if (count($videos) > 0)
                                    Uploaded videos
                                    @foreach ($videos as $video)
                                        <h2>{{ $video->heading }}</h2>
                                        <p>{{ $video->content }}</p>
                                        <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
                                            controls preload="auto">

                                            <source src="{{ $video->videos_url }}" />
                                        </video>
                                    @endforeach
                                @endif
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
