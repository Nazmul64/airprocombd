<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductctController extends Controller
{
   public function index()
{
    $products = Product::with('category', 'subcategory')->latest()->get();
    return view('Admin.product.index', compact('products'));
}

    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('Admin.product.create', compact('categories','subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_slug' => 'required|unique:products,product_slug',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_image' => 'required|image',
            'multi_image.*' => 'image',
        ]);

        $data = $request->all();

        // Single Image
        if ($request->hasFile('product_image')) {
            $name = time().'_'.$request->product_image->getClientOriginalName();
            $request->product_image->move(public_path('uploads/products'), $name);
            $data['product_image'] = $name;
        }

        // Multi Image
        if ($request->hasFile('multi_image')) {
            $images = [];
            foreach ($request->file('multi_image') as $img) {
                $imgName = time().'_'.$img->getClientOriginalName();
                $img->move(public_path('uploads/products/multi'), $imgName);
                $images[] = $imgName;
            }
            $data['multi_image'] = json_encode($images);
        }

        Product::create($data);

        return redirect()->route('product.index')->with('success','Product Created');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('Admin.product.edit', compact('product','categories','subcategories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('product_image')) {
            $name = time().'_'.$request->product_image->getClientOriginalName();
            $request->product_image->move(public_path('uploads/products'), $name);
            $data['product_image'] = $name;
        }

        if ($request->hasFile('multi_image')) {
            $images = [];
            foreach ($request->file('multi_image') as $img) {
                $imgName = time().'_'.$img->getClientOriginalName();
                $img->move(public_path('uploads/products/multi'), $imgName);
                $images[] = $imgName;
            }
            $data['multi_image'] = json_encode($images);
        }

        $product->update($data);
        return redirect()->route('product.index')->with('success','Product Updated');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success','Product Deleted');
    }
}
