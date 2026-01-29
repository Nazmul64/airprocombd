<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contactinfo;
use Illuminate\Http\Request;

class ContactinfoController extends Controller
{
    public function index()
    {
        $contactinfos =Contactinfo::latest()->get();
        return view('Admin.contactinfo.index', compact('contactinfos'));
    }

    public function create()
    {
        return view('Admin.contactinfo.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('call_photo')) {
            $data['call_photo'] = $this->uploadImage($request->file('call_photo'));
        }

        if ($request->hasFile('location_photo')) {
            $data['location_photo'] = $this->uploadImage($request->file('location_photo'));
        }

        if ($request->hasFile('email_photo')) {
            $data['email_photo'] = $this->uploadImage($request->file('email_photo'));
        }

        if ($request->hasFile('main_photo')) {
            $data['main_photo'] = $this->uploadImage($request->file('main_photo'));
        }

        Contactinfo::create($data);

        return redirect()->route('contactinfo.index')
            ->with('success', 'Contact Info Added Successfully');
    }

    public function edit(Contactinfo $contactinfo)
    {
        return view('Admin.contactinfo.edit', compact('contactinfo'));
    }

    public function update(Request $request, Contactinfo $contactinfo)
    {
        $data = $request->all();

        foreach (['call_photo', 'location_photo', 'email_photo', 'main_photo'] as $photo) {
            if ($request->hasFile($photo)) {
                $data[$photo] = $this->uploadImage($request->file($photo));
            }
        }

        $contactinfo->update($data);

        return redirect()->route('contactinfo.index')
            ->with('success', 'Contact Info Updated Successfully');
    }

    public function destroy(Contactinfo $contactinfo)
    {
        $contactinfo->delete();

        return redirect()->route('contactinfo.index')
            ->with('success', 'Contact Info Deleted Successfully');
    }

    // 🔥 Image Upload Helper
    private function uploadImage($file)
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/contactinfo'), $filename);
        return 'uploads/contactinfo/' . $filename;
    }
}
