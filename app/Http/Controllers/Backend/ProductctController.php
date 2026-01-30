<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class ProductctController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::with('category', 'subcategory')->latest()->get();
        return view('Admin.product.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('Admin.product.create', compact('categories', 'subcategories'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_slug' => 'required|string|max:255|unique:products,product_slug',
            'category_id'  => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'product_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'multi_image.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Single Image
        $productImage = null;
        if ($request->hasFile('product_image')) {
            $productImage = time().'.'.$request->product_image->extension();
            $request->product_image->move(public_path('uploads/products'), $productImage);
        }

        // Multiple Images
        $multiImages = [];
        if ($request->hasFile('multi_image')) {
            foreach ($request->file('multi_image') as $file) {
                $name = time().'_'.uniqid().'.'.$file->extension();
                $file->move(public_path('uploads/products/multi'), $name);
                $multiImages[] = $name;
            }
        }

        Product::create([
            'product_name' => $request->product_name,
            'product_slug' => $request->product_slug,
            'product_description' => $request->product_description,
            'brand' => $request->brand,
            'country' => $request->country,
            'origin' => $request->origin,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_image' => $productImage,
            'multi_image' => json_encode($multiImages),
            'company_details' => $request->company_details,
            'button_title' => $request->button_title,
        ]);

        return redirect()->route('product.index')->with('success','Product Created Successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('Admin.product.edit', compact('product','categories','subcategories'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_slug' => 'required|string|max:255|unique:products,product_slug,'.$id,
            'category_id'  => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'multi_image.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update single image if uploaded
        if ($request->hasFile('product_image')) {
            $imageName = time().'.'.$request->product_image->extension();
            $request->product_image->move(public_path('uploads/products'), $imageName);
            $product->product_image = $imageName;
        }

        // Update multiple images if uploaded
        if ($request->hasFile('multi_image')) {
            $multiImages = [];
            foreach ($request->file('multi_image') as $file) {
                $name = time().'_'.uniqid().'.'.$file->extension();
                $file->move(public_path('uploads/products/multi'), $name);
                $multiImages[] = $name;
            }
            $product->multi_image = json_encode($multiImages);
        }

        $product->update([
            'product_name' => $request->product_name,
            'product_slug' => $request->product_slug,
            'product_description' => $request->product_description,
            'brand' => $request->brand,
            'country' => $request->country,
            'origin' => $request->origin,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'company_details' => $request->company_details,
            'button_title' => $request->button_title,
        ]);

        return redirect()->route('product.index')->with('success','Product Updated Successfully');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete images
        if ($product->product_image && file_exists(public_path('uploads/products/'.$product->product_image))) {
            unlink(public_path('uploads/products/'.$product->product_image));
        }
        if ($product->multi_image) {
            foreach(json_decode($product->multi_image) as $img) {
                if(file_exists(public_path('uploads/products/multi/'.$img))) {
                    unlink(public_path('uploads/products/multi/'.$img));
                }
            }
        }

        $product->delete();
        return redirect()->route('product.index')->with('success','Product Deleted Successfully');
    }
}
