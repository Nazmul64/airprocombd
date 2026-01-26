@extends('Admin.master')

@section('content')
<div class="container mt-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Partners List</h3>
        <a href="{{ route('partner.create') }}" class="btn btn-primary rounded-pill">
            + Add Partner
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Card Section -->
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($partners as $key => $partner)
                            <tr>
                                <!-- Serial Number -->
                                <td>{{ $key + 1 }}</td>

                                <!-- Photo Column -->
                                <td>
                                    @if($partner->photo)
                                        <img src="{{ asset($partner->photo) }}"
                                             alt="Partner Logo"
                                             width="60"
                                             class="rounded shadow-sm">
                                    @else
                                        <span class="text-muted">No Photo</span>
                                    @endif
                                </td>

                                <!-- Status Column -->
                                <td>
                                    @if($partner->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <!-- Created Date -->
                                <td>{{ $partner->created_at->format('d M, Y') }}</td>

                                <!-- Actions -->
                                <td>
                                    <a href="{{ route('partner.edit', $partner->id) }}"
                                       class="btn btn-warning btn-sm rounded-pill">
                                        Edit
                                    </a>

                                    <form action="{{ route('partner.destroy', $partner->id) }}"
                                          method="POST"
                                          class="d-inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this partner?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm rounded-pill">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <!-- No Data -->
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No partners found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
