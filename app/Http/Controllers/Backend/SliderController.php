<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the sliders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('Admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new slider.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Admin.slider.create');
    }

    /**
     * Store a newly created slider in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:0,1',
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo      = $request->file('photo');
            $photoName  = Str::uuid() . '.' . $photo->getClientOriginalExtension();
            $uploadPath = public_path('uploads/slider');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $photo->move($uploadPath, $photoName);
            $photoPath = 'uploads/slider/' . $photoName;
        }

        // Create new slider record
        Slider::create([
            'title'       => $request->title,
            'description' => $request->description,
            'photo'       => $photoPath,
            'status'      => $request->status,
        ]);

        return redirect()->route('slider.index')
                         ->with('success', 'Slider created successfully!');
    }

    /**
     * Show the form for editing the specified slider.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('Admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified slider in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        // Validate incoming request
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:0,1',
        ]);

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status,
        ];

        // Handle photo replacement
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($slider->photo && File::exists(public_path($slider->photo))) {
                File::delete(public_path($slider->photo));
            }

            $photo      = $request->file('photo');
            $photoName  = Str::uuid() . '.' . $photo->getClientOriginalExtension();
            $uploadPath = public_path('uploads/slider');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $photo->move($uploadPath, $photoName);
            $data['photo'] = 'uploads/slider/' . $photoName;
        }

        // Update slider
        $slider->update($data);

        return redirect()->route('slider.index')
                         ->with('success', 'Slider updated successfully!');
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        // Delete associated photo
        if ($slider->photo && File::exists(public_path($slider->photo))) {
            File::delete(public_path($slider->photo));
        }

        // Delete slider record
        $slider->delete();

        return redirect()->route('slider.index')
                         ->with('success', 'Slider deleted successfully!');
    }
}
