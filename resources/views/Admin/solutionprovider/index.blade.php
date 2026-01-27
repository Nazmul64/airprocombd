@extends('Admin.master')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h3>Solution Providers</h3>
        <a href="{{ route('solutionprovider.create') }}" class="btn btn-primary">Add New</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Title</th>
                <th width="160">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($solutions as $key => $solution)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        @if($solution->photo)
                            <img src="{{ asset('uploads/solutionprovider/'.$solution->photo) }}" width="80">
                        @endif
                    </td>
                    <td>{{ $solution->title }}</td>
                    <td>
                        <a href="{{ route('solutionprovider.edit',$solution->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('solutionprovider.destroy',$solution->id) }}"
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
                    <td colspan="4">No data found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
