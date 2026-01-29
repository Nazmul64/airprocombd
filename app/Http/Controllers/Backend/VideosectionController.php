<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Videosection;
use Illuminate\Http\Request;

class VideosectionController extends Controller
{
    // List all videos
    public function index()
    {
        $videos = Videosection::latest()->get();
        return view('Admin.videosection.index', compact('videos'));
    }

    // Show create form
    public function create()
    {
        return view('Admin.videosection.create');
    }

    // Store new video
    public function store(Request $request)
    {
        $request->validate([
            'video_title' => 'required|max:255',
            'video_link' => 'required|url',
            'description' => 'nullable',
        ]);

        Videosection::create([
            'video_title' => $request->video_title,
            'video_link' => $request->video_link,
            'description' => $request->description,
        ]);

        return redirect()->route('videosection.index')->with('success', 'Video Section Created Successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $video = Videosection::findOrFail($id);
        return view('Admin.videosection.edit', compact('video'));
    }

    // Update video
    public function update(Request $request, $id)
    {
        $video = Videosection::findOrFail($id);

        $request->validate([
            'video_title' => 'required|max:255',
            'video_link' => 'required|url',
            'description' => 'nullable',
        ]);

        $video->update([
            'video_title' => $request->video_title,
            'video_link' => $request->video_link,
            'description' => $request->description,
        ]);

        return redirect()->route('videosection.index')->with('success', 'Video Section Updated Successfully');
    }

    // Delete video
    public function destroy($id)
    {
        $video = Videosection::findOrFail($id);
        $video->delete();

        return redirect()->route('videosection.index')->with('success', 'Video Section Deleted Successfully');
    }
}
