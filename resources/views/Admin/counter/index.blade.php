@extends('Admin.master')

@section('content')

<div class="container-fluid my-4">

    <!-- Create Counter Button -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('counter.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Create Counter
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0">
        <div class="card-body">

            <!-- Custom Search -->
            <div class="mb-3 position-relative">
                <input type="text" id="customSearchBox" class="form-control" placeholder="🔍 Search Counters...">
                <small id="typingIndicator" class="text-muted position-absolute"
                       style="right:10px; top:50%; transform:translateY(-50%); display:none;">
                    ⌨️ Typing...
                </small>
            </div>

            <!-- Data Table -->
            <div class="table-responsive">
                <table id="counterTable" class="table table-hover table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Icon Preview</th>
                            <th>Icon Code</th>
                            <th>Title</th>
                            <th>Value</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($counter as $item)
                            <tr>
                                <!-- Icon Preview -->
                                <td><i class="{{ $item->icon }} fz_30"></i></td>

                                <!-- Icon Code -->
                                <td>{{ $item->icon ?? 'N/A' }}</td>

                                <!-- Title -->
                                <td>{{ Str::limit($item->title, 50, '...') ?? 'N/A' }}</td>

                                <!-- Value -->
                                <td>{{ Str::limit($item->value, 50, '...') ?? 'N/A' }}</td>

                                <!-- Status -->
                                <td>
                                    @if ($item->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>

                                <!-- Action -->
                                <td>
                                    <a href="{{ route('counter.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('counter.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this counter?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted">No counters found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection
