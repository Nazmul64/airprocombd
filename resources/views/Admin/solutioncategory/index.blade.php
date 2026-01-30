@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Category List</h3>
    <a href="{{ route('solutioncategory.create') }}" class="btn btn-primary mb-2">Add New</a>

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Action</th>
        </tr>

        @foreach($categories as $key => $category)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $category->category_name }}</td>
            <td>{{ $category->category_slug }}</td>
            <td>
                <a href="{{ route('solutioncategory.edit',$category->id) }}" class="btn btn-sm btn-info">Edit</a>

                <form action="{{ route('solutioncategory.destroy',$category->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
