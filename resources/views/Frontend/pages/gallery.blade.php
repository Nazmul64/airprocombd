@include('Frontend.pages.header')

<!-- Main Content -->
<div class="container">
    <div class="main-wrapper">
        <!-- Content Area -->
        <div class="content-area">
            <!-- Intro Text -->
            <div class="intro-text">
                <p>For over 20 years, Tritech has been providing innovative HVAC solutions for commercial and industrial buildings. The enriched portfolio of Tritech is glorified with the country's most significant VRF projects, the first-ever oil-free chiller project, and many more. Tritech's cherishable journey is presented with the following HVAC videos that will help you to understand the mechanical industry and Tritech's services.</p>
            </div>

            @if($gallery->count() > 0)
                <!-- About Tritech Section -->
                <div class="section-header">
                    <h2>Airpro.com.bd</h2>
                </div>

                <div class="video-grid">
                    @foreach($gallery->take(2) as $item)
                    <div class="video-item">
                        <div class="video-wrapper">
                            @if($item->photo)
                                <img src="{{ asset('uploads/gallery/' . $item->photo) }}" alt="Gallery Image">
                            @else
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder Image">
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- HVAC-R EPC Services Section (items 3-4) -->
                @if($gallery->count() > 2)
                    <div class="section-header">
                        <h2>HVAC-R EPC Services</h2>
                    </div>

                    <div class="video-grid">
                        @foreach($gallery->slice(2, 2) as $item)
                        <div class="video-item">
                            <div class="video-wrapper">
                                @if($item->photo)
                                    <img src="{{ asset('uploads/gallery/' . $item->photo) }}" alt="Gallery Image">
                                @else
                                    <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder Image">
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                <!-- More Videos Section (items 5+) -->
                @if($gallery->count() > 4)
                    <div class="section-header">
                        <h2>More Videos</h2>
                    </div>

                    <div class="video-grid">
                        @foreach($gallery->slice(4) as $item)
                        <div class="video-item">
                            <div class="video-wrapper">
                                @if($item->photo)
                                    <img src="{{ asset('uploads/gallery/' . $item->photo) }}" alt="Gallery Image">
                                @else
                                    <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder Image">
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            @else
                <!-- No Videos Message -->
                <div class="no-videos">
                    <i class="fas fa-video"></i>
                    <h3>No Videos Available</h3>
                    <p>There are no videos available at the moment. Please check back later.</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Search -->
            <div class="sidebar-section">
                <form action="{{ route('blogpost') }}" method="GET">
                    <div class="search-box">
                        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
                        <button type="submit">🔍</button>
                    </div>
                </form>
            </div>

            <!-- Product Categories -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">Product categories</h3>
                <select class="category-select" onchange="if(this.value) window.location.href='{{ route('blogpost') }}?category=' + this.value">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Recent News -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">Recent news</h3>

                @php
                    $recentPosts = App\Models\Blog::with('category')
                        ->latest()
                        ->take(8)
                        ->get();
                @endphp

                @forelse($recentPosts as $post)
                <div class="news-item">
                    <div class="news-image">
                        @if($post->blog_image)
                            <img src="{{ asset('uploads/blog/' . $post->blog_image) }}" alt="{{ $post->blog_title }}">
                        @else
                            <img src="https://via.placeholder.com/80x60/4a90e2/ffffff?text=News" alt="{{ $post->blog_title }}">
                        @endif
                    </div>
                    <div class="news-content">
                        <h4>
                            <a href="{{ route('blogshowpost', $post->blog_slug) }}">
                                {{ Str::limit($post->blog_title, 60) }}
                            </a>
                        </h4>
                    </div>
                </div>
                @empty
                <p style="color: #999; font-size: 14px; text-align: center; padding: 20px 0;">
                    No recent posts available
                </p>
                @endforelse
            </div>
        </aside>
    </div>
</div>

@include('Frontend.pages.footer')
