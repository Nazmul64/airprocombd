@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Create Blog</h2>

    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="blog_title" id="blog_title"
               class="form-control mb-2" placeholder="Blog Title">

        <input type="text" id="blog_slug"
               class="form-control mb-2" placeholder="Slug" readonly>

        <textarea name="blog_content" class="form-control mb-2"
                  placeholder="Blog Content"></textarea>

        <select name="blog_category_id" class="form-control mb-2">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->blog_category_name }}
                </option>
            @endforeach
        </select>

        <input type="file" name="blog_image" class="form-control mb-3">

        <button class="btn btn-primary">Save Blog</button>
    </form>
</div>

<script>
document.getElementById('blog_title').addEventListener('keyup', function(){
    document.getElementById('blog_slug').value =
        this.value.toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/(^-|-$)/g,'');
});
</script>
@endsection
