@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Add New Work Reference</h2>

    <form action="{{ route('workreferencec.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="work_title" class="form-control" placeholder="Enter Title" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="work_content" class="form-control" rows="5" placeholder="Enter Content" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="work_category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="work_image" class="form-control" required>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('workreferencec.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
