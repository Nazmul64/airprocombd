@include('Frontend.pages.header')

<!-- Main Content -->
<div class="container my-5">
    <div class="row">
        <!-- Work Reference Posts Grid -->
        <div class="col-lg-8">
            <!-- Active Filter Display -->
            @if(request('search') || request('category'))
            <div class="alert alert-light border mb-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div>
                        @if(request('search'))
                            <span class="badge bg-secondary me-2">
                                <i class="fas fa-search"></i> Search: "{{ request('search') }}"
                            </span>
                        @endif
                        @if(request('category'))
                            @php
                                $selectedCategory = $workcategories->firstWhere('id', request('category'));
                            @endphp
                            @if($selectedCategory)
                                <span class="badge bg-secondary">
                                    <i class="fas fa-tag"></i> Category: {{ $selectedCategory->work_category_name }}
                                </span>
                            @endif
                        @endif
                    </div>
                    <a href="{{ route('work.reference') }}" class="btn btn-sm" style="background-color: #004A9E; color: white;">
                        <i class="fas fa-times"></i> Clear Filters
                    </a>
                </div>
            </div>
            @endif

            <!-- Results Count -->
            <div class="mb-3">
                <p class="text-muted">
                    <i class="fas fa-briefcase"></i>
                    Showing {{ $workposts->count() }} of {{ $workposts->total() }} work references
                </p>
            </div>

            <!-- Work Posts Grid -->
            <div class="row g-3">
                @forelse($workposts as $work)
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <!-- Work Image -->
                        <div class="position-relative">
                            @if($work->work_image)
                                <img src="{{ asset('uploads/workreferences/'.$work->work_image) }}"
                                     class="card-img-top"
                                     alt="{{ $work->work_title }}"
                                     style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800"
                                     class="card-img-top"
                                     alt="{{ $work->work_title }}"
                                     style="height: 200px; object-fit: cover;">
                            @endif

                            @if($work->category)
                                <span class="position-absolute top-0 start-0 m-2 badge" style="background-color: #004A9E;">
                                    {{ $work->category->work_category_name }}
                                </span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column">
                            <div class="text-muted small mb-2">
                                <i class="far fa-calendar"></i> {{ $work->created_at->format('M d, Y') }}
                            </div>

                            <h5 class="card-title">
                                <a href="{{ route('work.reference.show', $work->work_slug) }}"
                                   class="text-decoration-none text-dark">
                                    {{ Str::limit($work->work_title, 60) }}
                                </a>
                            </h5>

                            <p class="card-text text-muted">
                                {{ Str::limit(strip_tags($work->work_content ?? $work->work_description), 120) }}
                            </p>

                            <a href="{{ route('work.reference.show', $work->work_slug) }}"
                               class="btn btn-sm mt-auto" style="border: 1px solid #004A9E; color: #004A9E;">
                                View Details <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-briefcase display-1 mb-3" style="color: #004A9E;"></i>
                        <h3>No Work References Found</h3>
                        @if(request('search') || request('category'))
                            <p class="text-muted">No work references match your current filters. Try adjusting your search or category selection.</p>
                            <a href="{{ route('work.reference') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-arrow-left"></i> View All Work References
                            </a>
                        @else
                            <p class="text-muted">There are no work references available at the moment.</p>
                        @endif
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($workposts->hasPages())
            <div class="mt-4">
                {{ $workposts->appends(request()->query())->links() }}
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Search Box -->
            <div class="card shadow-sm mb-4">
                <div class="card-header text-white" style="background-color: #004A9E;">
                    <h5 class="mb-0">Search Work References</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('work.reference') }}" method="GET">
                        <!-- Preserve category filter when searching -->
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   name="search"
                                   placeholder="Search work references..."
                                   value="{{ request('search') }}">
                            <button class="btn" type="submit" style="background-color: #004A9E; color: white;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    @if(request('search'))
                    <div class="mt-2">
                        <a href="{{ route('work.reference', ['category' => request('category')]) }}"
                           class="small" style="color: #004A9E;">
                            <i class="fas fa-times"></i> Clear search
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Categories -->
            <div class="card shadow-sm mb-4">
                <div class="card-header text-white" style="background-color: #004A9E;">
                    <h5 class="mb-0">Categories</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('work.reference', ['search' => request('search')]) }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ !request('category') ? 'active' : '' }}">
                        <span>All Categories</span>
                        <span class="badge rounded-pill" style="background-color: #004A9E;">
                            {{ App\Models\Workreferencec::count() }}
                        </span>
                    </a>

                    @foreach($workcategories->sortBy('work_category_name') as $category)
                    <a href="{{ route('work.reference', ['category' => $category->id, 'search' => request('search')]) }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request('category') == $category->id ? 'active' : '' }}">
                        <span>{{ $category->work_category_name }}</span>
                        <span class="badge rounded-pill" style="background-color: #004A9E;">{{ $category->works_count }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Recent Work References -->
            @php
                $recentWorks = App\Models\Workreferencec::latest()->take(5)->get();
            @endphp
            @if($recentWorks->count() > 0)
            <div class="card shadow-sm">
                <div class="card-header text-white" style="background-color: #004A9E;">
                    <h5 class="mb-0">Recent Work</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($recentWorks as $recent)
                        <div class="list-group-item">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    @if($recent->work_image)
                                        <img src="{{ asset('uploads/workreferences/'.$recent->work_image) }}"
                                             alt="{{ $recent->work_title }}"
                                             class="rounded"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=100"
                                             alt="{{ $recent->work_title }}"
                                             class="rounded"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">
                                        <a href="{{ route('work.reference.show', $recent->work_slug) }}"
                                           class="text-decoration-none text-dark">
                                            {{ Str::limit($recent->work_title, 50) }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">
                                        <i class="far fa-calendar"></i> {{ $recent->created_at->format('M d, Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@include('Frontend.pages.footer')
