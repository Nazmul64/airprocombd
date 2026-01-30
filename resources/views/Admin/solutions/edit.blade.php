@extends('Admin.master')

@section('content')
<div class="container mt-4">
    <h3>Edit Solution</h3>

    <form action="{{ route('solutions.update',$solution->id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title"
                   value="{{ $solution->title }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="soluction_category_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $solution->soluction_category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Sub Category</label>
            <select name="soluctionsub_category_id" class="form-control">
                @foreach($subcategories as $sub)
                    <option value="{{ $sub->id }}"
                        {{ $solution->soluctionsub_category_id == $sub->id ? 'selected' : '' }}>
                        {{ $sub->subcategory_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4">
           {{ $solution->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Photo</label><br>
            @if($solution->photo)
                <img src="{{ asset('uploads/solutions/'.$solution->photo) }}" width="80"><br><br>
            @endif
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-primary">Update Solution</button>
        <a href="{{ route('solutions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
