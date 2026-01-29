@include('Frontend.pages.header')

<!-- Link to external CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/blog-show.css') }}">

<!-- Breadcrumb -->
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blogpost') }}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->blog_title, 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Blog Detail -->
<div class="blog-detail-container">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="blog-detail-card">
                    @if($blog->blog_image)
                    <div class="blog-detail-image">
                        <img src="{{ asset("uploads/blog/".$blog->blog_image) }}" alt="{{ $blog->blog_title }}">
                    </div>
                    @endif

                    <div class="blog-detail-content">
                        @if($blog->category)
                        <span class="blog-detail-category">{{ $blog->category->blog_category_name }}</span>
                        @endif

                        <h1 class="blog-detail-title">{{ $blog->blog_title }}</h1>

                        <div class="blog-detail-meta">
                            <span>
                                <i class="far fa-calendar"></i>
                                {{ $blog->created_at->format('F d, Y') }}
                            </span>
                            <span>
                                <i class="far fa-clock"></i>
                                {{ $blog->created_at->format('h:i A') }}
                            </span>
                        </div>

                        <div class="blog-detail-body">
                            {!! $blog->blog_content !!}
                        </div>

                        <!-- Share Section -->
                        <div class="share-section">
                            <h3 class="share-title">Share this post</h3>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="share-btn facebook">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->blog_title) }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="share-btn twitter">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($blog->blog_title) }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="share-btn linkedin">
                                    <i class="fab fa-linkedin-in"></i> LinkedIn
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($blog->blog_title . ' ' . url()->current()) }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="share-btn whatsapp">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post Navigation -->
                @php
                    $previousPost = App\Models\Blog::where('id', '<', $blog->id)
                        ->orderBy('id', 'desc')
                        ->first();
                    $nextPost = App\Models\Blog::where('id', '>', $blog->id)
                        ->orderBy('id', 'asc')
                        ->first();
                @endphp

                @if($previousPost || $nextPost)
                <div class="post-navigation">
                    <div class="post-nav-links">
                        @if($previousPost)
                        <a href="{{ route('blogshowpost', $previousPost->blog_slug) }}" class="post-nav-link">
                            <span class="post-nav-label">
                                <i class="fas fa-arrow-left"></i> Previous Post
                            </span>
                            <span class="post-nav-title">{{ Str::limit($previousPost->blog_title, 40) }}</span>
                        </a>
                        @else
                        <div></div>
                        @endif

                        @if($nextPost)
                        <a href="{{ route('blogshowpost', $nextPost->blog_slug) }}" class="post-nav-link" style="text-align: right;">
                            <span class="post-nav-label">
                                Next Post <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="post-nav-title">{{ Str::limit($nextPost->blog_title, 40) }}</span>
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Recent Posts -->
                @include('Frontend.pages.recent-posts')

                <!-- Categories -->
                @php
                    $blogcategories = App\Models\Blogcategory::has('blogs')
                        ->withCount('blogs')
                        ->get();
                @endphp

                @if($blogcategories->count() > 0)
                <div class="sidebar">
                    <h3 class="sidebar-title">Categories</h3>
                    <ul class="category-list">
                        @foreach($blogcategories->sortBy('blog_category_name') as $category)
                        <li class="category-item">
                            <a href="{{ route('blogpost', ['category' => $category->id]) }}">
                                <span>{{ $category->blog_category_name }}</span>
                                <span class="category-count">{{ $category->blogs_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Link to external JavaScript -->
<script src="{{ asset('frontend/js/blog-show.js') }}"></script>

@include('Frontend.pages.footer')
