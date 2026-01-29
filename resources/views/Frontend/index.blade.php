@include('Frontend.pages.header')
<!-- Hero Slider -->
<div id="heroSlider" class="hero-slider">
    @foreach ($sliders as $index => $slider)
        <div class="slide {{ $index === 0 ? 'active' : '' }}">
            {{-- Check if photo exists, else show default --}}
            @php
                $photoPath = $slider->photo && file_exists(public_path($slider->photo))
                            ? asset($slider->photo)
                            : asset('uploads/slider/default.png');
            @endphp
            <img src="{{ $photoPath }}" alt="{{ $slider->title ?? 'Slider Image' }}">

            {{-- Overlay --}}
            <div class="overlay"></div>

            {{-- Slider Content --}}
            <div class="content">
                <h1>{{ $slider->title ?? '' }}</h1>
                <p>{{ $slider->description ?? '' }}</p>
            </div>
        </div>
    @endforeach

    <!-- Slider Dots -->
    <div class="slider-dots">
        @foreach ($sliders as $index => $slider)
            <span class="slider-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
        @endforeach
    </div>
</div>


<!-- Stats Section with Background -->
@foreach ($solutionprovider as $solutionproviders)
<section class="stats-section" style="background-image: url('{{ asset('uploads/solutionprovider/'.$solutionproviders->photo) }}');">
    <div class="stats-overlay"></div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-9">
                <p class="stats-description">
                    {!! nl2br(e($solutionproviders->title ?? '')) !!}
                </p>
            </div>
            <div class="col-md-3 text-end">
                <a href="{{route('contacts')}}" class="stats-cta-button">GET A QUOTE</a>
            </div>
        </div>
    </div>
</section>
@endforeach
<!-- Products Section -->
<div class="container" style="padding: 80px 0;">
    <div style="text-align: center; margin-bottom: 60px;">
        <div style="color: #ff6b35; font-style: italic; font-size: 18px;">What we do</div>
        <div style="font-size: 42px; font-weight: 800; color: #1a1a1a; text-transform: uppercase; letter-spacing: 2px; margin-top: 10px;">OUR PRODUCTS</div>
    </div>
    <div class="row">
        @foreach ($products as $index => $product)
            <div class="col-md-4 mb-4">
                <div style="background: white; border-radius: 15px; padding: 40px 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.4s; border: 2px solid transparent; height: 100%;" class="product-card">
                    <div style="position: relative; height: 200px; margin-bottom: 20px; overflow: hidden; border-radius: 10px; cursor: pointer;" class="image-container" onclick="openSlider({{ $index }})">
                        @if(!empty($product->product_image))
                            <img src="{{ asset('uploads/products/'.$product->product_image) }}"
                                alt="{{ $product->product_name ?? 'Product Image' }}"
                                class="product-image"
                                style="width: 100%; height: 100%; object-fit: contain; transition: transform 0.5s ease;">
                        @else
                            <span style="color:#999; display: flex; align-items: center; justify-content: center; height: 100%;">No Image</span>
                        @endif
                    </div>
                    <h3 style="color: #0056b3; font-size: 22px; font-weight: 700; margin-bottom: 20px; text-align: center;">{{ $product->product_name ?? ''}}</h3>
                    <p style="color: #666; line-height: 1.8; text-align: center; margin-bottom: 25px;">{{ Str::limit($product->product_description ?? '', 100) }}</p>
                    <div style="text-align: center;">
                        {{-- Changed this line - added $product->product_slug parameter --}}
                        <a href="{{ route('productdetails', $product->product_slug) }}" style="background: #ff6b35; color: white; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block;">Click Here to Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
{{-- HVAC Passion Section with Background --}}
@foreach ( $passion as  $passions)

<section class="hvac-passion-section" style="background-image: url('{{ asset('uploads/passion/'.$passions->photo) }}');">
    <div class="background-overlay"></div>

    <div class="container">
        <div class="content-wrapper">
            <h2 class="main-title">
                <span class="highlight-text">{{ $passions->title ?? ''}}</span>
            </h2>

            <p class="description-text">
                {!! nl2br(e($passions->description ?? '')) !!}
            </p>

            <a href="{{ asset('uploads/passion/'.$passions->pdf) }}" target="_blank" class="cta-button">OUR STORY</a>
        </div>
    </div>
</section>
@endforeach

<!-- Image Slider Modal -->
<div id="imageSliderModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.95); z-index: 9999; align-items: center; justify-content: center;">
    <button onclick="closeSlider()" style="position: absolute; top: 20px; right: 30px; background: transparent; border: none; color: white; font-size: 40px; cursor: pointer; z-index: 10000;">&times;</button>

    <button onclick="changeSlideModal(-1)" style="position: absolute; left: 30px; background: rgba(255,255,255,0.3); border: none; color: white; font-size: 30px; padding: 10px 20px; cursor: pointer; border-radius: 5px; transition: 0.3s;">&lt;</button>

    <div style="max-width: 90%; max-height: 90%; text-align: center;">
        <img id="sliderImage" src="" alt="Product" style="max-width: 100%; max-height: 80vh; object-fit: contain; border-radius: 10px;">
        <h3 id="sliderTitle" style="color: white; margin-top: 20px; font-size: 24px;"></h3>
    </div>

    <button onclick="changeSlideModal(1)" style="position: absolute; right: 30px; background: rgba(255,255,255,0.3); border: none; color: white; font-size: 30px; padding: 10px 20px; cursor: pointer; border-radius: 5px; transition: 0.3s;">&gt;</button>
</div>

<!-- About Section -->
<div style="background: #f8f9fa; padding: 80px 0;">
    <div class="container">

        {{-- About Content --}}
        @foreach ($about as $abouts)
            <!-- About Header -->
            <div style="margin-bottom: 50px;">
                <div style="width: 80px; height: 3px; background: #5DADE2; margin-bottom: 15px;"></div>

                <h2 style="font-size: 48px; font-weight: 800; color: #ff6b35; margin-bottom: 20px;">
                    {{ $abouts->title ?? '' }}
                </h2>

                <div style="width: 100px; height: 4px; background: #ff6b35;"></div>
            </div>

            <!-- About Description -->
            <div style="margin-bottom: 60px;">
                <p style="font-size: 16px; line-height: 1.9; color: #333; text-align: justify;">
                    {!! nl2br(e($abouts->description ?? '')) !!}
                </p>
            </div>
        @endforeach

        {{-- Mission Section --}}
        <div class="row" style="margin-top: 60px;">

            @foreach ($mission as $missions)
                <div class="col-md-4 mb-5">
                    <div style="position: relative; text-align: center;">

                        <!-- Hexagon Card -->
                        <div style="
                            width: 280px;
                            height: 280px;
                            margin: 0 auto;
                            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
                            background: linear-gradient(135deg, #5DADE2, #3498DB);
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            padding: 35px;
                            box-shadow: 0 10px 30px rgba(93, 173, 226, 0.3);
                        ">

                            <!-- Icon -->
                            <div style="
                                background: #fff;
                                width: 80px;
                                height: 80px;
                                border-radius: 50%;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                margin-bottom: 15px;
                            ">
                                <i class="{{ $missions->icon ?? '' }}" style="font-size: 38px; color: #e74c3c;"></i>
                            </div>

                            <!-- Title -->
                            <h3 style="color: #fff; font-size: 22px; font-weight: 800; margin-bottom: 10px;">
                                {{ $missions->title ?? '' }}
                            </h3>

                            <!-- Description -->
                            <p style="color: #fff; font-size: 14px; line-height: 1.6;">
                                {{ $missions->description ?? '' }}
                            </p>
                        </div>

                        <!-- Shadow -->
                        <div style="
                            width: 240px;
                            height: 18px;
                            margin: -10px auto 0;
                            background: radial-gradient(ellipse, rgba(0,0,0,0.15), transparent);
                            border-radius: 50%;
                        "></div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>


<!-- Our Services Section -->
<div style="background: white; padding: 80px 0;">
    <div class="container">
        <div style="margin-bottom: 60px; text-align: center;">
            <h2 style="font-size: 48px; font-weight: 800; color: #ff6b35; margin-bottom: 15px;">Our Services:</h2>
            <div style="width: 150px; height: 4px; background: #ff6b35; margin: auto;"></div>
        </div>

        <div class="row align-items-center" style="position: relative;">
            <!-- Left Side -->
            <div class="col-md-4">
                @foreach($leftProviders as $provider)
                    <div style="margin-bottom: 50px;">
                        <h3 style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin-bottom: 25px; border-left: 4px solid #ff6b35; padding-left: 15px;">
                            {{ $provider->title }}
                        </h3>
                        @if($provider->items->count() > 0)
                            <ul style="list-style: none; padding: 0;">
                                @foreach($provider->items as $item)
                                    <li style="margin-bottom: 15px; display: flex; align-items: center;">
                                        <span style="width: 12px; height: 12px; background: #ff6b35; border-radius: 50%; margin-right: 15px; display: inline-block; flex-shrink: 0;"></span>
                                        <span style="font-size: 16px; color: #333;">{{ $item->item_name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Center SVG -->
            <div class="col-md-4 text-center" style="position: relative;">
                <svg width="100%" height="150" viewBox="0 0 400 150" style="margin: 30px 0;">
                    <!-- Left Pipe -->
                    <path d="M 0 75 Q 100 75, 150 75" stroke="#5DADE2" stroke-width="25" fill="none" stroke-linecap="round"/>
                    <!-- Right Pipe -->
                    <path d="M 250 75 Q 300 75, 400 75" stroke="#5DADE2" stroke-width="25" fill="none" stroke-linecap="round"/>
                    <!-- Center Circle -->
                    <circle cx="200" cy="75" r="45" fill="#5DADE2" opacity="0.3"/>
                    <circle cx="200" cy="75" r="30" fill="#ff6b35"/>
                    <circle cx="200" cy="75" r="18" fill="white"/>
                </svg>
            </div>

            <!-- Right Side -->
            <div class="col-md-4">
                @foreach($rightProviders as $provider)
                    <div style="margin-bottom: 50px;">
                        <h3 style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin-bottom: 25px; border-left: 4px solid #ff6b35; padding-left: 15px;">
                            {{ $provider->title }}
                        </h3>
                        @if($provider->items->count() > 0)
                            <ul style="list-style: none; padding: 0;">
                                @foreach($provider->items as $item)
                                    <li style="margin-bottom: 15px; display: flex; align-items: center;">
                                        <span style="width: 12px; height: 12px; background: #ff6b35; border-radius: 50%; margin-right: 15px; display: inline-block; flex-shrink: 0;"></span>
                                        <span style="font-size: 16px; color: #333;">{{ $item->item_name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Our Partner Section -->
<div class="partner-section" style="background: #fff; padding: 80px 0;">
    <div class="container">
        <!-- Section Header -->
        <div style="margin-bottom: 40px; text-align: center;">
            <h2 style="font-size: 28px; font-weight: 600; color: #888; margin-bottom: 10px;">Our Partners</h2>
            <div style="width: 60px; height: 3px; background: #ff6b35; margin: 0 auto;"></div>
        </div>

        <div style="position: relative;">
            <!-- Left Arrow -->
            <button onclick="slidePartners('prev')"
                    style="position: absolute; left: -50px; top: 50%; transform: translateY(-50%);
                           background: #fff; border: 2px solid #e0e0e0; width: 40px; height: 40px;
                           border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10;">
                <i class="fas fa-chevron-left" style="color: #666;"></i>
            </button>

            <!-- Slider Container -->
            <div id="sliderContainer" style="overflow: hidden; width: 100%;">
                <div id="partnersSlider" style="display: flex; transition: transform 0.5s ease;">

                    @forelse ($partners as $partner)
                        <div class="partner-box"
                             style="flex: 0 0 20%; margin: 0 10px; background: #f8f9fa;
                                    padding: 15px; border-radius: 10px; display: flex; align-items: center; justify-content: center; height: 120px;">
                            @if($partner->photo && file_exists(public_path($partner->photo)))
                                <img src="{{ asset($partner->photo) }}"
                                     alt="Partner {{ $loop->iteration }}"
                                     style="max-width: 100%; max-height: 100%; object-fit: contain; display: block;">
                            @else
                                <span style="color: #999;">No Image</span>
                            @endif
                        </div>
                    @empty
                        <p>No partners added yet.</p>
                    @endforelse

                </div>
            </div>

            <!-- Right Arrow -->
            <button onclick="slidePartners('next')"
                    style="position: absolute; right: -50px; top: 50%; transform: translateY(-50%);
                           background: #fff; border: 2px solid #e0e0e0; width: 40px; height: 40px;
                           border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10;">
                <i class="fas fa-chevron-right" style="color: #666;"></i>
            </button>
        </div>
    </div>
</div>

@include('Frontend.pages.footer')
