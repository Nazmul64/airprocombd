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

            @if($videosections->count() > 0)
                <!-- About Tritech Section -->
                <div class="section-header">
                    <h2>Airpro.com.bd</h2>
                </div>

                <div class="video-grid">
                    @foreach($videosections->take(2) as $video)
                    <div class="video-item">
                        <div class="video-wrapper">
                            @if($video->video_link)
                                @php
                                    // Extract YouTube video ID from various URL formats
                                    $videoId = '';
                                    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $video->video_link, $id)) {
                                        $videoId = $id[1];
                                    } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $video->video_link, $id)) {
                                        $videoId = $id[1];
                                    } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $video->video_link, $id)) {
                                        $videoId = $id[1];
                                    }
                                @endphp

                                @if($videoId)
                                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                    </iframe>
                                @else
                                    <iframe src="{{ $video->video_link }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                    </iframe>
                                @endif
                            @endif
                        </div>
                        <div class="video-info">
                            <h3>{{ $video->video_title ?? 'Video Title' }}</h3>
                            <p>{{ $video->description ?? 'Video description goes here.' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- HVAC-R EPC Services Section (if more than 2 videos) -->
                @if($videosections->count() > 2)
                <div class="section-header">
                    <h2>HVAC-R EPC Services</h2>
                </div>

                <div class="video-grid">
                    @foreach($videosections->slice(2, 2) as $video)
                    <div class="video-item">
                        <div class="video-wrapper">
                            @if($video->video_link)
                                @php
                                    $videoId = '';
                                    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $video->video_link, $id)) {
                                        $videoId = $id[1];
                                    } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $video->video_link, $id)) {
                                        $videoId = $id[1];
                                    } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $video->video_link, $id)) {
                                        $videoId = $id[1];
                                    }
                                @endphp

                                @if($videoId)
                                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                    </iframe>
                                @else
                                    <iframe src="{{ $video->video_link }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                    </iframe>
                                @endif
                            @endif
                        </div>
                        <div class="video-info">
                            <h3>{{ $video->video_title ?? 'Video Title' }}</h3>
                            <p>{{ $video->description ?? 'Video description goes here.' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- More Videos Section (if more than 4 videos) -->
                @if($videosections->count() > 4)
                <div class="section-header">
                    <h2>More Videos</h2>
                </div>

                <div class="video-grid">
                    @foreach($videosections->slice(4) as $video)
                    <div class="video-item">
                        <div class="video-wrapper">
                            @if($video->video_link)
                                @php
                                    $videoId = '';
                                    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $video->video_link, $id)) {
                                        $videoId = $id[1];
                                    } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $video->video_link, $id)) {
                                        $videoId = $id[1];
                                    } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $video->video_link, $id)) {
                                        $videoId = $id[1];
                                    }
                                @endphp

                                @if($videoId)
                                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                    </iframe>
                                @else
                                    <iframe src="{{ $video->video_link }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                    </iframe>
                                @endif
                            @endif
                        </div>
                        <div class="video-info">
                            <h3>{{ $video->video_title ?? 'Video Title' }}</h3>
                            <p>{{ $video->description ?? 'Video description goes here.' }}</p>
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
                            <img src="{{ asset('uploads/blog/'.$post->blog_image) }}" alt="{{ $post->blog_title }}">
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
