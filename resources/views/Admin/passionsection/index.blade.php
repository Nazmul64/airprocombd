@extends('Admin.master')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h3>Passion Section</h3>
        <a href="{{ route('passionsection.create') }}" class="btn btn-primary">Add New</a>
    </div>



    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Title</th>
                <th>PDF</th>
                <th width="160">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($passions as $key => $passion)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        @if($passion->photo)
                            <img src="{{ asset('uploads/passion/'.$passion->photo) }}" width="80">
                        @endif
                    </td>
                    <td>{{ $passion->title }}</td>
                    <td>
                        @if($passion->pdf)
                            <a href="{{ asset('uploads/passion/'.$passion->pdf) }}" target="_blank">View PDF</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('passionsection.edit',$passion->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('passionsection.destroy',$passion->id) }}"
                              method="POST" class="d-inline">
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
                    <td colspan="5">No data found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
