@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Edit Blog</h2>

    <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Blog Title --}}
        <div class="mb-3">
            <label class="form-label">Blog Title</label>
            <input type="text"
                   name="blog_title"
                   id="blog_title"
                   value="{{ old('blog_title', $blog->blog_title) }}"
                   class="form-control"
                   required>
        </div>

        {{-- Blog Slug --}}
        <div class="mb-3">
            <label class="form-label">Blog Slug</label>
            <input type="text"
                   id="blog_slug"
                   value="{{ $blog->blog_slug }}"
                   class="form-control"
                   readonly>
        </div>

        {{-- Blog Content --}}
        <div class="mb-3">
            <label class="form-label">Blog Content</label>
            <textarea name="blog_content"
                      class="form-control"
                      rows="5"
                      required>{{ old('blog_content', $blog->blog_content) }}</textarea>
        </div>

        {{-- Blog Category --}}
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="blog_category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $blog->blog_category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->blog_category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Old Image --}}
        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($blog->blog_image)
                <img src="{{ asset('uploads/blog/'.$blog->blog_image) }}" width="120">
            @else
                <p>No Image</p>
            @endif
        </div>

        {{-- New Image --}}
        <div class="mb-3">
            <label class="form-label">Change Image</label>
            <input type="file" name="blog_image" class="form-control">
        </div>

        <button class="btn btn-success">Update Blog</button>
        <a href="{{ route('blog.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<script>
document.getElementById('blog_title').addEventListener('keyup', function(){
    document.getElementById('blog_slug').value =
        this.value.toLowerCase()
            .replace(/[^a-z0-9]+/g,'-')
            .replace(/(^-|-$)/g,'');
});
</script>
@endsection
