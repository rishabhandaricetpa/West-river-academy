<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use App\Models\Podcast;
use App\Models\Video;
use File;
use Illuminate\Http\Request;
use Storage;
use Str;

class PodcastController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::all();
        $videos = Video::all();
        $journals = Journal::all();
        return view('admin.podcasts.uploadPodcasts', compact('podcasts', 'videos', 'journals'));
    }
    public function storePodcast(Request $request)
    {
        $extension = $request->file->getClientOriginalExtension();
        $path = Str::random(40) . '.' . $extension;
        Storage::putFile(Podcast::UPLOAD_DIR_PODCAST . '/' . $path, $request->file);
        Podcast::create([
            'heading' => $request->input('heading'),
            'content' => $request->input('content'),
            'filename' => $path
        ]);
        return redirect()->back();
    }
    public function storeVideos(Request $request)
    {
        $extension = $request->file->getClientOriginalExtension();
        $path = Str::random(40) . '.' . $extension;
        Storage::putFile(Video::UPLOAD_DIR_VIDEOS . '/' . $path, $request->file);
        Video::create([
            'heading' => $request->input('heading'),
            'content' => $request->input('content'),
            'filename' => $path
        ]);
        return redirect()->back();
    }
    public function storeJournals(Request $request)
    {
        Journal::create([
            'heading' => $request->input('heading'),
            'content' => $request->input('content')
        ]);
        $notification = [
            'message' => 'Successfully Added',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
