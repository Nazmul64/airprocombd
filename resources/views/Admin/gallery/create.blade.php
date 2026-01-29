@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <h2>Add Gallery Image</h2>

    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control">
            @error('photo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
