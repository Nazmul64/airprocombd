@extends('Admin.master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Why Choose Us Investment List</h4>
        <a href="{{ route('whychooseusinvesment.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Create New
        </a>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Icon Preview</th>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Main Title</th>
                            <th>Main Description</th>
                            <th>Status</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($whychooseus as $item)
                            <tr>
                                <td><i class="{{ $item->icon }} fz_30"></i></td>
                                <td>{{ $item->icon }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ Str::limit($item->description, 50) }}</td>
                                <td>{{ $item->main_title }}</td>
                                <td>{{ Str::limit($item->main_description, 50) }}</td>
                                <td>
                                    <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('whychooseusinvesment.edit', $item->id) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('whychooseusinvesment.destroy', $item->id) }}"
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-muted">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
