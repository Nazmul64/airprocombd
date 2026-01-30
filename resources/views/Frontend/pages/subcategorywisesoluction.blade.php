@include('Frontend.pages.header')
<style>
    /* Breadcrumb */
    .solution-breadcrumb {
        padding: 20px 5%;
        background-color: var(--bg-light);
        font-size: 14px;
        color: var(--text-gray);
    }

    .solution-breadcrumb a {
        color: var(--text-gray);
        text-decoration: none;
        margin-right: 10px;
    }

    .solution-breadcrumb a:hover {
        color: var(--accent-red);
    }

    .solution-breadcrumb span {
        margin: 0 8px;
    }

    /* Hero Section */
    .solution-hero {
        padding: 80px 5% 60px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .solution-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 700;
        text-align: center;
        color: var(--text-dark);
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .solution-hero p {
        text-align: center;
        font-size: 18px;
        color: var(--text-gray);
        max-width: 800px;
        margin: 0 auto;
    }

    /* Solutions Grid */
    .solutions-grid {
        padding: 60px 5%;
        max-width: 1400px;
        margin: 0 auto;
    }

    .solutions-container {
        display: flex;
        flex-direction: column;
        gap: 60px;
        margin-top: 40px;
    }

    .solution-card {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
        background: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        padding: 40px;
    }

    .solution-card:hover {
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    /* Alternate layout - even cards have image on right */
    .solution-card:nth-child(even) {
        direction: rtl;
    }

    .solution-card:nth-child(even) > * {
        direction: ltr;
    }

    .solution-card-image {
        width: 100%;
        height: 400px;
        overflow: hidden;
        position: relative;
        border-radius: 12px;
    }

    .solution-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .solution-card:hover .solution-card-image img {
        transform: scale(1.05);
    }

    .solution-badge {
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
    }

    .solution-card-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 0;
    }

    .solution-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .solution-card-description {
        font-size: 16px;
        line-height: 1.8;
        color: var(--text-gray);
        margin-bottom: 25px;
        text-align: justify;
    }

    .solution-card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 25px;
        border-top: 2px solid #e9ecef;
    }

    .solution-category-tag {
        font-size: 14px;
        color: var(--primary-navy);
        font-weight: 600;
        background: #f8f9fa;
        padding: 8px 16px;
        border-radius: 20px;
    }

    .solution-read-more {
        color: var(--accent-red);
        font-weight: 600;
        text-decoration: none;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: gap 0.3s ease;
    }

    .solution-read-more:hover {
        gap: 12px;
    }

    .no-solutions {
        text-align: center;
        padding: 80px 20px;
    }

    .no-solutions h3 {
        font-size: 1.8rem;
        color: var(--text-dark);
        margin-bottom: 15px;
    }

    .no-solutions p {
        font-size: 16px;
        color: var(--text-gray);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .solution-hero h1 {
            font-size: 2rem;
        }

        .solution-card {
            grid-template-columns: 1fr;
            gap: 30px;
            padding: 25px;
        }

        .solution-card:nth-child(even) {
            direction: ltr;
        }

        .solution-card-image {
            height: 250px;
        }

        .solution-card-title {
            font-size: 1.5rem;
        }

        .solution-card-description {
            font-size: 15px;
        }

        .solution-card-meta {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
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

    .solution-card {
        animation: fadeInUp 0.6s ease-out;
    }
</style>
</head>
<body>
    <!-- Breadcrumb -->
    <nav class="solution-breadcrumb">
        <a href="{{ url('/') }}">Home</a>
        <span>›</span>
        <a href="#">Solutions</a>
        <span>›</span>
        <a href="{{ route('category.wise.solution', $subcategory->category->category_slug) }}">{{ $subcategory->category->category_name }}</a>
        <span>›</span>
        <span>{{ $subcategory->subcategory_name }}</span>
    </nav>

    <!-- Hero Section -->
    <section class="solution-hero">
        <h1>{{ $subcategory->subcategory_name }} Solutions</h1>
        <p>Discover our specialized {{ $subcategory->subcategory_name }} solutions under {{ $subcategory->category->category_name }}</p>
    </section>

    <!-- Solutions Grid -->
    <section class="solutions-grid">
        @if($solutions->count() > 0)
            <div class="solutions-container">
                @foreach($solutions as $solution)
                    <div class="solution-card">
                        <div class="solution-card-image">
                            <img src="{{ asset('uploads/solutions/' . $solution->photo) }}" alt="{{ $solution->title }}">
                            <span class="solution-badge">{{ $solution->subcategory->subcategory_name }}</span>
                        </div>
                        <div class="solution-card-content">
                            <h3 class="solution-card-title">{{ $solution->title }}</h3>
                            <p class="solution-card-description">{{ $solution->description }}</p>
                            <div class="solution-card-meta">
                                <span class="solution-category-tag">{{ $solution->category->category_name }}</span>
                                <a href="#" class="solution-read-more">
                                    Learn More →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-solutions">
                <h3>No Solutions Available</h3>
                <p>Currently, there are no solutions available in this subcategory. Please check back later.</p>
            </div>
        @endif
    </section>

    @include('Frontend.pages.footer')
