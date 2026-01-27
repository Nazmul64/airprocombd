@extends('Admin.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Service Providers</h3>
                    <a href="{{ route('serviceprovider.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Service
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Left Side Services -->
                        <div class="col-md-6">
                            <h4 class="mb-3">Left Side Services</h4>
                            @forelse($leftProviders as $provider)
                                <div class="card mb-3">
                                    <div class="card-header bg-info text-white">
                                        <strong>{{ $provider->title }}</strong>
                                        <div class="float-right">
                                            <a href="{{ route('serviceprovider.edit', $provider->id) }}"
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('serviceprovider.destroy', $provider->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if($provider->items->count() > 0)
                                            <ul class="list-unstyled mb-0">
                                                @foreach($provider->items as $item)
                                                    <li class="mb-2">
                                                        <i class="fas fa-check-circle text-success"></i>
                                                        {{ $item->item_name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted mb-0">No items added</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No left side services added yet.</p>
                            @endforelse
                        </div>

                        <!-- Right Side Services -->
                        <div class="col-md-6">
                            <h4 class="mb-3">Right Side Services</h4>
                            @forelse($rightProviders as $provider)
                                <div class="card mb-3">
                                    <div class="card-header bg-success text-white">
                                        <strong>{{ $provider->title }}</strong>
                                        <div class="float-right">
                                            <a href="{{ route('serviceprovider.edit', $provider->id) }}"
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('serviceprovider.destroy', $provider->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if($provider->items->count() > 0)
                                            <ul class="list-unstyled mb-0">
                                                @foreach($provider->items as $item)
                                                    <li class="mb-2">
                                                        <i class="fas fa-check-circle text-success"></i>
                                                        {{ $item->item_name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted mb-0">No items added</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No right side services added yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
