<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::with('category')->latest()->get();
        return view('Admin.subcategory.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Admin.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required',
            'subcategory_name'  => 'required|string|max:255',
            'subcategory_slug'  => 'required|string|max:255|unique:sub_categories,subcategory_slug',
        ]);

        SubCategory::create($request->all());

        return redirect()->route('subcategories.index')
            ->with('success', 'SubCategory Created Successfully');
    }

    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('Admin.subcategory.edit', compact('subcategory','categories'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $request->validate([
            'category_id'       => 'required',
            'subcategory_name'  => 'required|string|max:255',
            'subcategory_slug'  => 'required|string|max:255|unique:sub_categories,subcategory_slug,' . $id,
        ]);

        $subcategory->update($request->all());

        return redirect()->route('subcategories.index')
            ->with('success', 'SubCategory Updated Successfully');
    }

    public function destroy($id)
    {
        SubCategory::findOrFail($id)->delete();
        return redirect()->route('subcategories.index')
            ->with('success', 'SubCategory Deleted Successfully');
    }
}
