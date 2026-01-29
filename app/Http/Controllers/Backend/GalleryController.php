<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // index
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('Admin.gallery.index', compact('galleries'));
    }

    // create
    public function create()
    {
        return view('Admin.gallery.create');
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads/gallery'), $imageName);

        Gallery::create([
            'photo' => $imageName,
        ]);

        return redirect()->route('gallery.index')
            ->with('success', 'Gallery Image Added Successfully');
    }

    // edit
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('Admin.gallery.edit', compact('gallery'));
    }

    // update
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // old image delete
            if ($gallery->photo && file_exists(public_path('uploads/gallery/'.$gallery->photo))) {
                unlink(public_path('uploads/gallery/'.$gallery->photo));
            }

            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/gallery'), $imageName);

            $gallery->photo = $imageName;
            $gallery->save();
        }

        return redirect()->route('gallery.index')
            ->with('success', 'Gallery Image Updated Successfully');
    }

    // destroy
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->photo && file_exists(public_path('uploads/gallery/'.$gallery->photo))) {
            unlink(public_path('uploads/gallery/'.$gallery->photo));
        }

        $gallery->delete();

        return redirect()->route('gallery.index')
            ->with('success', 'Gallery Image Deleted Successfully');
    }
}
