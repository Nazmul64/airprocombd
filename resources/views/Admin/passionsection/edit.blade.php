@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Edit Passion Section</h3>

    <form action="{{ route('passionsection.update',$passion->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title *</label>
            <input type="text" name="title" value="{{ $passion->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" rows="4" class="form-control">{{ $passion->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Photo</label><br>
            @if($passion->photo)
                <img src="{{ asset('uploads/passion/'.$passion->photo) }}" width="120" class="mb-2">
            @endif
            <input type="file" name="photo" class="form-control">
        </div>

        <div class="mb-3">
            <label>PDF</label><br>
            @if($passion->pdf)
                <a href="{{ asset('uploads/passion/'.$passion->pdf) }}" target="_blank">Current PDF</a>
            @endif
            <input type="file" name="pdf" class="form-control mt-2">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('passionsection.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
