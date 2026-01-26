@extends('Admin.master')

@section('content')
<div class="container py-5">
    <h4 class="mb-4">Admin Profile</h4>
    <form action="{{ route('admin.profile.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Profile Image</label>
            <input type="file" name="image" class="form-control">
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            @if(auth()->user()->image)
                <img src="{{ asset('uploads/admin/' . auth()->user()->image) }}" alt="Profile" width="80" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
