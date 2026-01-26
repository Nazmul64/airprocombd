@extends('Admin.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow rounded-4">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Add New Partner</h4>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('partner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Partner Photo -->
                        <div class="mb-3">
                            <label for="photo" class="form-label fw-bold">Partner Logo</label>
                            <input
                                type="file"
                                class="form-control @error('photo') is-invalid @enderror"
                                id="photo"
                                name="photo"
                                required
                            >
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
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success rounded-pill">
                                Save Partner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
