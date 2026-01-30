@extends('Admin.master')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Solutions List</h3>

    <a href="{{ route('solutions.create') }}" class="btn btn-primary mb-3">
        + Add Solution
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Photo</th>
                <th width="160">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solutions as $key => $solution)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $solution->title }}</td>
                    <td>{{ $solution->category->category_name ?? '-' }}</td>
                    <td>{{ $solution->subcategory->subcategory_name ?? '-' }}</td>
                    <td>
                        @if($solution->photo)
                            <img src="{{ asset('uploads/solutions/'.$solution->photo) }}" width="60">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('solutions.edit',$solution->id) }}"
                           class="btn btn-sm btn-info">Edit</a>

                        <form action="{{ route('solutions.destroy',$solution->id) }}"
                              method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')"
                                    class="btn btn-sm btn-danger">
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
