<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airpro.com.bd </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ isset($settings->favicon) ? asset('uploads/settings/' . $settings->favicon) : '' }}">


</head>
<body>
    <!-- Top Info Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $settings->address ?? '' }}
                </div>
                <div class="col-md-6 text-end">
                    <a href="mailto:info@airpro.com.bd" class="me-3">
                        <i class="fas fa-envelope"></i> {{ $settings->email ?? '' }}
                    </a>
                    <a href="tel:+8801786337711">
                        <i class="fas fa-phone"></i> +880-{{ $settings->phone ?? '' }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="main-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="logo">
                        <a href="{{route('frontend')}}"><img src="{{ asset('uploads/settings/' . ($settings->photo ?? '')) }}" alt="Company Logo"></a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="header-actions">
                        <a href="#join" class="btn-join">Join Us</a>
                        <a href="tel:+880{{ $settings->phone ?? '' }}" class="phone-link">
                            <i class="fas fa-phone-alt"></i> Call Now: +880-{{ $settings->phone ?? '' }}
                        </a>
                        <a href="#quote" class="btn-quote">Get a Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg main-nav">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
             <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend') }}">Home</a>
                </li>

           <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Products
    </a>

    @php
        $categories = \App\Models\Category::with('subcategories')->get();
    @endphp

    <ul class="dropdown-menu">
        @foreach ($categories as $category)
            <li class="dropdown-submenu">
                <a class="dropdown-item" href="{{ route('category.wise.products', $category->category_slug) }}">
                    {{ $category->category_name }}
                    @if($category->subcategories->count() > 0)
                        <i class="fas fa-chevron-right float-end"></i>
                    @endif
                </a>

                @if($category->subcategories->count() > 0)
                    <ul class="dropdown-menu">
                        @foreach($category->subcategories as $subcategory)
                            <li>
                                <a class="dropdown-item" href="{{ route('subcategory.wise.products', $subcategory->subcategory_slug) }}">
                                    {{ $subcategory->subcategory_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</li>



                    @php
                       $solutionsCategories = \App\Models\SolutionCategory::with('subcategories')->get();
                   @endphp


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Solutions
                </a>
                <ul class="dropdown-menu">
                    @foreach ($solutionsCategories as $category)
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" href="{{ route('category.wise.solution', $category->category_slug) }}">
                                {{ $category->category_name }}
                                @if($category->subcategories->count() > 0)
                                    <i class="fas fa-chevron-right float-end"></i>
                                @endif
                            </a>

                            @if($category->subcategories->count() > 0)
                                <ul class="dropdown-menu">
                                    @foreach($category->subcategories as $subcategory)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('subcategory.wise.solution', $subcategory->subcategory_slug) }}">
                                                {{ $subcategory->subcategory_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>

</li>


                <li class="nav-item">
                    <a class="nav-link" href="{{route('work.reference')}}">Work References</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('blogpost')}}">Media and Blog</a>
                    <ul class="dropdown-menu">
                         <li class="dropdown-submenu"><a href="{{route('blogpost')}}"class="dropdown-item">Blog</a></li>
                         <li class="dropdown-submenu"><a href="{{route('videoe.section')}}"class="dropdown-item">Airpro.com.bd Videoes</a></li>
                        <li class="dropdown-submenu"><a href="{{route('galleries.video')}}"class="dropdown-item">Airpro.com.bd Gallery</a></li>

                         @php
                        use App\Models\Presentationvideo;
                        $presentationVideo = Presentationvideo::latest()->first();
                    @endphp

                    @if(!empty($presentationVideo?->video_link))
                    <li>
                        <a href="{{ $presentationVideo->video_link }}"
                        target="_blank"
                        class="dropdown-item">
                            Presentation Videos
                        </a>
                    </li>
                    @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacts') }}">Contact us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
