@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Presentation Videos</h2>

    <a href="{{ route('Presentationvideo.create') }}" class="btn btn-success mb-3">
        Add Video
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Video Link</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($videos as $key => $video)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <a href="{{ $video->video_link }}" target="_blank">
                            {{ $video->video_link }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('Presentationvideo.edit', $video->id) }}"
                           class="btn btn-sm btn-info">Edit</a>

                        <form action="{{ route('Presentationvideo.destroy', $video->id) }}"
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
                    <td colspan="3" class="text-center">No videos found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
