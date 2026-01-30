@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Edit Category</h3>

    <form action="{{ route('solutioncategory.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Category Name</label>
            <input type="text" name="category_name" id="category_name"
                   value="{{ $category->category_name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Category Slug</label>
            <input type="text" name="category_slug" id="category_slug"
                   value="{{ $category->category_slug }}" class="form-control">
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>

<script>
    document.getElementById('category_name').addEventListener('keyup', function () {
        let slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        document.getElementById('category_slug').value = slug;
    });
</script>
@endsection
