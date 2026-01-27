@extends('Admin.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Message Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('contact.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <!-- Contact Information -->
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Contact Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="200">Full Name:</th>
                                            <td>{{ $contact->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email Address:</th>
                                            <td>
                                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Phone Number:</th>
                                            <td>
                                                @if($contact->phone)
                                                    <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                                @else
                                                    <span class="text-muted">Not provided</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Date Submitted:</th>
                                            <td>{{ $contact->created_at->format('F d, Y h:i A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status:</th>
                                            <td>
                                                @if($contact->status === 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($contact->status === 'read')
                                                    <span class="badge badge-info">Read</span>
                                                @else
                                                    <span class="badge badge-success">Replied</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="card mt-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Message</h5>
                                </div>
                                <div class="card-body">
                                    <p style="white-space: pre-wrap;">{{ $contact->message }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Actions -->
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Actions</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Update Status Form -->
                                    <form action="{{ route('contact.update-status', $contact->id) }}" method="POST" class="mb-3">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label>Update Status:</label>
                                            <select name="status" class="form-control" onchange="this.form.submit()">
                                                <option value="pending" {{ $contact->status === 'pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>
                                                    Read
                                                </option>
                                                <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>
                                                    Replied
                                                </option>
                                            </select>
                                        </div>
                                    </form>

                                    <hr>

                                    <!-- Quick Actions -->
                                    <div class="btn-group-vertical w-100">
                                        <a href="mailto:{{ $contact->email }}" class="btn btn-primary btn-block mb-2">
                                            <i class="fas fa-envelope"></i> Send Email
                                        </a>

                                        @if($contact->phone)
                                            <a href="tel:{{ $contact->phone }}" class="btn btn-success btn-block mb-2">
                                                <i class="fas fa-phone"></i> Call Now
                                            </a>
                                        @endif

                                        <form action="{{ route('contact.destroy', $contact->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this contact?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block">
                                                <i class="fas fa-trash"></i> Delete Contact
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Info -->
                            <div class="card mt-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Additional Info</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-2">
                                        <strong>Submitted:</strong><br>
                                        {{ $contact->created_at->diffForHumans() }}
                                    </p>
                                    <p class="mb-0">
                                        <strong>Last Updated:</strong><br>
                                        {{ $contact->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
