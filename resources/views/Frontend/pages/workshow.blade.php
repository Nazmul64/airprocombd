@include('Frontend.pages.header')

<!-- Link to external CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/work-reference-show.css') }}">

<!-- Breadcrumb -->
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('work.reference') }}">Work Reference</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($work->work_title, 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Work Reference Detail -->
<div class="work-detail-container">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="work-detail-card">
                    @if($work->work_image)
                    <div class="work-detail-image">
                        <img src="{{ asset('uploads/workreferences/'.$work->work_image) }}" alt="{{ $work->work_title }}">
                    </div>
                    @endif

                    <div class="work-detail-content">
                        @if($work->category)
                        <span class="work-detail-category">{{ $work->category->work_category_name }}</span>
                        @endif

                        <h1 class="work-detail-title">{{ $work->work_title }}</h1>

                        <div class="work-detail-meta">
                            <span>
                                <i class="far fa-calendar"></i>
                                {{ $work->created_at->format('F d, Y') }}
                            </span>
                            <span>
                                <i class="far fa-clock"></i>
                                {{ $work->created_at->format('h:i A') }}
                            </span>
                            @if($work->category)
                            <span>
                                <i class="fas fa-folder"></i>
                                {{ $work->category->work_category_name }}
                            </span>
                            @endif
                        </div>

                        <div class="work-detail-body">
                            {!! $work->work_content !!}
                        </div>

                        <!-- Additional Work Details (if available) -->
                        @if(isset($work->work_description) && $work->work_description)
                        <div class="work-description-section">
                            <h3>Project Description</h3>
                            <p>{!! $work->work_description !!}</p>
                        </div>
                        @endif

                        <!-- Share Section -->
                        <div class="share-section">
                            <h3 class="share-title">Share this work</h3>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="share-btn facebook">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($work->work_title) }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="share-btn twitter">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($work->work_title) }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="share-btn linkedin">
                                    <i class="fab fa-linkedin-in"></i> LinkedIn
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($work->work_title . ' ' . url()->current()) }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="share-btn whatsapp">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                                <button onclick="copyToClipboard()" class="share-btn copy">
                                    <i class="fas fa-link"></i> Copy Link
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Work Navigation -->
                @php
                    $previousWork = App\Models\Workreferencec::where('id', '<', $work->id)
                        ->orderBy('id', 'desc')
                        ->first();
                    $nextWork = App\Models\Workreferencec::where('id', '>', $work->id)
                        ->orderBy('id', 'asc')
                        ->first();
                @endphp

                @if($previousWork || $nextWork)
                <div class="post-navigation">
                    <div class="post-nav-links">
                        @if($previousWork)
                        <a href="{{ route('work.reference.show', $previousWork->work_slug) }}" class="post-nav-link">
                            <span class="post-nav-label">
                                <i class="fas fa-arrow-left"></i> Previous Work
                            </span>
                            <span class="post-nav-title">{{ Str::limit($previousWork->work_title, 40) }}</span>
                        </a>
                        @else
                        <div></div>
                        @endif

                        @if($nextWork)
                        <a href="{{ route('work.reference.show', $nextWork->work_slug) }}" class="post-nav-link" style="text-align: right;">
                            <span class="post-nav-label">
                                Next Work <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="post-nav-title">{{ Str::limit($nextWork->work_title, 40) }}</span>
                        </a>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Back to All Works Button -->
                <div class="back-to-works">
                    <a href="{{ route('work.reference') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back to All Work References
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Recent Work References -->
                @php
                    $recentWorks = App\Models\Workreferencec::where('id', '!=', $work->id)
                        ->latest()
                        ->take(5)
                        ->get();
                @endphp

                @if($recentWorks->count() > 0)
                <div class="sidebar">
                    <h3 class="sidebar-title">Recent Work</h3>
                    <div class="recent-posts">
                        @foreach($recentWorks as $recent)
                        <div class="recent-post-item">
                            <div class="recent-post-image">
                                @if($recent->work_image)
                                    <img src="{{ asset('uploads/workreferences/'.$recent->work_image) }}" alt="{{ $recent->work_title }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=100" alt="{{ $recent->work_title }}">
                                @endif
                            </div>
                            <div class="recent-post-content">
                                <h4>
                                    <a href="{{ route('work.reference.show', $recent->work_slug) }}">
                                        {{ Str::limit($recent->work_title, 50) }}
                                    </a>
                                </h4>
                                <span class="recent-post-date">
                                    <i class="far fa-calendar"></i> {{ $recent->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Categories -->
                @php
                    $workcategories = App\Models\Workreferencecategory::has('works')
                        ->withCount('works')
                        ->get();
                @endphp

                @if($workcategories->count() > 0)
                <div class="sidebar">
                    <h3 class="sidebar-title">Categories</h3>
                    <ul class="category-list">
                        @foreach($workcategories->sortBy('work_category_name') as $category)
                        <li class="category-item {{ $work->work_category_id == $category->id ? 'active' : '' }}">
                            <a href="{{ route('work.reference', ['category' => $category->id]) }}">
                                <span>{{ $category->work_category_name }}</span>
                                <span class="category-count">{{ $category->works_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Search Widget -->
                <div class="sidebar">
                    <h3 class="sidebar-title">Search Work References</h3>
                    <form action="{{ route('work.reference') }}" method="GET">
                        <div class="search-box">
                            <input type="text"
                                   name="search"
                                   placeholder="Search work references..."
                                   class="form-control">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Related Works (Same Category) -->
                @if($work->category)
                    @php
                        $relatedWorks = App\Models\Workreferencec::where('work_category_id', $work->work_category_id)
                            ->where('id', '!=', $work->id)
                            ->latest()
                            ->take(3)
                            ->get();
                    @endphp

                    @if($relatedWorks->count() > 0)
                    <div class="sidebar">
                        <h3 class="sidebar-title">Related Work</h3>
                        <div class="related-works">
                            @foreach($relatedWorks as $related)
                            <div class="related-work-item">
                                @if($related->work_image)
                                <div class="related-work-image">
                                    <img src="{{ asset('uploads/workreferences/'.$related->work_image) }}" alt="{{ $related->work_title }}">
                                </div>
                                @endif
                                <div class="related-work-content">
                                    <h4>
                                        <a href="{{ route('work.reference.show', $related->work_slug) }}">
                                            {{ Str::limit($related->work_title, 50) }}
                                        </a>
                                    </h4>
                                    <span class="related-work-date">
                                        <i class="far fa-calendar"></i> {{ $related->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for copy to clipboard -->
<script>
/**
 * Work Reference Show Page JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {

    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add animation to share buttons
    const shareButtons = document.querySelectorAll('.share-btn');
    shareButtons.forEach((btn, index) => {
        btn.style.opacity = '0';
        btn.style.transform = 'translateY(20px)';

        setTimeout(() => {
            btn.style.transition = 'all 0.3s ease';
            btn.style.opacity = '1';
            btn.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Fade in animation for content
    const workDetailCard = document.querySelector('.work-detail-card');
    if (workDetailCard) {
        workDetailCard.style.opacity = '0';
        workDetailCard.style.transform = 'translateY(30px)';

        setTimeout(() => {
            workDetailCard.style.transition = 'all 0.6s ease';
            workDetailCard.style.opacity = '1';
            workDetailCard.style.transform = 'translateY(0)';
        }, 200);
    }

    // Sidebar animation
    const sidebarWidgets = document.querySelectorAll('.sidebar');
    sidebarWidgets.forEach((widget, index) => {
        widget.style.opacity = '0';
        widget.style.transform = 'translateX(20px)';

        setTimeout(() => {
            widget.style.transition = 'all 0.5s ease';
            widget.style.opacity = '1';
            widget.style.transform = 'translateX(0)';
        }, 300 + (index * 100));
    });

    // Image zoom on hover
    const workImage = document.querySelector('.work-detail-image img');
    if (workImage) {
        workImage.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.transition = 'transform 0.3s ease';
        });

        workImage.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }

    // Add reading progress bar
    createReadingProgressBar();

    console.log('Work reference detail page initialized');
});

// Copy to clipboard function
function copyToClipboard() {
    const url = window.location.href;

    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(url).then(() => {
            showCopyNotification('Link copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy:', err);
            fallbackCopyToClipboard(url);
        });
    } else {
        fallbackCopyToClipboard(url);
    }
}

// Fallback copy method
function fallbackCopyToClipboard(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    document.body.appendChild(textArea);
    textArea.select();

    try {
        document.execCommand('copy');
        showCopyNotification('Link copied to clipboard!');
    } catch (err) {
        showCopyNotification('Failed to copy link', 'error');
    }

    document.body.removeChild(textArea);
}

// Show copy notification
function showCopyNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `copy-notification ${type}`;
    notification.textContent = message;

    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#28a745' : '#dc3545'};
        color: white;
        padding: 15px 25px;
        border-radius: 5px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        animation: slideIn 0.3s ease;
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Reading progress bar
function createReadingProgressBar() {
    const progressBar = document.createElement('div');
    progressBar.className = 'reading-progress';
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(to right, #e74c3c, #c0392b);
        z-index: 9999;
        transition: width 0.1s ease;
    `;
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', () => {
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollPercentage = (scrollTop / (documentHeight - windowHeight)) * 100;

        progressBar.style.width = scrollPercentage + '%';
    });
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    .share-btn {
        transition: all 0.3s ease;
    }

    .share-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .category-item.active a {
        background: #e74c3c;
        color: white;
    }

    .back-to-works {
        margin-top: 30px;
        text-align: center;
    }

    .back-to-works .btn {
        padding: 12px 30px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .back-to-works .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
    }

    .work-detail-image {
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .work-detail-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .work-description-section {
        margin: 30px 0;
        padding: 25px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 4px solid #e74c3c;
    }

    .work-description-section h3 {
        color: #2c3e50;
        margin-bottom: 15px;
    }
`;
document.head.appendChild(style);
</script>

@include('Frontend.pages.footer')
