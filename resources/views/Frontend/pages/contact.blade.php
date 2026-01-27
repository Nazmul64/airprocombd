@include('Frontend.pages.header')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>

.contactpages-input,
.contactpages-textarea {
    width: 100%;
    padding: 15px 20px;

    border-radius: 10px;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
    background: #ffffff;  /* Changed to white background */
}



.contactpages-input:focus,
.contactpages-textarea:focus {
    outline: none;
      /* Blue border on focus */
    background: #ffffff;
    box-shadow: 0 3px 10px rgba(0, 102, 204, 0.1);
}

    .contactpages-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .contactpages-main-section {
        background: var(--white);
        border-radius: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 40px;
    }

    .contactpages-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        min-height: 500px;
    }

    /* Left Side - Illustration */
    .contactpages-illustration {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        padding: 60px 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .contactpages-illustration::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: contactpages-pulse 15s ease-in-out infinite;
    }

    @keyframes contactpages-pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 0.5;
        }
        50% {
            transform: scale(1.2);
            opacity: 0.8;
        }
    }

    .contactpages-image-wrapper {
        position: relative;
        z-index: 1;
        max-width: 400px;
        width: 100%;
    }

    .contactpages-image-wrapper img {
        width: 100%;
        height: auto;
        filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.2));
        animation: contactpages-float 6s ease-in-out infinite;
    }

    @keyframes contactpages-float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    /* Right Side - Form */
    .contactpages-form-section {
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .contactpages-form-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
    }

    .contactpages-form-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-radius: 2px;
    }

    .contactpages-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .contactpages-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .contactpages-form-group {
        position: relative;
    }

    .contactpages-input,
    .contactpages-textarea {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid var(--border-light);
        border-radius: 10px;
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background: var(--bg-light);
    }

    .contactpages-input:focus,
    .contactpages-textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        background: var(--white);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .contactpages-input::placeholder,
    .contactpages-textarea::placeholder {
        color: #a0aec0;
    }

    .contactpages-textarea {
        resize: vertical;
        min-height: 120px;
        max-height: 200px;
    }

    .contactpages-input.is-invalid {
        border-color: var(--error-color);
    }

    .contactpages-error {
        color: var(--error-color);
        font-size: 13px;
        margin-top: 5px;
    }

    .contactpages-alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 15px;
    }

    .contactpages-alert-success {
        background: var(--success-bg);
        color: var(--success-text);
        border: 1px solid #c3e6cb;
    }

    .contactpages-alert-error {
        background: var(--error-bg);
        color: var(--error-text);
        border: 1px solid #f5c6cb;
    }

    .contactpages-submit-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: var(--white);
        border: none;
        padding: 16px 40px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        align-self: flex-start;
    }

    .contactpages-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .contactpages-submit-btn:active {
        transform: translateY(0);
    }

    .contactpages-submit-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Contact Info Cards */
    .contactpages-info-section {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-bottom: 40px;
    }

    .contactpages-info-card {
        background: var(--white);
        padding: 40px 30px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .contactpages-info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .contactpages-info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .contactpages-info-card:hover::before {
        transform: scaleX(1);
    }

    .contactpages-icon-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .contactpages-icon-wrapper img {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    .contactpages-info-title {
        font-size: 22px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 15px;
    }

    .contactpages-info-text {
        font-size: 15px;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 8px;
    }

    /* Google Map Section */
    .contactpages-map-section {
        display: none;
    }

    .contactpages-map-container {
        position: relative;
        width: 100%;
        height: 450px;
        overflow: hidden;
    }

    .contactpages-map-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
        filter: grayscale(0);
        transition: filter 0.3s ease;
    }

    .contactpages-map-container:hover iframe {
        filter: grayscale(0) brightness(1.05);
    }

    /* Full Width Google Map Section */
    .contactpages-map-section-fullwidth {
        width: 100%;
        margin: 0;
        padding: 0;
        margin-bottom: 0;
    }

    .contactpages-map-container-fullwidth {
        position: relative;
        width: 100%;
        height: 500px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .contactpages-map-container-fullwidth iframe {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    /* Responsive Design */
    @media (max-width: 968px) {
        .contactpages-grid {
            grid-template-columns: 1fr;
        }

        .contactpages-illustration {
            padding: 40px 30px;
            min-height: 300px;
        }

        .contactpages-info-section {
            grid-template-columns: 1fr;
        }

        .contactpages-map-container {
            height: 350px;
        }

        .contactpages-map-container-fullwidth {
            height: 400px;
        }
    }

    @media (max-width: 640px) {
        .contactpages-form-section {
            padding: 40px 30px;
        }

        .contactpages-form-row {
            grid-template-columns: 1fr;
        }

        .contactpages-form-title {
            font-size: 26px;
        }

        .contactpages-map-container {
            height: 300px;
        }

        .contactpages-map-container-fullwidth {
            height: 350px;
        }
    }
</style>

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
