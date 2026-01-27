@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Edit Mission</h3>

    <form action="{{ route('mission.update',$mission->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Icon</label>
            <input type="text"
                   name="icon"
                   value="{{ $mission->icon }}"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text"
                   name="title"
                   value="{{ $mission->title }}"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description"
                      rows="4"
                      class="form-control">{{ $mission->description }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('mission.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
