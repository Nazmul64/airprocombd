@extends('Admin.master')
@section('content')
<div class="container mt-5">
    <h2>Edit Product</h2>
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $product->product_name }}">
        </div>

        <div class="mb-3">
            <label for="product_slug" class="form-label">Product Slug</label>
            <input type="text" name="product_slug" id="product_slug" class="form-control" value="{{ $product->product_slug }}">
        </div>

        <div class="mb-3">
            <label for="product_description" class="form-label">Description</label>
            <textarea name="product_description" class="form-control" rows="3">{{ $product->product_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" value="{{ $product->brand }}">
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" name="country" class="form-control" value="{{ $product->country }}">
        </div>

        <div class="mb-3">
            <label for="origin" class="form-label">Origin</label>
            <input type="text" name="origin" class="form-control" value="{{ $product->origin }}">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id==$category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subcategory_id" class="form-label">Subcategory</label>
            <select name="subcategory_id" class="form-control">
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" {{ $product->subcategory_id==$subcategory->id ? 'selected' : '' }}>{{ $subcategory->subcategory_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_image" class="form-label">Product Image</label>
            <input type="file" name="product_image" class="form-control">
            <img src="{{ asset('uploads/products/'.$product->product_image) }}" width="50" class="mt-2">
        </div>

        <div class="mb-3">
            <label for="multi_image" class="form-label">Multi Images</label>
            <input type="file" name="multi_image[]" multiple class="form-control mt-2">
            @if($product->multi_image)
                @foreach(json_decode($product->multi_image) as $img)
                    <img src="{{ asset('uploads/products/multi/'.$img) }}" width="50">
                @endforeach
            @endif
        </div>

        <div class="mb-3">
            <label for="company_details" class="form-label">Company Details</label>
            <textarea name="company_details" class="form-control">{{ $product->company_details }}</textarea>
        </div>

        <div class="mb-3">
            <label for="button_title" class="form-label">Button Title</label>
            <input type="text" name="button_title" class="form-control" value="{{ $product->button_title }}">
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Product</button>
    </form>
</div>

<script>
    // Auto slug from product name
    document.getElementById('product_name').addEventListener('keyup', function(){
        document.getElementById('product_slug').value =
            this.value.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
    });
</script>
@endsection
