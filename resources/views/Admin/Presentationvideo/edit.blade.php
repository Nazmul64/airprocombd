@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Edit Presentation Video</h2>

    <form action="{{ route('Presentationvideo.update', $video->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Video Link</label>
            <input type="url" name="video_link"
                   class="form-control"
                   value="{{ old('video_link', $video->video_link) }}">
            @error('video_link')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('Presentationvideo.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
