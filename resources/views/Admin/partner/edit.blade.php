@extends('Admin.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm rounded-4">
                <!-- Card Header -->
                <div class="card-header bg-warning text-dark text-center">
                    <h4 class="mb-0">Edit Partner</h4>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('partner.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Current Photo Preview -->
                        <div class="mb-3 text-center">
                            @if($partner->photo)
                                <img src="{{ asset($partner->photo) }}"
                                     alt="Partner Photo"
                                     width="100"
                                     class="rounded shadow-sm mb-2">
                            @else
                                <p class="text-muted">No photo uploaded</p>
                            @endif
                        </div>

                        <!-- Partner Photo -->
                        <div class="mb-3">
                            <label for="photo" class="form-label fw-bold">Change Photo</label>
                            <input
                                type="file"
                                name="new_photo"
                                id="photo"
                                class="form-control @error('photo') is-invalid @enderror"
                            >
                            <small class="text-muted">Leave blank to keep current photo.</small>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select
                                name="status"
                                id="status"
                                class="form-select @error('status') is-invalid @enderror"
                            >
                                <option value="1" {{ $partner->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $partner->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success rounded-pill">
                                Update Partner
                            </button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
