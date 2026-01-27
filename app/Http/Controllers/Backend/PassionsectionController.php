<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Passionsection;
use Illuminate\Http\Request;

class PassionsectionController extends Controller
{
    public function index()
    {
        $passions = Passionsection::latest()->get();
        return view('Admin.passionsection.index', compact('passions'));
    }

    public function create()
    {
        return view('Admin.passionsection.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'pdf'         => 'nullable|mimes:pdf',
        ]);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photoName = time().'_photo.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/passion'), $photoName);
        }

        $pdfName = null;
        if ($request->hasFile('pdf')) {
            $pdfName = time().'_file.'.$request->pdf->extension();
            $request->pdf->move(public_path('uploads/passion'), $pdfName);
        }

        Passionsection::create([
            'title'       => $request->title,
            'description' => $request->description,
            'photo'       => $photoName,
            'pdf'         => $pdfName,
        ]);

        return redirect()->route('passionsection.index')
            ->with('success', 'Passion Section created successfully!');
    }

    public function edit($id)
    {
        $passion = Passionsection::findOrFail($id);
        return view('Admin.passionsection.edit', compact('passion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'pdf'         => 'nullable|mimes:pdf',
        ]);

        $passion = Passionsection::findOrFail($id);

        if ($request->hasFile('photo')) {
            if ($passion->photo && file_exists(public_path('uploads/passion/'.$passion->photo))) {
                unlink(public_path('uploads/passion/'.$passion->photo));
            }
            $photoName = time().'_photo.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/passion'), $photoName);
            $passion->photo = $photoName;
        }

        if ($request->hasFile('pdf')) {
            if ($passion->pdf && file_exists(public_path('uploads/passion/'.$passion->pdf))) {
                unlink(public_path('uploads/passion/'.$passion->pdf));
            }
            $pdfName = time().'_file.'.$request->pdf->extension();
            $request->pdf->move(public_path('uploads/passion'), $pdfName);
            $passion->pdf = $pdfName;
        }

        $passion->update([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('passionsection.index')
            ->with('success', 'Passion Section updated successfully!');
    }

    public function destroy($id)
    {
        $passion = Passionsection::findOrFail($id);

        if ($passion->photo && file_exists(public_path('uploads/passion/'.$passion->photo))) {
            unlink(public_path('uploads/passion/'.$passion->photo));
        }

        if ($passion->pdf && file_exists(public_path('uploads/passion/'.$passion->pdf))) {
            unlink(public_path('uploads/passion/'.$passion->pdf));
        }

        $passion->delete();

        return redirect()->route('passionsection.index')
            ->with('success', 'Passion Section deleted successfully!');
    }
}
