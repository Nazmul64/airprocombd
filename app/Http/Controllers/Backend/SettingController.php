<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of all settings.
     */
    public function index()
    {
        $settings = Setting::all();
        return view('Admin.setting.index', compact('settings'));
    }

    /**
     * Show the form to create a new setting.
     */
    public function create()
    {
        return view('Admin.setting.create');
    }

    /**
     * Store a newly created setting in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->uploadFile($request->file('photo'), 'uploads/settings');
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $data['favicon'] = $this->uploadFile($request->file('favicon'), 'uploads/settings');
        }

        Setting::create($data);

        return redirect()->route('settings.index')->with('success', 'Settings created successfully.');
    }

    /**
     * Show the form for editing an existing setting.
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('Admin.setting.edit', compact('setting'));
    }

    /**
     * Update an existing setting.
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $data = $this->validateRequest($request);

        // Update photo
        if ($request->hasFile('photo')) {
            $this->deleteFile($setting->photo, 'uploads/settings');
            $data['photo'] = $this->uploadFile($request->file('photo'), 'uploads/settings');
        }

        // Update favicon
        if ($request->hasFile('favicon')) {
            $this->deleteFile($setting->favicon, 'uploads/settings');
            $data['favicon'] = $this->uploadFile($request->file('favicon'), 'uploads/settings');
        }

        $setting->update($data);

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }

    /**
     * Remove a setting.
     */
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);

        $this->deleteFile($setting->photo, 'uploads/settings');
        $this->deleteFile($setting->favicon, 'uploads/settings');

        $setting->delete();

        return redirect()->route('settings.index')->with('success', 'Settings deleted successfully.');
    }

    /**
     * Validate the request input for create/update.
     */
    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
            'favicon'      => 'nullable|image|mimes:ico,webp,png|max:2048',
            'phone'        => 'required|string|max:20',
            'email'        => 'required|email|max:100',
            'address'      => 'required|string|max:255',
            'facebook'     => 'nullable|url|max:255',
            'twitter'      => 'nullable|url|max:255',
            'linkedin'     => 'nullable|url|max:255',
            'instagram'    => 'nullable|url|max:255',
            'tilegram'     => 'nullable|url|max:255',
            'youtube'      => 'nullable|url|max:255',
            'footer_about' => 'nullable|string',
            'footer_text'  => 'nullable|string',
        ]);
    }

    /**
     * Upload a file and return its name.
     */
    protected function uploadFile($file, $folder)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path($folder), $filename);
        return $filename;
    }

    /**
     * Delete a file if it exists.
     */
    protected function deleteFile($filename, $folder)
    {
        if ($filename && file_exists(public_path("$folder/$filename"))) {
            unlink(public_path("$folder/$filename"));
        }
    }
}
