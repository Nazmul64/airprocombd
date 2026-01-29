<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blogcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // List all blogs
    public function index()
    {
        $blogs = Blog::with('category')->latest()->get();
        return view('Admin.blog.index', compact('blogs'));
    }

    // Show create form
    public function create()
    {
        $categories = Blogcategory::all();
        return view('Admin.blog.create', compact('categories'));
    }

    // Store new blog
    public function store(Request $request)
    {
        $request->validate([
            'blog_title' => 'required|max:255',
            'blog_content' => 'required',
            'blog_category_id' => 'required|exists:blogcategories,id',
            'blog_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('blog_image')) {
            $imageName = time() . '.' . $request->blog_image->extension();
            $request->blog_image->move(public_path('uploads/blog'), $imageName);
        }

        Blog::create([
            'blog_title' => $request->blog_title,
            'blog_slug' => Str::slug($request->blog_title),
            'blog_content' => $request->blog_content,
            'blog_category_id' => $request->blog_category_id,
            'blog_image' => $imageName,
        ]);

        return redirect()->route('blog.index')->with('success', 'Blog Created Successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Blogcategory::all();
        return view('Admin.blog.edit', compact('blog', 'categories'));
    }

    // Update blog
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'blog_title' => 'required|max:255',
            'blog_content' => 'required',
            'blog_category_id' => 'required|exists:blogcategories,id',
            'blog_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('blog_image')) {
            $imageName = time() . '.' . $request->blog_image->extension();
            $request->blog_image->move(public_path('uploads/blog'), $imageName);
            $blog->blog_image = $imageName;
        }

        $blog->update([
            'blog_title' => $request->blog_title,
            'blog_slug' => Str::slug($request->blog_title),
            'blog_content' => $request->blog_content,
            'blog_category_id' => $request->blog_category_id,
        ]);

        return redirect()->route('blog.index')->with('success', 'Blog Updated Successfully');
    }

    // Delete blog
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Delete image file if exists
        if ($blog->blog_image && file_exists(public_path('uploads/blog/'.$blog->blog_image))) {
            unlink(public_path('uploads/blog/'.$blog->blog_image));
        }

        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Blog Deleted Successfully');
    }
}
