@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Video Sections</h2>
    <a href="{{ route('videosection.create') }}" class="btn btn-success mb-3">Add Video</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Link</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($videos as $key => $video)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $video->video_title }}</td>
                <td><a href="{{ $video->video_link }}" target="_blank">Watch Video</a></td>
                <td>{{ $video->description ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('videosection.edit', $video->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('videosection.destroy', $video->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No video sections found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
