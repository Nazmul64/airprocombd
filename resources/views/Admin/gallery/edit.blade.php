@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Edit Gallery Image</h2>

    <form action="{{ route('gallery.update', $gallery->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Current Photo</label><br>
            <img src="{{ asset('uploads/gallery/'.$gallery->photo) }}"
                 width="120">
        </div>

        <div class="mb-3">
            <label class="form-label">New Photo</label>
            <input type="file" name="photo" class="form-control">
            @error('photo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
