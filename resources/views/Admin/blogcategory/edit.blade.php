@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Edit Blog Category</h3>

    <form action="{{ route('blogcategory.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Category Name</label>
            <input type="text" name="blog_category_name"
                   id="blog_category_name"
                   value="{{ $category->blog_category_name }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category Slug</label>
            <input type="text" id="blog_category_slug"
                   value="{{ $category->blog_category_slug }}"
                   class="form-control" readonly>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>

<script>
document.getElementById('blog_category_name').addEventListener('keyup', function () {
    let slug = this.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');

    document.getElementById('blog_category_slug').value = slug;
});
</script>
@endsection
