<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
  use App\Models\Workreferencecategory;
class WorkreferencescategoryController extends Controller
{
     public function index()
    {
        $categories =Workreferencecategory::latest()->get();
        return view('Admin.workreferencecategory.index',compact('categories'));
    }

    public function create()
    {
           return view('Admin.workreferencecategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_slug' => 'required|string|max:255|unique:workreferencecategories,category_slug',
        ]);

        Workreferencecategory::create([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
        ]);

        return redirect()->route('workreferencecategory.index')->with('success', 'Category Created Successfully');
    }

    public function edit($id)
    {
        $category = Workreferencecategory::findOrFail($id);
        return view('Admin.workreferencecategory.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Workreferencecategory::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_slug' => 'required|string|max:255|unique:workreferencecategories,category_slug,' . $id,
        ]);

        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
        ]);

        return redirect()->route('workreferencecategory.index')->with('success', 'Category Updated Successfully');
    }

    public function destroy($id)
    {
        Workreferencecategory::findOrFail($id)->delete();
        return redirect()->route('workreferencecategory.index')->with('success', 'Category Deleted Successfully');
    }
}
