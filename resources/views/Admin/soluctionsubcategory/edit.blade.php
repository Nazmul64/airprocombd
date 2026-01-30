@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Edit SubCategory</h3>

    <form action="{{ route('solutionsubcategory.update',$subcategory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $subcategory->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>SubCategory Name</label>
            <input type="text" id="subcategory_name"
                   name="subcategory_name"
                   value="{{ $subcategory->subcategory_name }}"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>SubCategory Slug</label>
            <input type="text" id="subcategory_slug"
                   name="subcategory_slug"
                   value="{{ $subcategory->subcategory_slug }}"
                   class="form-control">
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>

<script>
document.getElementById('subcategory_name').addEventListener('keyup', function () {
    document.getElementById('subcategory_slug').value =
        this.value.toLowerCase().trim()
        .replace(/[^a-z0-9\s-]/g,'')
        .replace(/\s+/g,'-')
        .replace(/-+/g,'-');
});
</script>
@endsection
