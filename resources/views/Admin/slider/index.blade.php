@extends('Admin.master')

@section('content')
<div class="container-fluid my-4">

    <!-- Create Slider Button -->
    <a href="{{ route('slider.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-lg"></i> Create Slider
    </a>

    <div class="card shadow-lg border-0">
        <div class="card-body">

            {{-- Custom Search Input --}}
            <div class="mb-3 position-relative">
                <input type="text" id="customSearchBox" class="form-control" placeholder="🔍 Search Sliders...">
                <small id="typingIndicator" class="text-muted position-absolute"
                       style="right:10px; top:50%; transform:translateY(-50%); display:none;">
                    ⌨️ Typing...
                </small>
            </div>

            {{-- Sliders Table --}}
            <div class="table-responsive">
                <table id="settingsTable" class="table table-hover table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($sliders as $slider)
                            <tr>
                                {{-- Title --}}
                                <td>{{ $slider->title ?? 'N/A' }}</td>

                                {{-- Description (limited to 50 chars) --}}
                                <td>{{ Str::limit($slider->description ?? '', 50, '...') ?: 'N/A' }}</td>

                                {{-- Photo --}}
                                <td>
                                    @if(!empty($slider->photo) && File::exists(public_path($slider->photo)))
                                        <img src="{{ asset($slider->photo) }}" alt="Slider Photo"
                                             class="img-thumbnail rounded" width="80">
                                    @else
                                        <span class="text-muted">No Photo</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if($slider->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td>
                                    <a href="{{ route('slider.edit', $slider->id) }}"
                                       class="btn btn-sm btn-primary" title="Edit Slider">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('slider.destroy', $slider->id) }}"
                                          method="POST"
                                          style="display:inline-block;"
                                          onsubmit="return confirm('Are you sure you want to delete this slider?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete Slider">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">No Sliders Found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
