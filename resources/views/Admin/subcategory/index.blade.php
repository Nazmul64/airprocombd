@extends('Admin.master')

@section('content')
<div class="container">
    <h3>SubCategory List</h3>
    <a href="{{ route('subcategories.create') }}" class="btn btn-primary mb-2">Add New</a>

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>SubCategory</th>
            <th>Slug</th>
            <th>Action</th>
        </tr>

        @foreach($subcategories as $key => $sub)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $sub->category->category_name ?? 'N/A' }}</td>
            <td>{{ $sub->subcategory_name }}</td>
            <td>{{ $sub->subcategory_slug }}</td>
            <td>
                <a href="{{ route('subcategories.edit',$sub->id) }}" class="btn btn-sm btn-info">Edit</a>

                <form action="{{ route('subcategories.destroy',$sub->id) }}" method="POST" style="display:inline">
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
