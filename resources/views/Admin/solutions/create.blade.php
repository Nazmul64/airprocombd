@extends('Admin.master')

@section('content')
<div class="container mt-4">
    <h3>Add New Solution</h3>

    <form action="{{ route('solutions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="soluction_category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Sub Category</label>
            <select name="soluctionsub_category_id" class="form-control" required>
                <option value="">-- Select Sub Category --</option>
                @foreach($subcategories as $sub)
                    <option value="{{ $sub->id }}">{{ $sub->subcategory_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-success">Save Solution</button>
        <a href="{{ route('solutions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
