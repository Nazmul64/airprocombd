@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Edit Work Reference</h2>

    <form action="{{ route('workreferencec.update', $work->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="work_title" value="{{ old('work_title', $work->work_title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="work_content" class="form-control" rows="5" required>{{ old('work_content', $work->work_content) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="work_category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $work->work_category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($work->work_image)
                <img src="{{ asset('uploads/workreferences/'.$work->work_image) }}" width="120">
            @else
                <p>No Image</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Change Image</label>
            <input type="file" name="work_image" class="form-control">
        </div>

        <button class="btn btn-success">Update</button>

    </form>
</div>
@endsection
