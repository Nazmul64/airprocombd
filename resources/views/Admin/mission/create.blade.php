@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Add Mission</h3>

    <form action="{{ route('mission.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Icon (FontAwesome)</label>
            <input type="text"
                   name="icon"
                   class="form-control"
                   placeholder="fa-solid fa-star">
        </div>

        <div class="mb-3">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text"
                   name="title"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description"
                      rows="4"
                      class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('mission.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
