@include('Frontend.pages.header')

@php
    // Only get multiple images, ignore main product_image
    $multiImages = json_decode($product->multi_image, true) ?? [];
    $allImages = [];

    // Add only multiple images to slider
    if(is_array($multiImages) && count($multiImages) > 0) {
        foreach($multiImages as $img) {
            if(!empty($img)) {
                $allImages[] = asset('uploads/products/multi/'.$img);
            }
        }
    }

    // If no multiple images, add placeholder
    if(empty($allImages)) {
        $allImages[] = 'https://via.placeholder.com/800x600?text=No+Multiple+Images';
    }
@endphp

<div class="productdetails-container">
    <div class="productdetails-top">
        <div class="productdetails-image-gallery">
            <!-- Image Slider -->
            <div class="productdetails-main-image-container">
                <button class="productdetails-slider-arrow productdetails-prev" onclick="changeSlide(-1)">‹</button>
                <div class="productdetails-slider-track" id="sliderTrack">
                    @foreach($allImages as $index => $image)
                        <div class="productdetails-slide-item">
                            <img src="{{ $image }}" alt="{{ $product->product_name }} - Image {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
                <button class="productdetails-slider-arrow productdetails-next" onclick="changeSlide(1)">›</button>
            </div>

            <!-- Thumbnails -->
            <div class="productdetails-thumbnails">
                @foreach($allImages as $index => $image)
                    <div class="productdetails-thumbnail {{ $index === 0 ? 'productdetails-active' : '' }}" onclick="goToSlide({{ $index }})">
                        <img src="{{ $image }}" alt="Thumbnail {{ $index + 1 }}" loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Product Info -->
        <div class="productdetails-info">
            <div class="productdetails-brand-logo">{{ substr($product->brand ?? 'P', 0, 1) }}</div>
            <h1 class="productdetails-title">{{ strtoupper($product->product_name ?? 'Product Name') }}</h1>

            <div class="productdetails-meta">
                @if($product->brand)
                    <div class="productdetails-meta-item">
                        <span class="productdetails-meta-label">Brand: {{ $product->brand }}</span>
                    </div>
                @endif
                @if($product->origin)
                    <div class="productdetails-meta-item">
                        <span class="productdetails-meta-label">Origin: {{ $product->origin }}</span>
                    </div>
                @endif
                @if($product->country)
                    <div class="productdetails-meta-item">
                        <span class="productdetails-meta-label">Country of Origin: {{ $product->country }}</span>
                    </div>
                @endif
            </div>

            @if($product->category)
                <div class="productdetails-category">
                    <strong>Category:</strong> {{ $product->category->category_name ?? 'N/A' }}
                </div>
            @endif

            @if($product->product_description)
                <div class="productdetails-description">
                    {{ $product->product_description }}
                </div>
            @endif
        </div>
    </div>

    <!-- Tabs -->
    <div class="productdetails-tabs">
        <button class="productdetails-tab-button productdetails-active">DESCRIPTION</button>
    </div>

    <!-- Description Section -->
    <div class="productdetails-description-section">
        <h2 class="productdetails-section-title">Product description</h2>

        <div class="productdetails-description-content">
            @if($product->company_details)
                {!! nl2br(e($product->company_details)) !!}
            @else
                <p>No detailed description available for this product.</p>
            @endif

            <div class="productdetails-footer-note">
                {{ date('Y') }} • Evolution of Performance • Quality • Quantity
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="productdetails-related-products">
            <h2 class="productdetails-related-title">Related products</h2>

            <div class="productdetails-products-grid">
                @foreach($relatedProducts as $relatedProduct)
                    <a href="{{ route('productdetails', $relatedProduct->product_slug) }}" class="productdetails-product-card">
                        @if(!empty($relatedProduct->product_image))
                            <img src="{{ asset('uploads/products/'.$relatedProduct->product_image) }}" alt="{{ $relatedProduct->product_name }}" loading="lazy">
                        @else
                            <img src="https://via.placeholder.com/400x300?text=No+Image" alt="{{ $relatedProduct->product_name }}" loading="lazy">
                        @endif
                        <h3>{{ strtoupper($relatedProduct->product_name) }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- Zoom Modal -->
<div id="zoomModal" class="productdetails-modal" onclick="closeZoom()">
    <div class="productdetails-modal-content">
        <span class="productdetails-close-modal">&times;</span>
        <img id="zoomImage" src="" alt="Zoomed">
    </div>
</div>

<script>
    let currentIndex = 0;
    const sliderTrack = document.getElementById('sliderTrack');
    const thumbnails = document.querySelectorAll('.productdetails-thumbnail');
    const totalSlides = {{ count($allImages) }};
    const imageUrls = @json($allImages);

    // Update active thumbnail
    function updateThumbnails() {
        thumbnails.forEach((thumb, index) => {
            thumb.classList.remove('productdetails-active');
            if (index === currentIndex) {
                thumb.classList.add('productdetails-active');
            }
        });
    }

    // Change slide (next/prev arrows)
    function changeSlide(direction) {
        currentIndex += direction;

        // Loop slider
        if (currentIndex >= totalSlides) {
            currentIndex = 0;
        } else if (currentIndex < 0) {
            currentIndex = totalSlides - 1;
        }

        updateSlider();
    }

    // Go to specific slide (thumbnail click)
    function goToSlide(index) {
        currentIndex = index;
        updateSlider();
    }

    // Update slider position
    function updateSlider() {
        const offset = -currentIndex * 100;
        sliderTrack.style.transform = `translateX(${offset}%)`;
        updateThumbnails();
    }

    // Open zoom modal
    function openZoom() {
        document.getElementById('zoomImage').src = imageUrls[currentIndex];
        document.getElementById('zoomModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    // Close zoom modal
    function closeZoom() {
        document.getElementById('zoomModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Click on main image to zoom
    document.querySelector('.productdetails-main-image-container').addEventListener('click', function(e) {
        if (!e.target.classList.contains('productdetails-slider-arrow')) {
            openZoom();
        }
    });

    // Keyboard navigation (Arrow keys and Escape)
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') changeSlide(-1);
        if (e.key === 'ArrowRight') changeSlide(1);
        if (e.key === 'Escape') closeZoom();
    });

    // Touch/Swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    sliderTrack.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });

    sliderTrack.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        const swipeThreshold = 50;

        if (touchEndX < touchStartX - swipeThreshold) {
            changeSlide(1); // Swipe left
        }
        if (touchEndX > touchStartX + swipeThreshold) {
            changeSlide(-1); // Swipe right
        }
    });

    // Prevent image drag
    const allImgs = document.querySelectorAll('.productdetails-slide-item img, .productdetails-thumbnail img');
    allImgs.forEach(img => {
        img.addEventListener('dragstart', (e) => e.preventDefault());
    });

    // Initialize slider
    updateSlider();
</script>

@include('Frontend.pages.footer')
