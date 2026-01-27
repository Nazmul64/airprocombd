@extends('Admin.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Messages</h3>
                    <div class="card-tools">
                        <form action="{{ route('contact.bulk-delete') }}" method="POST" id="bulkDeleteForm" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" id="bulkDeleteBtn" style="display: none;">
                                <i class="fas fa-trash"></i> Delete Selected
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    <!-- Filter Tabs -->
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a class="nav-link {{ $status === 'all' ? 'active' : '' }}"
                               href="{{ route('contact.index', ['status' => 'all']) }}">
                                All ({{ \App\Models\Contacform::count() }})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status === 'pending' ? 'active' : '' }}"
                               href="{{ route('contact.index', ['status' => 'pending']) }}">
                                Pending ({{ \App\Models\Contacform::pending()->count() }})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status === 'read' ? 'active' : '' }}"
                               href="{{ route('contact.index', ['status' => 'read']) }}">
                                Read ({{ \App\Models\Contacform::read()->count() }})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status === 'replied' ? 'active' : '' }}"
                               href="{{ route('contact.index', ['status' => 'replied']) }}">
                                Replied ({{ \App\Models\Contacform::replied()->count() }})
                            </a>
                        </li>
                    </ul>

                    <!-- Contacts Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="30">
                                        <input type="checkbox" id="selectAll">
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th width="120">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                    <tr class="{{ $contact->status === 'pending' ? 'table-warning' : '' }}">
                                        <td>
                                            <input type="checkbox" name="contact_ids[]" value="{{ $contact->id }}" class="contact-checkbox">
                                        </td>
                                        <td>
                                            <strong>{{ $contact->full_name }}</strong>
                                        </td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone ?? 'N/A' }}</td>
                                        <td>{{ Str::limit($contact->message, 50) }}</td>
                                        <td>
                                            @if($contact->status === 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($contact->status === 'read')
                                                <span class="badge badge-info">Read</span>
                                            @else
                                                <span class="badge badge-success">Replied</span>
                                            @endif
                                        </td>
                                        <td>{{ $contact->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('contact.show', $contact->id) }}"
                                               class="btn btn-sm btn-info"
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('contact.destroy', $contact->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this contact?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No contacts found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $contacts->appends(['status' => $status])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.contact-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const bulkDeleteForm = document.getElementById('bulkDeleteForm');

    // Select all functionality
    selectAll.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        toggleBulkDeleteBtn();
    });

    // Individual checkbox change
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleBulkDeleteBtn);
    });

    function toggleBulkDeleteBtn() {
        const checkedCount = document.querySelectorAll('.contact-checkbox:checked').length;
        bulkDeleteBtn.style.display = checkedCount > 0 ? 'inline-block' : 'none';
        selectAll.checked = checkedCount === checkboxes.length && checkboxes.length > 0;
    }

    // Bulk delete form submission
    bulkDeleteForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');

        if (checkedBoxes.length === 0) {
            alert('Please select at least one contact to delete.');
            return;
        }

        if (!confirm(`Are you sure you want to delete ${checkedBoxes.length} contact(s)?`)) {
            return;
        }

        // Append hidden inputs to form
        checkedBoxes.forEach(checkbox => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'contact_ids[]';
            input.value = checkbox.value;
            this.appendChild(input);
        });

        this.submit();
    });
});
</script>
@endsection
