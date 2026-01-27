@extends('Admin.master')

@section('content')
<div class="container">
    <h2>Add Contact Info</h2>

    <form action="{{ route('contactinfo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Call Section -->
        <input class="form-control mb-2" name="call_now_title" placeholder="Call Title">
        <input class="form-control mb-2" name="call_now_number" placeholder="Call Number">
        <input type="file" class="form-control mb-3" name="call_photo">

        <!-- Location Section -->
        <input class="form-control mb-2" name="location_title" placeholder="Location Title">
        <textarea class="form-control mb-2" name="location_address" placeholder="Location Address"></textarea>
        <input type="file" class="form-control mb-3" name="location_photo">

        <!-- Email Section -->
        <input class="form-control mb-2" name="email_title" placeholder="Email Title">
        <input class="form-control mb-2" name="email_address" placeholder="Email Address">
        <input type="file" class="form-control mb-3" name="email_photo">

        <!-- Others -->
        <textarea class="form-control mb-2" name="google_map" placeholder="Google Map Embed Code"></textarea>
        <input type="file" class="form-control mb-3" name="main_photo">

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
