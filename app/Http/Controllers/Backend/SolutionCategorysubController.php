<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SolutionCategory;
use App\Models\SolutionsubCategory;
use Illuminate\Http\Request;

class SolutionCategorysubController extends Controller
{
    public function index()
    {
        $subcategories = SolutionsubCategory::with('category')->latest()->get();
        return view('Admin.soluctionsubcategory.index', compact('subcategories'));
    }

    public function create()
    {
        // ❌ ভুল ছিল: SolutionsubCategory::all()
        $categories = SolutionCategory::all();
        return view('Admin.soluctionsubcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'      => 'required|exists:solution_categories,id',
            'subcategory_name' => 'required|string|max:255',
            'subcategory_slug' => 'required|string|max:255|unique:solutionsub_categories,subcategory_slug',
        ]);

        SolutionsubCategory::create($request->all());

        return redirect()->route('solutionsubcategory.index')
            ->with('success', 'SubCategory Created Successfully');
    }

    public function edit($id)
    {
        $subcategory = SolutionsubCategory::findOrFail($id);
        $categories  = SolutionCategory::all();

        return view('Admin.soluctionsubcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = SolutionsubCategory::findOrFail($id);

        $request->validate([
            'category_id'      => 'required|exists:solution_categories,id',
            'subcategory_name' => 'required|string|max:255',
            'subcategory_slug' => 'required|string|max:255|unique:solutionsub_categories,subcategory_slug,' . $id,
        ]);

        $subcategory->update($request->all());

        return redirect()->route('solutionsubcategory.index')
            ->with('success', 'SubCategory Updated Successfully');
    }

    public function destroy($id)
    {
        SolutionsubCategory::findOrFail($id)->delete();

        return redirect()->route('solutionsubcategory.index')
            ->with('success', 'SubCategory Deleted Successfully');
    }
}
