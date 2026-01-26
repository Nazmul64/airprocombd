@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Create SubCategory</h3>

    <form action="{{ route('subcategories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>SubCategory Name</label>
            <input type="text" name="subcategory_name" id="subcategory_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>SubCategory Slug</label>
            <input type="text" name="subcategory_slug" id="subcategory_slug" class="form-control" readonly>
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>

<script>
    document.getElementById('subcategory_name').addEventListener('keyup', function () {
        let slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        document.getElementById('subcategory_slug').value = slug;
    });
</script>
@endsection
