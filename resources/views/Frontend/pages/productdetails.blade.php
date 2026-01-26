@include('Frontend.pages.header')

<div class="productdetails-container">
    <div class="productdetails-top">
        <div class="productdetails-image-gallery">
            <div class="productdetails-main-image-container">
                <button class="productdetails-slider-arrow productdetails-prev" onclick="changeSlide(-1)">‹</button>
                <div class="productdetails-slider-track" id="sliderTrack">
                    @php
                        $multiImages = json_decode($product->multi_image, true) ?? [];
                        $allImages = [];

                        // Add main product image first
                        if(!empty($product->product_image)) {
                            $allImages[] = asset('uploads/products/'.$product->product_image);
                        }

                        // Add multiple images
                        foreach($multiImages as $img) {
                            $allImages[] = asset('uploads/products/'.$img);
                        }

                        // If no images, add placeholder
                        if(empty($allImages)) {
                            $allImages[] = 'https://via.placeholder.com/800x600?text=No+Image';
                        }
                    @endphp

                    @foreach($allImages as $image)
                        <div class="productdetails-slide-item">
                            <img src="{{ $image }}" alt="{{ $product->product_name }}">
                        </div>
                    @endforeach
                </div>
                <button class="productdetails-slider-arrow productdetails-next" onclick="changeSlide(1)">›</button>
            </div>

            <div class="productdetails-thumbnails">
                @foreach($allImages as $index => $image)
                    <div class="productdetails-thumbnail {{ $index === 0 ? 'productdetails-active' : '' }}" onclick="goToSlide({{ $index }})">
                        <img src="{{ $image }}" alt="Thumbnail {{ $index + 1 }}">
                    </div>
                @endforeach
            </div>
        </div>

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

    <div class="productdetails-tabs">
        <button class="productdetails-tab-button productdetails-active">DESCRIPTION</button>
    </div>

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

    @if($relatedProducts->count() > 0)
        <div class="productdetails-related-products">
            <h2 class="productdetails-related-title">Related products</h2>

            <div class="productdetails-products-grid">
                @foreach($relatedProducts as $relatedProduct)
                    <a href="{{ route('productdetails', $relatedProduct->product_slug) }}" class="productdetails-product-card">
                        @if(!empty($relatedProduct->product_image))
                            <img src="{{ asset('uploads/products/'.$relatedProduct->product_image) }}" alt="{{ $relatedProduct->product_name }}">
                        @else
                            <img src="https://via.placeholder.com/400x300?text=No+Image" alt="{{ $relatedProduct->product_name }}">
                        @endif
                        <h3>{{ strtoupper($relatedProduct->product_name) }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>

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

    function updateThumbnails() {
        thumbnails.forEach((thumb, index) => {
            thumb.classList.toggle('productdetails-active', index === currentIndex);
        });
    }

    function changeSlide(direction) {
        currentIndex += direction;

        if (currentIndex >= totalSlides) {
            currentIndex = 0;
        } else if (currentIndex < 0) {
            currentIndex = totalSlides - 1;
        }

        updateSlider();
    }

    function goToSlide(index) {
        currentIndex = index;
        updateSlider();
    }

    function updateSlider() {
        const offset = -currentIndex * 100;
        sliderTrack.style.transform = `translateX(${offset}%)`;
        updateThumbnails();
    }

    function openZoom(index) {
        document.getElementById('zoomImage').src = imageUrls[currentIndex];
        document.getElementById('zoomModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeZoom() {
        document.getElementById('zoomModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    document.querySelector('.productdetails-main-image-container').addEventListener('click', function(e) {
        if (!e.target.classList.contains('productdetails-slider-arrow')) {
            openZoom(currentIndex);
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') changeSlide(-1);
        if (e.key === 'ArrowRight') changeSlide(1);
        if (e.key === 'Escape') closeZoom();
    });

    let touchStartX = 0;
    let touchEndX = 0;

    sliderTrack.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });

    sliderTrack.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        if (touchEndX < touchStartX - 50) changeSlide(1);
        if (touchEndX > touchStartX + 50) changeSlide(-1);
    });
</script>

@include('Frontend.pages.footer')
