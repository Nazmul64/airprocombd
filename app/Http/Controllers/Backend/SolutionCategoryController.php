<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SolutionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SolutionCategoryController extends Controller
{
    public function index()
    {
        $categories = SolutionCategory::latest()->get();
        return view('Admin.solutioncategory.index', compact('categories'));
    }

    public function create()
    {
        return view('Admin.solutioncategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_slug' => 'required|string|max:255|unique:solution_categories,category_slug',
        ]);

        SolutionCategory::create([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
        ]);

        return redirect()->route('solutioncategory.index')->with('success', 'solutioncategory Created Successfully');
    }

    public function edit($id)
    {
        $category = SolutionCategory::findOrFail($id);
        return view('Admin.solutioncategory.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = SolutionCategory::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_slug' => 'required|string|max:255|unique:solution_categories,category_slug,' . $id,
        ]);

        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
        ]);

        return redirect()->route('solutioncategory.index')->with('success', 'solutioncategory Updated Successfully');
    }

    public function destroy($id)
    {
        SolutionCategory::findOrFail($id)->delete();
        return redirect()->route('solutioncategory.index')->with('success', 'solutioncategory Deleted Successfully');
    }
}
