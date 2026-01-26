<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('Admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('Admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_slug' => 'required|string|max:255|unique:categories,category_slug',
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category Created Successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('Admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_slug' => 'required|string|max:255|unique:categories,category_slug,' . $id,
        ]);

        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully');
    }
}
