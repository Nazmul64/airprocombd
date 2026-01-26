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



<!-- Slider JS -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    let currentSlide = 0;
    const slides = document.querySelectorAll('#heroSlider .slide');
    const dots = document.querySelectorAll('#heroSlider .slider-dot');

    function showSlide(index) {
        slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
        dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
        currentSlide = index;
    }

    // Click on dots
    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            const index = parseInt(dot.dataset.index);
            showSlide(index);
        });
    });

    // Auto slide every 5 seconds
    setInterval(() => {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }, 5000);

    // Initialize first slide
    showSlide(0);
});
</script>




    <!-- Stats Section -->
    <div style="background: linear-gradient(135deg, #0056b3, #003d82); color: white; padding: 60px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    <div style="font-size: 56px; font-weight: 800; color: #ff6b35;">700+</div>
                    <div style="font-size: 20px; font-weight: 600; letter-spacing: 1px;">PROJECTS COMPLETED</div>
                </div>
                <div class="col-md-8">
                    <p style="font-size: 18px; line-height: 1.8; margin-bottom: 20px;">
                        Hotels, Hospitals, Restaurants, Garments & Textiles factories, Offices, Commercial & Residential Buildings, Pharmaceutical Production Facilities, Poultry & Hatcheries, Showrooms, Banks, Shopping Malls
                    </p>
                    <a href="#" style="background: white; color: #0056b3; padding: 12px 35px; border-radius: 5px; font-weight: 700; text-decoration: none; display: inline-block;">GET A QUOTE</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
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

<style>
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        border-color: #ff6b35;
    }

    .image-container:hover .product-image {
        transform: scale(1.1);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .product-card:nth-child(1) { animation-delay: 0.1s; }
    .product-card:nth-child(2) { animation-delay: 0.2s; }
    .product-card:nth-child(3) { animation-delay: 0.3s; }
    .product-card:nth-child(4) { animation-delay: 0.4s; }
    .product-card:nth-child(5) { animation-delay: 0.5s; }
    .product-card:nth-child(6) { animation-delay: 0.6s; }
</style>

<script>
    let currentSlideIndex = 0;
    const products = @json($products);

    function openSlider(index) {
        currentSlideIndex = index;
        showSlide();
        document.getElementById('imageSliderModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeSlider() {
        document.getElementById('imageSliderModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function changeSlideModal(direction) {
        currentSlideIndex += direction;
        if (currentSlideIndex >= products.length) currentSlideIndex = 0;
        if (currentSlideIndex < 0) currentSlideIndex = products.length - 1;
        showSlide();
    }

    function showSlide() {
        const product = products[currentSlideIndex];
        const imagePath = product.product_image ?
            "{{ asset('uploads/products/') }}/" + product.product_image :
            '';

        document.getElementById('sliderImage').src = imagePath;
        document.getElementById('sliderTitle').textContent = product.product_name || '';
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (document.getElementById('imageSliderModal').style.display === 'flex') {
            if (e.key === 'ArrowLeft') changeSlideModal(-1);
            if (e.key === 'ArrowRight') changeSlideModal(1);
            if (e.key === 'Escape') closeSlider();
        }
    });

    // Close on click outside
    document.getElementById('imageSliderModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeSlider();
    });
</script>
        <!-- About Section -->
    <div style="background: #f8f9fa; padding: 80px 0;">
        <div class="container">
            <!-- About Us Header -->
            <div style="margin-bottom: 50px;">
                <div style="width: 80px; height: 3px; background: #5DADE2; margin-bottom: 15px;"></div>
                <h2 style="font-size: 48px; font-weight: 800; color: #ff6b35; margin-bottom: 20px;">About us</h2>
                <div style="width: 100px; height: 4px; background: #ff6b35;"></div>
            </div>

            <!-- About Text Content -->
            <div style="margin-bottom: 60px;">
                <p style="font-size: 16px; line-height: 1.9; color: #333; text-align: justify; margin-bottom: 25px;">
                    Purchasing a reliable brand of air conditioning for optimum performance and energy efficiency is a thing of the past. Meticulous considerations during design, installation and routine maintenance are pivotal factors in establishing an air conditioning system that protects the earth and economy of the owner. AirPro Limited, being the professional engineer in air conditioning business has this professional commitment to ensure energy efficiency along with commercial efficiency for the client. The management team of AirPro Limited is in the trade of building services for decades, stepping into the air conditioning business with the aim to fill in the void of professional engineers providing air conditioning system services in local market.
                </p>
                <p style="font-size: 16px; line-height: 1.9; color: #333; text-align: justify;">
                    The Management Team of AirPro Limited with their previous design background has extensive experience in project management of different air conditioning system. AirPro Limited is specialized in central system with air and water-cooled chillers, magnetic bearing chillers, absorption chillers, VRF system and split air conditioning system.
                </p>
            </div>

            <!-- Mission, Vision, Values Section -->
            <div class="row" style="margin-top: 60px;">
                <!-- Mission -->
                <div class="col-md-4 mb-4">
                    <div style="position: relative; text-align: center;">
                        <!-- Hexagon Shape -->
                        <div style="width: 280px; height: 280px; margin: 0 auto; position: relative; clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); background: linear-gradient(135deg, #5DADE2, #3498DB); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px; box-shadow: 0 10px 30px rgba(93, 173, 226, 0.3);">
                            <!-- Icon -->
                            <div style="background: white; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                <i class="fas fa-bullseye" style="font-size: 40px; color: #e74c3c;"></i>
                            </div>
                            <!-- Title -->
                            <h3 style="color: white; font-size: 24px; font-weight: 800; margin-bottom: 15px; letter-spacing: 1px;">MISSION:</h3>
                            <!-- Description -->
                            <p style="color: white; font-size: 14px; line-height: 1.6;">To fill in the void of professional engineers providing air conditioning system services</p>
                        </div>
                        <!-- Shadow Effect -->
                        <div style="width: 250px; height: 20px; margin: -10px auto 0; background: radial-gradient(ellipse, rgba(0,0,0,0.15), transparent); border-radius: 50%;"></div>
                    </div>
                </div>

                <!-- Vision -->
                <div class="col-md-4 mb-4">
                    <div style="position: relative; text-align: center;">
                        <!-- Hexagon Shape -->
                        <div style="width: 280px; height: 280px; margin: 0 auto; position: relative; clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); background: linear-gradient(135deg, #FF6B35, #E55A24); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px; box-shadow: 0 10px 30px rgba(255, 107, 53, 0.3);">
                            <!-- Icon -->
                            <div style="background: white; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                <i class="fas fa-eye" style="font-size: 40px; color: #2c3e50;"></i>
                            </div>
                            <!-- Title -->
                            <h3 style="color: white; font-size: 24px; font-weight: 800; margin-bottom: 15px; letter-spacing: 1px;">VISION:</h3>
                            <!-- Description -->
                            <p style="color: white; font-size: 14px; line-height: 1.6;">Provide carbon neutral solutions in the HVAC market at an optimum cost.</p>
                        </div>
                        <!-- Shadow Effect -->
                        <div style="width: 250px; height: 20px; margin: -10px auto 0; background: radial-gradient(ellipse, rgba(0,0,0,0.15), transparent); border-radius: 50%;"></div>
                    </div>
                </div>

                <!-- Values -->
                <div class="col-md-4 mb-4">
                    <div style="position: relative; text-align: center;">
                        <!-- Hexagon Shape -->
                        <div style="width: 280px; height: 280px; margin: 0 auto; position: relative; clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); background: linear-gradient(135deg, #5DADE2, #3498DB); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px; box-shadow: 0 10px 30px rgba(93, 173, 226, 0.3);">
                            <!-- Icon -->
                            <div style="background: white; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                <i class="fas fa-balance-scale" style="font-size: 40px; color: #f39c12;"></i>
                            </div>
                            <!-- Title -->
                            <h3 style="color: white; font-size: 24px; font-weight: 800; margin-bottom: 15px; letter-spacing: 1px;">VALUES</h3>
                            <!-- Description -->
                            <p style="color: white; font-size: 14px; line-height: 1.6;">Establish committed and trusted relationship with the customer.</p>
                        </div>
                        <!-- Shadow Effect -->
                        <div style="width: 250px; height: 20px; margin: -10px auto 0; background: radial-gradient(ellipse, rgba(0,0,0,0.15), transparent); border-radius: 50%;"></div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div style="text-align: center; margin-top: 50px;">
                <h3 style="font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 15px;">Because HVAC is our passion</h3>
                <p style="font-size: 18px; color: #666; margin-bottom: 30px;">With our broad partnership network covering a wide range of global leading HVAC brands</p>
                <a href="#" style="background: #0056b3; color: white; padding: 14px 40px; border-radius: 8px; font-weight: 700; text-decoration: none; display: inline-block; font-size: 16px; transition: all 0.3s;">Our Story</a>
            </div>
        </div>
    </div>

    <!-- Our Services Section -->
    <div style="background: white; padding: 80px 0;">
        <div class="container">
            <div style="margin-bottom: 60px;">
                <h2 style="font-size: 48px; font-weight: 800; color: #ff6b35; margin-bottom: 15px;">Our Services:</h2>
                <div style="width: 150px; height: 4px; background: #ff6b35;"></div>
            </div>

            <div class="row align-items-center" style="position: relative;">
                <!-- Left Side - VRF System -->
                <div class="col-md-4">
                    <div style="margin-bottom: 50px;">
                        <h3 style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin-bottom: 25px; border-left: 4px solid #ff6b35; padding-left: 15px;">VRF SYSTEM</h3>
                        <ul style="list-style: none; padding: 0;">
                            <li style="margin-bottom: 15px; display: flex; align-items: center;">
                                <span style="width: 12px; height: 12px; background: #ff6b35; border-radius: 50%; margin-right: 15px; display: inline-block;"></span>
                                <span style="font-size: 16px; color: #333;">Mini VRF</span>
                            </li>
                            <li style="margin-bottom: 15px; display: flex; align-items: center;">
                                <span style="width: 12px; height: 12px; background: #ff6b35; border-radius: 50%; margin-right: 15px; display: inline-block;"></span>
                                <span style="font-size: 16px; color: #333;">Cooling Only</span>
                            </li>
                            <li style="margin-bottom: 15px; display: flex; align-items: center;">
                                <span style="width: 12px; height: 12px; background: #ff6b35; border-radius: 50%; margin-right: 15px; display: inline-block;"></span>
                                <span style="font-size: 16px; color: #333;">Heating & Cooling</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Center - Connection Design -->
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

                <!-- Right Side - Ventilation System -->
                <div class="col-md-4">
                    <div style="margin-bottom: 50px;">
                        <h3 style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin-bottom: 25px; border-left: 4px solid #ff6b35; padding-left: 15px;">VENTILATION SYSTEM</h3>
                        <ul style="list-style: none; padding: 0;">
                            <li style="margin-bottom: 15px; display: flex; align-items: center;">
                                <span style="width: 12px; height: 12px; background: #ff6b35; border-radius: 50%; margin-right: 15px; display: inline-block;"></span>
                                <span style="font-size: 16px; color: #333;">Industrial Ventilation</span>
                            </li>
                            <li style="margin-bottom: 15px; display: flex; align-items: center;">
                                <span style="width: 12px; height: 12px; background: #ff6b35; border-radius: 50%; margin-right: 15px; display: inline-block;"></span>
                                <span style="font-size: 16px; color: #333;">Force Ventilation</span>
                            </li>
                            <li style="margin-bottom: 15px; display: flex; align-items: center;">
                                <span style="width: 12px; height: 12px; background: #ff6b35; border-radius: 50%; margin-right: 15px; display: inline-block;"></span>
                                <span style="font-size: 16px; color: #333;">Tunnel Ventilation</span>
                            </li>
                            <li style="margin-bottom: 15px; display: flex; align-items: center;">
                                <span style="width: 12px; height: 12px; background: #ff6b35; border-radius: 50%; margin-right: 15px; display: inline-block;"></span>
                                <span style="font-size: 16px; color: #333;">Plant Room Ventilation</span>
                            </li>
                        </ul>
                    </div>
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    let currentSlide = 0;
    const slider = document.getElementById('partnersSlider');
    const boxes = slider.querySelectorAll('.partner-box');
    const container = document.getElementById('sliderContainer');

    function slidePartners(direction) {
        if(boxes.length === 0) return; // no images

        const containerWidth = container.offsetWidth;
        const slideWidth = boxes[0].offsetWidth + 20; // include margin
        const visibleSlides = Math.floor(containerWidth / slideWidth);
        const totalSlides = boxes.length;

        if (direction === 'next') {
            currentSlide = (currentSlide < totalSlides - visibleSlides) ? currentSlide + 1 : 0;
        } else if (direction === 'prev') {
            currentSlide = (currentSlide > 0) ? currentSlide - 1 : totalSlides - visibleSlides;
        } else if (direction === 'auto') {
            currentSlide = (currentSlide < totalSlides - visibleSlides) ? currentSlide + 1 : 0;
        }

        slider.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
    }

    // Auto-slide every 3 seconds
    setInterval(() => slidePartners('auto'), 3000);

    // Adjust on window resize
    window.addEventListener('resize', () => slidePartners('none'));
});
</script>





@include('Frontend.pages.footer')
