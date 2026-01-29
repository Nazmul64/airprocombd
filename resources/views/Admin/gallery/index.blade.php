@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Gallery</h2>

    <a href="{{ route('gallery.create') }}" class="btn btn-success mb-3">
        Add Image
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($galleries as $key => $gallery)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                    <img src="{{ asset('uploads/gallery/'.$gallery->photo) }}"
                         width="100">
                </td>
                <td>
                    <a href="{{ route('gallery.edit', $gallery->id) }}"
                       class="btn btn-sm btn-info">Edit</a>

                    <form action="{{ route('gallery.destroy', $gallery->id) }}"
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
            @empty
            <tr>
                <td colspan="3" class="text-center">No images found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
