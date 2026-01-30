@include('Frontend.pages.header')

<style>
    /* CSS Variables - Add these to your main CSS file */
    :root {
        --primary-navy: #1e3a8a;
        --accent-red: #dc2626;
        --text-dark: #1f2937;
        --text-gray: #6b7280;
        --bg-light: #f9fafb;
        --white: #ffffff;
    }

    /* Breadcrumb */
    .product-breadcrumb {
        padding: 20px 5%;
        background-color: var(--bg-light);
        font-size: 14px;
        color: var(--text-gray);
    }

    .product-breadcrumb a {
        color: var(--text-gray);
        text-decoration: none;
        margin-right: 10px;
        transition: color 0.3s ease;
    }

    .product-breadcrumb a:hover {
        color: var(--accent-red);
    }

    .product-breadcrumb span {
        margin: 0 8px;
    }

    /* Hero Section */
    .product-hero {
        padding: 80px 5% 60px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        position: relative;
        overflow: hidden;
    }

    .product-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="40" fill="rgba(220,38,38,0.03)"/></svg>');
        opacity: 0.5;
    }

    .product-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 700;
        text-align: center;
        color: var(--text-dark);
        margin-bottom: 20px;
        line-height: 1.2;
        position: relative;
        z-index: 1;
    }

    .product-hero p {
        text-align: center;
        font-size: 18px;
        color: var(--text-gray);
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* Products Grid */
    .products-grid {
        padding: 60px 5%;
        max-width: 1400px;
        margin: 0 auto;
    }

    .products-container {
        display: flex;
        flex-direction: column;
        gap: 60px;
        margin-top: 40px;
    }

    .product-card {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
        background: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        padding: 40px;
    }

    .product-card:hover {
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
        transform: translateY(-5px);
    }

    /* Alternate layout - even cards have image on right */
    .product-card:nth-child(even) {
        direction: rtl;
    }

    .product-card:nth-child(even) > * {
        direction: ltr;
    }

    .product-card-image {
        width: 100%;
        height: 400px;
        overflow: hidden;
        position: relative;
        border-radius: 12px;
        background: #f3f4f6;
    }

    .product-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-card-image img {
        transform: scale(1.08);
    }

    .product-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--accent-red);
        color: var(--white);
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        z-index: 2;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    .product-card-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 0;
    }

    .product-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 20px;
        line-height: 1.3;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .product-card-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }

    .product-meta-item {
        font-size: 14px;
        color: var(--text-gray);
        padding: 6px 12px;
        background: #f9fafb;
        border-radius: 6px;
    }

    .product-meta-item strong {
        color: var(--text-dark);
        font-weight: 600;
    }

    .product-card-description {
        font-size: 16px;
        line-height: 1.8;
        color: var(--text-gray);
        margin-bottom: 25px;
        text-align: justify;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 25px;
        border-top: 2px solid #e9ecef;
        margin-top: auto;
    }

    .product-category-tag {
        font-size: 14px;
        color: var(--primary-navy);
        font-weight: 600;
        background: #eff6ff;
        padding: 8px 16px;
        border-radius: 20px;
    }

    .product-view-more {
        color: var(--accent-red);
        font-weight: 600;
        text-decoration: none;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        padding: 8px 16px;
        border-radius: 6px;
    }

    .product-view-more:hover {
        gap: 12px;
        background: rgba(220, 38, 38, 0.05);
    }

    .no-products {
        text-align: center;
        padding: 80px 20px;
        background: var(--white);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .no-products h3 {
        font-size: 1.8rem;
        color: var(--text-dark);
        margin-bottom: 15px;
        font-weight: 600;
    }

    .no-products p {
        font-size: 16px;
        color: var(--text-gray);
        margin-bottom: 25px;
    }

    .no-products-icon {
        font-size: 4rem;
        color: var(--text-gray);
        margin-bottom: 20px;
        opacity: 0.5;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .product-hero h1 {
            font-size: 2.5rem;
        }

        .product-card {
            gap: 30px;
            padding: 30px;
        }

        .product-card-title {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 768px) {
        .product-hero {
            padding: 60px 5% 40px;
        }

        .product-hero h1 {
            font-size: 2rem;
        }

        .product-hero p {
            font-size: 16px;
        }

        .products-grid {
            padding: 40px 5%;
        }

        .products-container {
            gap: 40px;
        }

        .product-card {
            grid-template-columns: 1fr;
            gap: 25px;
            padding: 25px;
        }

        .product-card:nth-child(even) {
            direction: ltr;
        }

        .product-card-image {
            height: 280px;
        }

        .product-card-title {
            font-size: 1.5rem;
        }

        .product-card-description {
            font-size: 15px;
            -webkit-line-clamp: 3;
        }

        .product-card-footer {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }
    }

    @media (max-width: 480px) {
        .product-breadcrumb {
            font-size: 12px;
            padding: 15px 5%;
        }

        .product-hero h1 {
            font-size: 1.75rem;
        }

        .product-card-image {
            height: 220px;
        }

        .product-card-title {
            font-size: 1.25rem;
        }
    }

    /* Animation */
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
        animation-fill-mode: both;
    }

    .product-card:nth-child(1) { animation-delay: 0.1s; }
    .product-card:nth-child(2) { animation-delay: 0.2s; }
    .product-card:nth-child(3) { animation-delay: 0.3s; }
    .product-card:nth-child(4) { animation-delay: 0.4s; }
    .product-card:nth-child(5) { animation-delay: 0.5s; }
</style>

</head>
<body>
    <!-- Breadcrumb -->
    <nav class="product-breadcrumb" aria-label="breadcrumb">
        <a href="{{ url('/') }}">Home</a>
        <span>›</span>
        <a href="{{ url('/products') }}">Products</a>
        <span>›</span>
        <span>{{ $category->category_name }}</span>
    </nav>

    <!-- Hero Section -->
    <section class="product-hero">
        <h1>{{ $category->category_name }} Products</h1>
        <p>Explore our comprehensive range of {{ $category->category_name }} products designed to meet your specific needs</p>
    </section>

    <!-- Products Grid -->
    <section class="products-grid">
        @if($products->count() > 0)
            <div class="products-container">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-card-image">
                            @if(!empty($product->product_image))
                                <img src="{{ asset('uploads/products/' . $product->product_image) }}"
                                     alt="{{ $product->product_name }}"
                                     loading="lazy">
                            @else
                                <img src="https://via.placeholder.com/800x600/f3f4f6/6b7280?text=No+Image+Available"
                                     alt="{{ $product->product_name }}"
                                     loading="lazy">
                            @endif

                            @if($product->subcategory)
                                <span class="product-badge">{{ $product->subcategory->subcategory_name }}</span>
                            @endif
                        </div>

                        <div class="product-card-content">
                            <h3 class="product-card-title">{{ $product->product_name }}</h3>

                            @if($product->brand || $product->origin || $product->country)
                                <div class="product-card-meta">
                                    @if($product->brand)
                                        <div class="product-meta-item">
                                            <strong>Brand:</strong> {{ $product->brand }}
                                        </div>
                                    @endif

                                    @if($product->origin)
                                        <div class="product-meta-item">
                                            <strong>Origin:</strong> {{ $product->origin }}
                                        </div>
                                    @endif

                                    @if($product->country)
                                        <div class="product-meta-item">
                                            <strong>Country:</strong> {{ $product->country }}
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if($product->product_description)
                                <p class="product-card-description">{{ $product->product_description }}</p>
                            @endif

                            <div class="product-card-footer">
                                <span class="product-category-tag">{{ $product->category->category_name }}</span>
                                <a href="{{ route('productdetails', $product->product_slug) }}"
                                   class="product-view-more"
                                   aria-label="View details of {{ $product->product_name }}">
                                    View Details →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <div class="no-products-icon">📦</div>
                <h3>No Products Available</h3>
                <p>Currently, there are no products available in this category. Please check back later.</p>
                <a href="{{ url('/') }}" class="product-view-more">
                    ← Back to Home
                </a>
            </div>
        @endif
    </section>

    @include('Frontend.pages.footer')

