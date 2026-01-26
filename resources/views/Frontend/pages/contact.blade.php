@extends('Frontend.master')
@section('content')

<!-- Breadcrumb Section -->
<div class="breadcrumb-section" data-background="{{ asset('frontend/assets/images/57U8bXGi1705124911.png') }}">
    <div class="container">
        <div class="row breadcrumb-rows">
            <div class="col-lg-7">
                <div class="breadcrumb-content wow fadeInLeft">
                    <h2 class="pt-20 breadcrumb-header">Contact</h2>
                    <h5><a href="{{ route('frontend') }}" class="text-white">Home ></a> Contact</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<section class="contact-section pt-80 pb-80" style="background-color: #12063d;">
    <div class="container">
        <div class="row g-4">
            <!-- Contact Info Cards -->
            @foreach ($contacts as $item)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="contact-card text-center p-4 rounded-3" style="background-color: #3b0ca0; color:#fff;">
                    <i class="{{ $item->icon ?? 'fas fa-building' }} fa-2x mb-3"></i>
                    <h5>{{ $item->title ?? '' }}</h5>
                    <p>{{ $item->email_phone ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Google Map (একবার, প্রথম contact-এর map_code) -->
        @if($contacts->first())
        <div class="row mt-4">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.5s">
                <div class="map-responsive rounded-3 overflow-hidden" style="height:450px;">
                    <iframe
                        src="https://www.google.com/maps?q={{ $contacts->first()->map_code ?? '' }}&output=embed"
                        style="border:0; width:100%; height:100%;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<style>
.contact-card i {
    color: #fff;
}

.map-responsive {
    position: relative;
    width: 100%;
    height: 100%;
}

.map-responsive iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    bottom: 20px;
}
</style>

@endsection
