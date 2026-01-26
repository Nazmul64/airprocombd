<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airpro.com.bd - HVAC Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/style.css') }}">

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
                        <img src="{{ asset('uploads/settings/' . ($settings->photo ?? '')) }}" alt="Company Logo">
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
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#about">About Tritech</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#why">Why Tritech</a></li>
                            <li><a class="dropdown-item" href="#team">Our Team</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#products">Products</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" href="#vrf">
                                    VRF AC <i class="fas fa-chevron-right float-end"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#daikin">Daikin VRV System</a></li>
                                    <li><a class="dropdown-item" href="#lg">LG VRF System</a></li>
                                    <li><a class="dropdown-item" href="#midea">Midea VRF System</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="#chillers">Electric Chillers</a></li>
                            <li><a class="dropdown-item" href="#oil-free">Oil Free Chiller</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#solutions">Solutions</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#commercial">Commercial HVAC</a></li>
                            <li><a class="dropdown-item" href="#industrial">Industrial HVAC</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#work">Work References</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#media">Media and Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
