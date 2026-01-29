@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Blog Category List</h3>

    <a href="{{ route('blogcategory.create') }}"
       class="btn btn-primary mb-3">Add New</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($categories as $key => $category)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $category->blog_category_name }}</td>
                <td>{{ $category->blog_category_slug }}</td>
                <td>
                    <a href="{{ route('blogcategory.edit',$category->id) }}"
                       class="btn btn-sm btn-info">Edit</a>

                    <form action="{{ route('blogcategory.destroy',$category->id) }}"
                          method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
