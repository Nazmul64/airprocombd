@extends('Admin.master')
@section('content')
<div class="container mt-5">
    <h2>Products List</h2>
    <a href="{{ route('product.create') }}" class="btn btn-success mb-3">Add Product</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Image</th>
                <th>Multi Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->category->category_name ?? 'N/A' }}</td>
                <td>{{ $product->subcategory->subcategory_name ?? 'N/A' }}</td>

                <td>
                    <img src="{{ asset('uploads/products/'.$product->product_image) }}" width="50">
                </td>
                <td>
                    @if($product->multi_image)
                        @foreach(json_decode($product->multi_image) as $img)
                            <img src="{{ asset('uploads/products/multi/'.$img) }}" width="50">
                        @endforeach
                    @endif
                </td>
                <td>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
