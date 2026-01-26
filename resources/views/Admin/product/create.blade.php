@extends('Admin.master')
@section('content')
<div class="container mt-5">
    <h2>Create Product</h2>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter product name" value="{{ old('product_name') }}">
            @error('product_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="product_slug" class="form-label">Product Slug</label>
            <input type="text" name="product_slug" id="product_slug" class="form-control" placeholder="Auto slug" value="{{ old('product_slug') }}">
            @error('product_slug') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="product_description" class="form-label">Description</label>
            <textarea name="product_description" class="form-control" rows="3">{{ old('product_description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" name="country" class="form-control" value="{{ old('country') }}">
        </div>

        <div class="mb-3">
            <label for="origin" class="form-label">Origin</label>
            <input type="text" name="origin" class="form-control" value="{{ old('origin') }}">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">--Select Category--</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subcategory_id" class="form-label">Subcategory</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control">
                <option value="">--Select Subcategory--</option>
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_image" class="form-label">Product Image</label>
            <input type="file" name="product_image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="multi_image" class="form-label">Multi Images</label>
            <input type="file" name="multi_image[]" multiple class="form-control">
        </div>

        <div class="mb-3">
            <label for="company_details" class="form-label">Company Details</label>
            <textarea name="company_details" class="form-control" rows="2">{{ old('company_details') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="button_title" class="form-label">Button Title</label>
            <input type="text" name="button_title" class="form-control" value="{{ old('button_title') }}">
        </div>

        <button type="submit" class="btn btn-primary">Save Product</button>
    </form>
</div>

<script>
    // Auto slug from product name
    document.getElementById('product_name').addEventListener('keyup', function(){
        let slug = this.value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        document.getElementById('product_slug').value = slug;
    });
</script>
@endsection
