<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airpro.com.bd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/style.css') }}">
</head>
<body>
    <!-- Top Info Bar -->
    <div style="background: #1a1a1a; color: white; padding: 8px 0; font-size: 13px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <i class="fas fa-map-marker-alt" style="color: #ff6b35; margin-right: 5px;"></i>
                    JCX Business Tower, Plot - 1136/A, Japan Street, Block - I, Basundhara R/A, Dhaka 1229
                </div>
                <div class="col-md-6 text-end">
                    <a href="mailto:tritech@tritechbd.com" style="color: white; text-decoration: none; margin-right: 15px;">
                        <i class="fas fa-envelope"></i> tritech@tritechbd.com
                    </a>
                    <a href="tel:+8801786337711" style="color: white; text-decoration: none;">
                        <i class="fas fa-phone"></i> +880-1786337711
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div style="background: white; padding: 20px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.08); position: sticky; top: 0; z-index: 1000;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div style="font-size: 32px; font-weight: 800; color: #0056b3; letter-spacing: 2px;">TRITECH</div>
                </div>
                <div class="col-md-9">
                    <div style="display: flex; gap: 15px; align-items: center; justify-content: flex-end;">
                        <a href="#" style="background: transparent; border: 2px solid #0056b3; color: #0056b3; padding: 8px 20px; border-radius: 5px; font-weight: 600; text-decoration: none;">Join Us</a>
                        <a href="tel:+8801786337711" style="color: #0056b3; font-weight: 600; text-decoration: none; font-size: 16px;">
                            <i class="fas fa-phone-alt"></i> Call Now: +880-1786337711
                        </a>
                        <a href="#" style="background: #ff6b35; color: white; padding: 10px 25px; border-radius: 5px; font-weight: 600; text-decoration: none;">Get a Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg" style="background: linear-gradient(135deg, #0056b3, #004494); box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
        <div class="container">
            <button class="navbar-toggler" style="background: white;" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav nav-menu">
                    <li class="nav-item"><a class="nav-link" href="#" style="color: white; padding: 15px 20px; font-weight: 500;">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" style="color: white; padding: 15px 20px; font-weight: 500;">About Tritech</a>
                        <ul class="dropdown-menu" style="background: #0056b3; border: none; min-width: 280px; display: none;">
                            <li><a class="dropdown-item" href="#" style="color: white; padding: 12px 20px;">Why Tritech</a></li>
                            <li><a class="dropdown-item" href="#" style="color: white; padding: 12px 20px;">Our Team</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" style="color: white; padding: 15px 20px; font-weight: 500;">Products</a>
                        <ul class="dropdown-menu" style="background: #0056b3; border: none; min-width: 280px; display: none;">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item" href="#" style="color: white; padding: 12px 20px;">VRF AC <i class="fas fa-chevron-right" style="float: right;"></i></a>
                                <ul class="dropdown-menu" style="background: #0056b3; border: none; min-width: 250px; display: none; position: absolute; left: 100%; top: 0;">
                                    <li><a class="dropdown-item" href="#" style="color: white; padding: 12px 20px;">Daikin VRV System</a></li>
                                    <li><a class="dropdown-item" href="#" style="color: white; padding: 12px 20px;">LG VRF System</a></li>
                                    <li><a class="dropdown-item" href="#" style="color: white; padding: 12px 20px;">Midea VRF System</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="#" style="color: white; padding: 12px 20px;">Electric Chillers</a></li>
                            <li><a class="dropdown-item" href="#" style="color: white; padding: 12px 20px;">Oil Free Chiller</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" style="color: white; padding: 15px 20px; font-weight: 500;">Solutions</a>
                        <ul class="dropdown-menu" style="background: #0056b3; border: none; min-width: 280px; display: none;">
                            <li><a class="dropdown-item" href="#" style="color: white; padding: 12px 20px;">Commercial HVAC</a></li>
                            <li><a class="dropdown-item" href="#" style="color: white; padding: 12px 20px;">Industrial HVAC</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: white; padding: 15px 20px; font-weight: 500;">Work References</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: white; padding: 15px 20px; font-weight: 500;">Media and Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: white; padding: 15px 20px; font-weight: 500;">Contact us</a></li>
                </ul>
            </div>
        </div>
    </nav>
