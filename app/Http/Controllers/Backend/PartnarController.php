<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PartnarController extends Controller
{
    /**
     * Display a listing of all partners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $partners = Partner::latest()->get();
        return view('Admin.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new partner.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Admin.partner.create');
    }

    /**
     * Store a newly created partner in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'photo'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $photoPath = $this->uploadPhoto($request->file('photo'));

        Partner::create([
            'photo'  => $photoPath,
            'status' => $request->status,
        ]);

        return redirect()->route('partner.index')->with('success', 'Partner added successfully!');
    }

    /**
     * Show the form for editing the specified partner.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('Admin.partner.edit', compact('partner'));
    }

    /**
     * Update the specified partner in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        // Validate input
        $request->validate([
            'new_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'    => 'required|boolean',
        ]);

        $data = ['status' => $request->status];

        // Handle new photo upload
        if ($request->hasFile('new_photo')) {
            // Delete old photo if exists
            if ($partner->photo && File::exists(public_path($partner->photo))) {
                File::delete(public_path($partner->photo));
            }

            $data['photo'] = $this->uploadPhoto($request->file('new_photo'));
        }

        $partner->update($data);

        return redirect()->route('partner.index')->with('success', 'Partner updated successfully!');
    }

    /**
     * Remove the specified partner from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        // Delete associated photo
        if ($partner->photo && File::exists(public_path($partner->photo))) {
            File::delete(public_path($partner->photo));
        }

        $partner->delete();

        return redirect()->route('partner.index')->with('success', 'Partner deleted successfully!');
    }

    /**
     * Upload photo and return its path.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return string
     */
    private function uploadPhoto($photo)
    {
        $photoName = Str::uuid() . '.' . $photo->getClientOriginalExtension();
        $uploadPath = public_path('uploads/partners');

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $photo->move($uploadPath, $photoName);

        return 'uploads/partners/' . $photoName;
    }
}
