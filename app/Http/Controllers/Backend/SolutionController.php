<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use App\Models\SolutionCategory;
use App\Models\SolutionsubCategory;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    // 🔹 INDEX
    public function index()
    {
        $solutions = Solution::with(['category', 'subcategory'])
            ->latest()
            ->get();

        return view('Admin.solutions.index', compact('solutions'));
    }

    // 🔹 CREATE
    public function create()
    {
        $categories = SolutionCategory::all();
        $subcategories = SolutionsubCategory::all();

        return view('Admin.solutions.create', compact('categories', 'subcategories'));
    }

    // 🔹 STORE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'soluction_category_id' => 'required',
            'soluctionsub_category_id' => 'required',
            'photo' => 'nullable|image',
        ]);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/solutions'), $photoName);
        }

        Solution::create([
            'title' => $request->title,
            'description' => $request->description,
            'soluction_category_id' => $request->soluction_category_id,
            'soluctionsub_category_id' => $request->soluctionsub_category_id,
            'photo' => $photoName,
        ]);

        return redirect()->route('solutions.index')
            ->with('success', 'Solution Created Successfully');
    }

    // 🔹 EDIT
    public function edit(string $id)
    {
        $solution = Solution::findOrFail($id);
        $categories = SolutionCategory::all();
        $subcategories = SolutionsubCategory::all();

        return view(
            'Admin.solutions.edit',
            compact('solution', 'categories', 'subcategories')
        );
    }

    // 🔹 UPDATE
    public function update(Request $request, string $id)
    {
        $solution = Solution::findOrFail($id);

        $photoName = $solution->photo;
        if ($request->hasFile('photo')) {
            if ($photoName && file_exists(public_path('uploads/solutions/' . $photoName))) {
                unlink(public_path('uploads/solutions/' . $photoName));
            }

            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/solutions'), $photoName);
        }

        $solution->update([
            'title' => $request->title,
            'description' => $request->description,
            'soluction_category_id' => $request->soluction_category_id,
            'soluctionsub_category_id' => $request->soluctionsub_category_id,
            'photo' => $photoName,
        ]);

        return redirect()->route('solutions.index')
            ->with('success', 'Solution Updated Successfully');
    }

    // 🔹 DELETE
    public function destroy(string $id)
    {
        $solution = Solution::findOrFail($id);

        if ($solution->photo && file_exists(public_path('uploads/solutions/' . $solution->photo))) {
            unlink(public_path('uploads/solutions/' . $solution->photo));
        }

        $solution->delete();

        return redirect()->route('solutions.index')
            ->with('success', 'Solution Deleted Successfully');
    }
}
