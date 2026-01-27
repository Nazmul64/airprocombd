@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Edit Solution Provider</h3>

    <form action="{{ route('solutionprovider.update',$solution->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title *</label>
            <input type="text"
                   name="title"
                   value="{{ $solution->title }}"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Photo</label><br>
            @if($solution->photo)
                <img src="{{ asset('uploads/solutionprovider/'.$solution->photo) }}"
                     width="120"
                     class="mb-2">
            @endif
            <input type="file"
                   name="photo"
                   class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('solutionprovider.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
