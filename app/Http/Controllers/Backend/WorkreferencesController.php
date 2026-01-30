<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Workreferencec;
use App\Models\Workreferencecategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkreferencesController extends Controller
{
    // INDEX
    public function index()
    {
        $works = Workreferencec::with('category')->latest()->get();
        return view('Admin.workreferences.index', compact('works'));
    }

    // CREATE
    public function create()
    {
        $categories = Workreferencecategory::all();
        return view('Admin.workreferences.create', compact('categories'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'work_title' => 'required|max:255',
            'work_content' => 'required',
            'work_category_id' => 'required|exists:workreferencecategories,id',
            'work_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('work_image')) {
            $imageName = time().'.'.$request->work_image->extension();
            $request->work_image->move(public_path('uploads/workreferences'), $imageName);
        }

        Workreferencec::create([
            'work_title' => $request->work_title,
            'work_slug' => Str::slug($request->work_title),
            'work_content' => $request->work_content,
            'work_category_id' => $request->work_category_id,
            'work_image' => $imageName,
        ]);

        return redirect()->route('workreferencec.index')
            ->with('success', 'Work Created Successfully');
    }

    // EDIT
    public function edit($id)
    {
        $work = Workreferencec::findOrFail($id);
        $categories = Workreferencecategory::all();
        return view('Admin.workreferences.edit', compact('work', 'categories'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $work = Workreferencec::findOrFail($id);

        $request->validate([
            'work_title' => 'required|max:255',
            'work_content' => 'required',
            'work_category_id' => 'required|exists:workreferencecategories,id',
            'work_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('work_image')) {
            if ($work->work_image && file_exists(public_path('uploads/workreferences/'.$work->work_image))) {
                unlink(public_path('uploads/workreferences/'.$work->work_image));
            }

            $imageName = time().'.'.$request->work_image->extension();
            $request->work_image->move(public_path('uploads/workreferences'), $imageName);
            $work->work_image = $imageName;
        }

        $work->update([
            'work_title' => $request->work_title,
            'work_slug' => Str::slug($request->work_title),
            'work_content' => $request->work_content,
            'work_category_id' => $request->work_category_id,
        ]);

      return back()->with('success', 'Work Updated Successfully');

    }

    // DELETE
    public function destroy($id)
    {
        $work = Workreferencec::findOrFail($id);

        if ($work->work_image && file_exists(public_path('uploads/workreferences/'.$work->work_image))) {
            unlink(public_path('uploads/workreferences/'.$work->work_image));
        }

        $work->delete();

        return redirect()->route('workreferencec.index')
            ->with('success', 'Work Deleted Successfully');
    }
}
