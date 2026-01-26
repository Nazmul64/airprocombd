@extends('Admin.master')

@section('content')

<div class="container-fluid my-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4>Create Counter</h4>
            <a href="{{ route('counter.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">

            <form action="{{ route('counter.store') }}" method="POST">
                @csrf

                <!-- Icon -->
                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="text" name="icon" id="icon" class="form-control" placeholder='e.g. <i class="bi bi-people"></i>' value="{{ old('icon') }}">
                    @error('icon')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" value="{{ old('title') }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Value -->
                <div class="mb-3">
                    <label for="value" class="form-label">Value</label>
                    <input type="text" name="value" id="value" class="form-control" placeholder="Enter value" value="{{ old('value') }}">
                    @error('value')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Create Counter
                </button>
            </form>

        </div>
    </div>
</div>

@endsection
