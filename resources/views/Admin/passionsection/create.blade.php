@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Add Passion Section</h3>

    <form action="{{ route('passionsection.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title *</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" rows="4" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <div class="mb-3">
            <label>PDF File</label>
            <input type="file" name="pdf" class="form-control">
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('passionsection.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
