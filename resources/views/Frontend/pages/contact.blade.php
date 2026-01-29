@include('Frontend.pages.header')

<div class="contactpages-container">
    <!-- Main Contact Section -->
    <div class="contactpages-main-section">
        <div class="contactpages-grid">
            <!-- Left Side - Illustration -->
            <div class="contactpages-illustration">
                <div class="contactpages-image-wrapper">
                    <img src="{{ asset($contactinfo->main_photo ?? '') }}" alt="Contact Support">
                </div>
            </div>

            <!-- Right Side - Contact Form -->
            <div class="contactpages-form-section">
                <h2 class="contactpages-form-title">Get In Touch</h2>

                @if(session('success'))
                    <div class="contactpages-alert contactpages-alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="contactpages-alert contactpages-alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <form class="contactpages-form" action="{{ route('contactform.store') }}" method="POST">
                    @csrf

                    <div class="contactpages-form-row">
                        <div class="contactpages-form-group">
                            <input type="text"
                                   class="contactpages-input @error('first_name') is-invalid @enderror"
                                   name="first_name"
                                   value="{{ old('first_name') }}"
                                   placeholder="First Name"
                                   required>
                            @error('first_name')
                                <span class="contactpages-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="contactpages-form-group">
                            <input type="text"
                                   class="contactpages-input @error('last_name') is-invalid @enderror"
                                   name="last_name"
                                   value="{{ old('last_name') }}"
                                   placeholder="Last Name"
                                   required>
                            @error('last_name')
                                <span class="contactpages-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="contactpages-form-row">
                        <div class="contactpages-form-group">
                            <input type="email"
                                   class="contactpages-input @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Email Address"
                                   required>
                            @error('email')
                                <span class="contactpages-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="contactpages-form-group">
                            <input type="tel"
                                   class="contactpages-input @error('phone') is-invalid @enderror"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="Phone No.">
                            @error('phone')
                                <span class="contactpages-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="contactpages-form-group">
                        <textarea class="contactpages-textarea @error('message') is-invalid @enderror"
                                  name="message"
                                  placeholder="Message..."
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="contactpages-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="contactpages-submit-btn">
                        Submit Now
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Contact Information Cards -->
    <div class="contactpages-info-section">
        <!-- Call Now Card -->
        <div class="contactpages-info-card">
            <div class="contactpages-icon-wrapper">
                <img src="{{ asset($contactinfo->call_photo) }}" alt="Phone">
            </div>
            <h3 class="contactpages-info-title">{{ $contactinfo->call_now_title ?? '' }}</h3>
            <p class="contactpages-info-text">+880-{{ $contactinfo->call_now_number ?? '' }}</p>
        </div>

        <!-- Location Card -->
        <div class="contactpages-info-card">
            <div class="contactpages-icon-wrapper">
                <img src="{{ asset($contactinfo->location_photo ?? '') }}" alt="Location">
            </div>
            <h3 class="contactpages-info-title">{{ $contactinfo->location_title ?? '' }}</h3>
            <p class="contactpages-info-text">{{ $contactinfo->location_address ?? '' }}</p>
        </div>

        <!-- Email Address Card -->
        <div class="contactpages-info-card">
            <div class="contactpages-icon-wrapper">
                <img src="{{ asset($contactinfo->email_photo ?? '') }}" alt="Email">
            </div>
            <h3 class="contactpages-info-title">{{ $contactinfo->email_title ?? '' }}</h3>
            <p class="contactpages-info-text">{{ $contactinfo->email_address ?? '' }}</p>
        </div>
    </div>

    <!-- Google Map Section -->
    <div class="contactpages-map-section">
        <div class="contactpages-map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb={{ $contactinfo->google_map ?? '' }}"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>

<!-- Full Width Google Map Section (Outside Container) -->
<div class="contactpages-map-section-fullwidth">
    <div class="contactpages-map-container-fullwidth">
        <iframe
            src="https://www.google.com/maps/embed?pb={{ $contactinfo->google_map ?? '' }}"
            width="100%"
            height="500"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

@include('Frontend.pages.footer')
