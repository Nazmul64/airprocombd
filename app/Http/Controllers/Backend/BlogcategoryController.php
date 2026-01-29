<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blogcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogcategoryController extends Controller
{
    public function index()
    {
        $categories = Blogcategory::latest()->get();
        return view('Admin.blogcategory.index', compact('categories'));
    }

    public function create()
    {
        return view('Admin.blogcategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'blog_category_name' => 'required|max:255',
        ]);

        Blogcategory::create([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => Str::slug($request->blog_category_name),
        ]);

        return redirect()->route('blogcategory.index')
            ->with('success', 'Category Created Successfully');
    }

    public function edit($id)
    {
        $category = Blogcategory::findOrFail($id);
        return view('Admin.blogcategory.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Blogcategory::findOrFail($id);

        $request->validate([
            'blog_category_name' => 'required|max:255',
        ]);

        $category->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => Str::slug($request->blog_category_name),
        ]);

        return redirect()->route('blogcategory.index')
            ->with('success', 'Category Updated Successfully');
    }

    public function destroy($id)
    {
        Blogcategory::findOrFail($id)->delete();

        return redirect()->route('blogcategory.index')
            ->with('success', 'Category Deleted Successfully');
    }
}
