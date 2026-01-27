@extends('Admin.master')

@section('content')
<div class="container">
    <h3>Add Solution Provider</h3>

    <form action="{{ route('solutionprovider.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title *</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Photo</label>
            <input type="file"
                   name="photo"
                   class="form-control">
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('solutionprovider.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
