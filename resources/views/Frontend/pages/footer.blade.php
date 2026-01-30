
    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-logo">
                    <div class="col-md-3">
                    <div class="logo">
                        <img src="{{ asset('uploads/settings/' . ($settings->photo ?? '')) }}" alt="Company Logo">
                    </div>
                </div>
                    </div>
                    <p class="footer-text">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $settings->address ?? '' }}
                    </p>
                    <p class="footer-text">
                        <i class="fas fa-phone"></i>
                        096 1033 1033, +880-{{ $settings->phone ?? '' }}
                    </p>
                    <p class="footer-text">
                        <i class="fas fa-envelope"></i>
                        {{ $settings->email ?? '' }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-heading">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Tritech</a></li>
                        <li><a href="#products">Products</a></li>
                        <li><a href="#solutions">Solutions</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Social & Working Hours -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-heading">Connect With Us</h5>
                    <div class="social-links">
                        <a href="{{ $settings->facebook ?? '#' }}" target="_blank" class="social-icon" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="{{ $settings->twitter ?? '#' }}" target="_blank" class="social-icon" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="{{ $settings->linkedin ?? '#' }}" target="_blank" class="social-icon" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="{{ $settings->youtube ?? '#' }}" target="_blank" class="social-icon" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <h5 class="footer-heading mt-4">Working Hours</h5>
                    <p class="footer-text">
                        <strong>Saturday - Thursday:</strong><br>
                        09:00 AM - 06:00 PM
                    </p>
                    <p class="footer-text">
                        <strong>Friday:</strong> Closed
                    </p>
                </div>

                <!-- Latest News -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-heading">Latest News</h5>
                    <ul class="footer-news">
                        <li>
                            <a href="#news1">
                                <i class="fas fa-angle-right"></i>
                                Football Fun-Fest 2026
                            </a>
                        </li>
                        <li>
                            <a href="#news2">
                                <i class="fas fa-angle-right"></i>
                                Tritech Holdings New Chapter
                            </a>
                        </li>
                        <li>
                            <a href="#news3">
                                <i class="fas fa-angle-right"></i>
                                Annual Conference 2026
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                        <p class="mb-0">{{ $settings->footer_text ?? '' }}</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <a href="{{route('privacy.and')}}" class="footer-bottom-link">Privacy Policy</a>
                        <span class="separator">|</span>
                        <a href="{{route('termsand.conditions')}}" class="footer-bottom-link">Terms & Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('frontend/assets/front/js/customs.js') }}"></script>
    <script>
        // ============================================
        // NAVIGATION & DROPDOWN FUNCTIONALITY
        // ============================================

        // Desktop dropdown hover functionality
        if (window.innerWidth >= 992) {
            document.querySelectorAll('.nav-item.dropdown').forEach(dropdown => {
                dropdown.addEventListener('mouseenter', function() {
                    const menu = this.querySelector('.dropdown-menu');
                    if (menu) menu.style.display = 'block';
                });
                dropdown.addEventListener('mouseleave', function() {
                    const menu = this.querySelector('.dropdown-menu');
                    if (menu) menu.style.display = 'none';
                });
            });

            // Nested dropdown hover for desktop
            document.querySelectorAll('.dropdown-submenu').forEach(submenu => {
                submenu.addEventListener('mouseenter', function() {
                    const menu = this.querySelector('.dropdown-menu');
                    if (menu) menu.style.display = 'block';
                });
                submenu.addEventListener('mouseleave', function() {
                    const menu = this.querySelector('.dropdown-menu');
                    if (menu) menu.style.display = 'none';
                });
            });
        }

        // Mobile dropdown toggle functionality
        document.querySelectorAll('.nav-item.dropdown').forEach(item => {
            const link = item.querySelector('.nav-link');
            if (link) {
                link.addEventListener('click', function(e) {
                    if (window.innerWidth < 992) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Close other dropdowns
                        document.querySelectorAll('.nav-item.dropdown').forEach(other => {
                            if (other !== item) {
                                other.classList.remove('show');
                                const otherMenu = other.querySelector('.dropdown-menu');
                                if (otherMenu) otherMenu.style.display = 'none';
                            }
                        });

                        // Toggle current dropdown
                        item.classList.toggle('show');
                        const menu = item.querySelector('.dropdown-menu');
                        if (menu) {
                            menu.style.display = item.classList.contains('show') ? 'block' : 'none';
                        }
                    }
                });
            }
        });

        // Submenu toggle for mobile
        document.querySelectorAll('.dropdown-submenu').forEach(item => {
            const link = item.querySelector('.dropdown-item');
            if (link) {
                link.addEventListener('click', function(e) {
                    if (window.innerWidth < 992) {
                        e.preventDefault();
                        e.stopPropagation();

                        const submenu = item.querySelector('.dropdown-menu');
                        if (submenu) {
                            const isVisible = submenu.style.display === 'block';
                            submenu.style.display = isVisible ? 'none' : 'block';
                        }
                    }
                });
            }
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 992 && !e.target.closest('.nav-item')) {
                document.querySelectorAll('.nav-item.dropdown').forEach(item => {
                    item.classList.remove('show');
                    const menu = item.querySelector('.dropdown-menu');
                    if (menu) menu.style.display = 'none';
                });
            }
        });

        // Prevent dropdown menu close on click inside
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        // ============================================
        // SMOOTH SCROLLING
        // ============================================

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '') {
                    const target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                        // Close mobile menu after clicking
                        const navCollapse = document.getElementById('mainNav');
                        if (navCollapse && window.innerWidth < 992) {
                            const bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
                            if (bsCollapse) {
                                bsCollapse.hide();
                            }
                        }
                    }
                }
            });
        });

        // ============================================
        // SCROLL TO TOP BUTTON
        // ============================================

        // Create scroll to top button
        const scrollTopBtn = document.createElement('button');
        scrollTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        scrollTopBtn.className = 'scroll-to-top';
        scrollTopBtn.setAttribute('aria-label', 'Scroll to top');
        document.body.appendChild(scrollTopBtn);

        // Show/hide scroll to top button
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });

        // Scroll to top on click
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // ============================================
        // FOOTER ANIMATIONS
        // ============================================

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe footer columns for animation
        document.querySelectorAll('.main-footer .col-lg-4, .main-footer .col-lg-2, .main-footer .col-lg-3').forEach(col => {
            col.style.opacity = '0';
            col.style.transform = 'translateY(30px)';
            col.style.transition = 'all 0.6s ease';
            observer.observe(col);
        });

        // ============================================
        // HEADER STICKY EFFECT
        // ============================================

        let lastScroll = 0;
        const header = document.querySelector('.main-header');

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 100) {
                header.style.boxShadow = '0 5px 20px rgba(0,0,0,0.15)';
            } else {
                header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.08)';
            }

            lastScroll = currentScroll;
        });

        // ============================================
        // LOADING ANIMATION
        // ============================================

        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });

        // ============================================
        // RESPONSIVE MENU TOGGLE
        // ============================================

        const navToggler = document.querySelector('.navbar-toggler');
        const navCollapse = document.getElementById('mainNav');

        if (navToggler && navCollapse) {
            navToggler.addEventListener('click', function() {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
            });
        }

        // ============================================
        // PREVENT DROPDOWN CLOSING ON RESIZE
        // ============================================

        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                // Reset all dropdowns on resize
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.style.display = '';
                });
                document.querySelectorAll('.nav-item.dropdown').forEach(item => {
                    item.classList.remove('show');
                });
            }, 250);
        });

        // ============================================
        // ACCESSIBILITY IMPROVEMENTS
        // ============================================

        // Add keyboard navigation for dropdowns
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });

        // ============================================
        // CONSOLE MESSAGE
        // ============================================

        console.log('%c🚀 Airpro Website Loaded Successfully!', 'color: #0056b3; font-size: 16px; font-weight: bold;');
        console.log('%cDeveloped with ❤️', 'color: #ff6b35; font-size: 12px;');
    </script>
</body>
</html>
