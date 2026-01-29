@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Blogs List</h2>
    <a href="{{ route('blog.create') }}" class="btn btn-success mb-3">Add Blog</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Category</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $key => $blog)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $blog->blog_title }}</td>
                <td>{{ $blog->blog_slug }}</td>
                <td>{{ $blog->category?->blog_category_name ?? 'N/A' }}</td>
                <td>
                    @if($blog->blog_image)
                        <img src="{{ asset('uploads/blog/'.$blog->blog_image) }}" width="60">
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No blogs found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
