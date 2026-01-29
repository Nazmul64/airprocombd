@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Add Presentation Video</h2>

    <form action="{{ route('Presentationvideo.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Video Link</label>
            <input type="url" name="video_link"
                   class="form-control"
                   value="{{ old('video_link') }}">
            @error('video_link')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('Presentationvideo.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
