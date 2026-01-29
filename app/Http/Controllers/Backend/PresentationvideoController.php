<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Presentationvideo;
use Illuminate\Http\Request;

class PresentationvideoController extends Controller
{
    // index
    public function index()
    {
        $videos = Presentationvideo::latest()->get();
        return view('Admin.Presentationvideo.index', compact('videos'));
    }

    // create
    public function create()
    {
        return view('Admin.Presentationvideo.create');
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'video_link' => 'required|url',
        ]);

        Presentationvideo::create([
            'video_link' => $request->video_link,
        ]);

        return redirect()->route('Presentationvideo.index')
            ->with('success', 'Presentation Video Added Successfully');
    }

    // edit
    public function edit($id)
    {
        $video = Presentationvideo::findOrFail($id);
        return view('Admin.Presentationvideo.edit', compact('video'));
    }

    // update
    public function update(Request $request, $id)
    {
        $video = Presentationvideo::findOrFail($id);

        $request->validate([
            'video_link' => 'required|url',
        ]);

        $video->update([
            'video_link' => $request->video_link,
        ]);

        return redirect()->route('Presentationvideo.index')
            ->with('success', 'Presentation Video Updated Successfully');
    }

    // destroy
    public function destroy($id)
    {
        Presentationvideo::findOrFail($id)->delete();

        return redirect()->route('Presentationvideo.index')
            ->with('success', 'Presentation Video Deleted Successfully');
    }
}
