<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    // List all subcategories
    public function index()
    {
        $subcategories = SubCategory::with('category')->latest()->get();
        return view('Admin.subcategory.index', compact('subcategories'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('Admin.subcategory.create', compact('categories'));
    }

    // Store new subcategory
    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'subcategory_name'  => 'required|string|max:255',
            'subcategory_slug'  => 'required|string|max:255|unique:subcategories,subcategory_slug',
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => $request->subcategory_slug,
        ]);

        return redirect()->route('subcategories.index')
            ->with('success', 'SubCategory Created Successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('Admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    // Update subcategory
    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'subcategory_name'  => 'required|string|max:255',
            'subcategory_slug'  => 'required|string|max:255|unique:subcategories,subcategory_slug,' . $id,
        ]);

        $subcategory->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => $request->subcategory_slug,
        ]);

        return redirect()->route('subcategories.index')
            ->with('success', 'SubCategory Updated Successfully');
    }

    // Delete subcategory
    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('subcategories.index')
            ->with('success', 'SubCategory Deleted Successfully');
    }
}
