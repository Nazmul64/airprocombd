@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Work References List</h2>

    <a href="{{ route('workreferencec.create') }}" class="btn btn-success mb-3">
        Add New Work
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($works as $key => $work)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $work->work_title }}</td>
                    <td>{{ $work->category->category_name ?? 'N/A' }}</td>
                    <td>
                        <img src="{{ asset('uploads/workreferences/'.$work->work_image) }}" width="80">
                    </td>
                    <td>
                        <a href="{{ route('workreferencec.edit', $work->id) }}" class="btn btn-info btn-sm">Edit</a>

                        <form action="{{ route('workreferencec.destroy', $work->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No works found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
