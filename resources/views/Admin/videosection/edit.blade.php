@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Edit Video Section</h2>

    <form action="{{ route('videosection.update', $video->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="video_title" class="form-label">Video Title</label>
            <input type="text" name="video_title" class="form-control" value="{{ old('video_title', $video->video_title) }}">
            @error('video_title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="video_link" class="form-label">Video Link</label>
            <input type="url" name="video_link" class="form-control" value="{{ old('video_link', $video->video_link) }}">
            @error('video_link') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $video->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Video</button>
        <a href="{{ route('videosection.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
