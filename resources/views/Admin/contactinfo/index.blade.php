@extends('Admin.master')

@section('content')
<div class="container">
    <h2>Contact Info List</h2>
    <a href="{{ route('contactinfo.create') }}" class="btn btn-primary mb-3">Add Contact Info</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Call Number</th>
                <th>Location</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contactinfos as $item)
            <tr>
                <td>{{ $item->call_now_number }}</td>
                <td>{{ $item->location_address }}</td>
                <td>{{ $item->email_address }}</td>
                <td>
                    <a href="{{ route('contactinfo.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('contactinfo.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
