<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Podcast;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoLibrary extends Controller
{
    public function index()
    {
        $podcasts = Podcast::all();
        $videos = Video::all();
        $journals = Journal::all();
        return view('videos.video_library', compact('podcasts', 'videos', 'journals'));
    }
}
