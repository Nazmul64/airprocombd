@extends('Admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Edit Why Choose Us Investment</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('whychooseusinvesment.update', $whychooseus->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        value="{{ old('title', $whychooseus->title) }}"
                        placeholder="Enter title"
                        >
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        class="form-control"
                        rows="4"
                        placeholder="Enter description"
                        >{{ old('description', $whychooseus->description) }}</textarea>
                </div>

                <!-- Icon -->
                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input
                        type="text"
                        name="icon"
                        id="icon"
                        class="form-control"
                        value="{{ old('icon', $whychooseus->icon) }}"
                        placeholder="Enter icon class (e.g., bi bi-graph-up)"
                        >
                </div>

                <!-- Main Title -->
                <div class="mb-3">
                    <label for="main_title" class="form-label">Main Title</label>
                    <input
                        type="text"
                        name="main_title"
                        id="main_title"
                        class="form-control"
                        value="{{ old('main_title', $whychooseus->main_title) }}"
                        placeholder="Enter main title"
                        >
                </div>

                <!-- Main Description -->
                <div class="mb-3">
                    <label for="main_description" class="form-label">Main Description</label>
                    <textarea
                        name="main_description"
                        id="main_description"
                        class="form-control"
                        rows="4"
                        placeholder="Enter main description"
                        >{{ old('main_description', $whychooseus->main_description) }}</textarea>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" >
                        <option value="1" {{ $whychooseus->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $whychooseus->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
