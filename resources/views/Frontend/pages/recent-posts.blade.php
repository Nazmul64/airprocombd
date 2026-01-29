<div class="sidebar mb-3">
    <h3 class="sidebar-title">Recent Posts</h3>

    @php
        $recentPosts = App\Models\Blog::with('category')
            ->latest()
            ->take(5)
            ->get();
    @endphp

    @forelse($recentPosts as $post)
    <div class="recent-post-item">
        <div class="recent-post-image">
            @if($post->blog_image)
                <img src="{{ asset("uploads/blog/".$post->blog_image) }}" alt="{{ $post->blog_title }}">
            @else
                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=200" alt="{{ $post->blog_title }}">
            @endif
        </div>
        <div class="recent-post-content">
            <h6>
                <a href="{{ route('blog.show', $post->blog_slug) }}">
                    {{ Str::limit($post->blog_title, 50) }}
                </a>
            </h6>
            <span class="recent-post-date">
                <i class="far fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}
            </span>
        </div>
    </div>
    @empty
    <p style="color: #999; font-size: 14px; text-align: center; padding: 20px 0;">
        No recent posts available
    </p>
    @endforelse
</div>
