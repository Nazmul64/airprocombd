@extends('Admin.master')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h3>Mission List</h3>
        <a href="{{ route('mission.create') }}" class="btn btn-primary">Add Mission</a>
    </div>
    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Icon</th>
                <th>Title</th>
                <th>Description</th>
                <th width="160">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($missions as $key => $mission)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <i class="{{ $mission->icon }}" style="font-size:20px;"></i><br>
                        <small>{{ $mission->icon }}</small>
                    </td>
                    <td>{{ $mission->title }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($mission->description, 50) }}</td>
                    <td>
                        <a href="{{ route('mission.edit',$mission->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('mission.destroy',$mission->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')"
                                    class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No mission found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
