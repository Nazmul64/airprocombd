@extends('Admin.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Contact Info</h2>

    <form action="{{ route('contactinfo.update', $contactinfo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Call Section --}}
        <input class="form-control mb-2" name="call_now_title"
               value="{{ $contactinfo->call_now_title }}" placeholder="Call Title">

        <input class="form-control mb-2" name="call_now_number"
               value="{{ $contactinfo->call_now_number }}" placeholder="Call Number">

        <input type="file" class="form-control mb-2" name="call_photo"
               onchange="previewImage(this, 'callPreview')">

        <img id="callPreview"
             src="{{ $contactinfo->call_photo ? asset($contactinfo->call_photo) : '' }}"
             width="80"
             style="{{ $contactinfo->call_photo ? '' : 'display:none;' }}">

        <hr>

        {{-- Location Section --}}
        <input class="form-control mb-2" name="location_title"
               value="{{ $contactinfo->location_title }}" placeholder="Location Title">

        <textarea class="form-control mb-2" name="location_address"
                  placeholder="Location Address">{{ $contactinfo->location_address }}</textarea>

        <input type="file" class="form-control mb-2" name="location_photo"
               onchange="previewImage(this, 'locationPreview')">

        <img id="locationPreview"
             src="{{ $contactinfo->location_photo ? asset($contactinfo->location_photo) : '' }}"
             width="80"
             style="{{ $contactinfo->location_photo ? '' : 'display:none;' }}">

        <hr>

        {{-- Email Section --}}
        <input class="form-control mb-2" name="email_title"
               value="{{ $contactinfo->email_title }}" placeholder="Email Title">

        <input class="form-control mb-2" name="email_address"
               value="{{ $contactinfo->email_address }}" placeholder="Email Address">

        <input type="file" class="form-control mb-2" name="email_photo"
               onchange="previewImage(this, 'emailPreview')">

        <img id="emailPreview"
             src="{{ $contactinfo->email_photo ? asset($contactinfo->email_photo) : '' }}"
             width="80"
             style="{{ $contactinfo->email_photo ? '' : 'display:none;' }}">

        <hr>

        {{-- Google Map --}}
        <textarea class="form-control mb-3" name="google_map"
                  placeholder="Google Map Embed Code">{{ $contactinfo->google_map }}</textarea>

        {{-- Main Photo --}}
        <input type="file" class="form-control mb-2" name="main_photo"
               onchange="previewImage(this, 'mainPreview')">

        <img id="mainPreview"
             src="{{ $contactinfo->main_photo ? asset($contactinfo->main_photo) : '' }}"
             width="120"
             style="{{ $contactinfo->main_photo ? '' : 'display:none;' }}">

        <br><br>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

{{-- Image Preview Script --}}
@push('scripts')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
