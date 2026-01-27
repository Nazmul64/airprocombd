<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Solutionprovider;
use Illuminate\Http\Request;

class SolutionproviderController extends Controller
{
    public function index()
    {
        $solutions = Solutionprovider::latest()->get();
        return view('Admin.solutionprovider.index', compact('solutions'));
    }

    public function create()
    {
        return view('Admin.solutionprovider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photoName = time().'_solution.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/solutionprovider'), $photoName);
        }

        Solutionprovider::create([
            'title' => $request->title,
            'photo' => $photoName,
        ]);

        return redirect()->route('solutionprovider.index')
            ->with('success', 'Solution Provider created successfully!');
    }

    public function edit($id)
    {
        $solution = Solutionprovider::findOrFail($id);
        return view('Admin.solutionprovider.edit', compact('solution'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $solution = Solutionprovider::findOrFail($id);

        if ($request->hasFile('photo')) {
            if ($solution->photo && file_exists(public_path('uploads/solutionprovider/'.$solution->photo))) {
                unlink(public_path('uploads/solutionprovider/'.$solution->photo));
            }

            $photoName = time().'_solution.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/solutionprovider'), $photoName);
            $solution->photo = $photoName;
        }

        $solution->update([
            'title' => $request->title,
        ]);

        return redirect()->route('solutionprovider.index')
            ->with('success', 'Solution Provider updated successfully!');
    }

    public function destroy($id)
    {
        $solution = Solutionprovider::findOrFail($id);

        if ($solution->photo && file_exists(public_path('uploads/solutionprovider/'.$solution->photo))) {
            unlink(public_path('uploads/solutionprovider/'.$solution->photo));
        }

        $solution->delete();

        return redirect()->route('solutionprovider.index')
            ->with('success', 'Solution Provider deleted successfully!');
    }
}
