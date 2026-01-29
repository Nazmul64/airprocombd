@include('Frontend.pages.header')

<!-- Link to external CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/blogpost.css') }}">

<!-- Main Content -->
<div class="container">
    <div class="row">
        <!-- Blog Posts Grid -->
        <div class="col-lg-8">
            <!-- Active Filter Display -->
            @if(request('search') || request('category'))
            <div class="active-filters mb-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        @if(request('search'))
                            <span class="filter-badge">
                                <i class="fas fa-search"></i> Search: "{{ request('search') }}"
                            </span>
                        @endif
                        @if(request('category'))
                            @php
                                $selectedCategory = $blogcategories->firstWhere('id', request('category'));
                            @endphp
                            @if($selectedCategory)
                                <span class="filter-badge">
                                    <i class="fas fa-tag"></i> Category: {{ $selectedCategory->blog_category_name }}
                                </span>
                            @endif
                        @endif
                    </div>
                    <a href="{{ route('blogpost') }}" class="btn-clear-filters">
                        <i class="fas fa-times"></i> Clear Filters
                    </a>
                </div>
            </div>
            @endif

            <!-- Results Count -->
            <div class="results-info mb-3">
                <p class="text-muted">
                    <i class="fas fa-file-alt"></i>
                    Showing {{ $blogposts->count() }} of {{ $blogposts->total() }} blog posts
                </p>
            </div>

            <div class="row" id="blogContainer">
                @forelse($blogposts as $blog)
                <div class="col-md-6 blog-item mb-3" data-category="{{ $blog->blog_category_id ?? '' }}">
                    <div class="blog-card">
                        <div class="blog-image">
                            @if($blog->blog_image)
                                <img src="{{ asset("uploads/blog/".$blog->blog_image) }}" alt="{{ $blog->blog_title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800" alt="{{ $blog->blog_title }}">
                            @endif

                            @if($blog->category)
                                <span class="blog-category-badge">{{ $blog->category->blog_category_name }}</span>
                            @endif
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="far fa-calendar"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                            <h3 class="blog-title">
                                <a href="{{ route('blogshowpost', $blog->blog_slug) }}">{{ Str::limit($blog->blog_title, 60) }}</a>
                            </h3>
                            <p class="blog-excerpt">
                                {{ Str::limit(strip_tags($blog->blog_content), 120) }}
                            </p>
                            <a href="{{ route('blogshowpost', $blog->blog_slug) }}" class="read-more">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="no-results">
                        <i class="fas fa-file-alt"></i>
                        <h3>No Blog Posts Found</h3>
                        @if(request('search') || request('category'))
                            <p>No posts match your current filters. Try adjusting your search or category selection.</p>
                            <a href="{{ route('blogpost') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-arrow-left"></i> View All Posts
                            </a>
                        @else
                            <p>There are no blog posts available at the moment.</p>
                        @endif
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($blogposts->hasPages())
            <div class="pagination-wrapper">
                {{ $blogposts->appends(request()->query())->links() }}
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Search -->
            <div class="sidebar">
                <h3 class="sidebar-title">Search Blog</h3>
                <form action="{{ route('blogpost') }}" method="GET" id="searchForm">
                    <!-- Preserve category filter when searching -->
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <div class="search-box">
                        <input type="text"
                               name="search"
                               placeholder="Search blog posts..."
                               id="searchInput"
                               value="{{ request('search') }}">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                @if(request('search'))
                <div class="mt-2">
                    <a href="{{ route('blogpost', ['category' => request('category')]) }}" class="text-danger" style="font-size: 14px;">
                        <i class="fas fa-times"></i> Clear search
                    </a>
                </div>
                @endif
            </div>

            <!-- Categories -->
            <div class="sidebar">
                <h3 class="sidebar-title">Categories</h3>
                <ul class="category-list">
                    <li class="category-item {{ !request('category') ? 'active' : '' }}">
                        <a href="{{ route('blogpost', ['search' => request('search')]) }}">
                            <span>All Categories</span>
                            <span class="category-count">
                                {{ App\Models\Blog::count() }}
                            </span>
                        </a>
                    </li>
                    @foreach($blogcategories->sortBy('blog_category_name') as $category)
                    <li class="category-item {{ request('category') == $category->id ? 'active' : '' }}">
                        <a href="{{ route('blogpost', ['category' => $category->id, 'search' => request('search')]) }}">
                            <span>{{ $category->blog_category_name }}</span>
                            <span class="category-count">{{ $category->blogs_count }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Recent Posts -->
            @include('Frontend.pages.recent-posts')
        </div>
    </div>
</div>



<script>
/**
 * Blog Post Page JavaScript
 * Handles animations and interactions
 */

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {

    // Animation on scroll for blog cards
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '0';
                entry.target.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    entry.target.style.transition = 'all 0.6s ease';
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, 100);

                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all blog cards
    const blogCards = document.querySelectorAll('.blog-card');
    blogCards.forEach(card => {
        observer.observe(card);
    });

    // Smooth scroll to top functionality (if you have a back to top button)
    const backToTopButton = document.querySelector('.back-to-top');
    if (backToTopButton) {
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });

        backToTopButton.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Add loading state to search button
    const searchForm = document.getElementById('searchForm');
    if (searchForm) {
        searchForm.addEventListener('submit', function() {
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            }
        });
    }

    // Lazy load images (optional enhancement)
    const images = document.querySelectorAll('.blog-image img');
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }

    // Add fade-in effect to sidebar items
    const sidebarItems = document.querySelectorAll('.sidebar');
    sidebarItems.forEach((item, index) => {
        setTimeout(() => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(20px)';
            item.style.transition = 'all 0.5s ease';

            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, 50);
        }, index * 100);
    });

    // Search input focus effect
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.parentElement.style.boxShadow = '0 0 0 3px rgba(231, 76, 60, 0.1)';
        });

        searchInput.addEventListener('blur', function() {
            this.parentElement.style.boxShadow = 'none';
        });
    }

    // Category hover effect enhancement
    const categoryItems = document.querySelectorAll('.category-item');
    categoryItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // Add ripple effect to read more buttons
    const readMoreButtons = document.querySelectorAll('.read-more');
    readMoreButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);

            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Handle empty search
    const searchForm2 = document.querySelector('.search-box form');
    if (searchForm2) {
        searchForm2.addEventListener('submit', function(e) {
            const input = this.querySelector('input[name="search"]');
            if (input && input.value.trim() === '') {
                // Allow empty search to clear search filter
                // e.preventDefault();
            }
        });
    }

    // Console log for debugging (remove in production)
    console.log('Blog post page initialized');
    console.log('Total blog cards:', blogCards.length);
});

// Optional: Add CSS for ripple effect dynamically
const style = document.createElement('style');
style.textContent = `
    .read-more {
        position: relative;
        overflow: hidden;
    }

    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(231, 76, 60, 0.3);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>

@include('Frontend.pages.footer')
