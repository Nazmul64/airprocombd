/**
 * ============================================
 * CUSTOM.JS - Complete JavaScript for Website
 * ============================================
 * Contains all interactive functionality including:
 * - Hero Slider
 * - Product Image Modal
 * - Blog Animations
 * - Category Dropdowns
 * - Search Functionality
 * - Scroll Effects
 * ============================================
 */

'use strict';

// ============================================
// HERO SLIDER FUNCTIONALITY
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    const heroSlider = document.getElementById('heroSlider');

    if (heroSlider) {
        let currentSlide = 0;
        const slides = heroSlider.querySelectorAll('.slide');
        const dots = heroSlider.querySelectorAll('.slider-dot');

        // Show specific slide
        function showSlide(index) {
            // Remove active class from all slides and dots
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            // Add active class to current slide and dot
            if (slides[index]) slides[index].classList.add('active');
            if (dots[index]) dots[index].classList.add('active');

            currentSlide = index;
        }

        // Dot click event
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });

        // Auto slide every 5 seconds
        setInterval(() => {
            const nextSlide = (currentSlide + 1) % slides.length;
            showSlide(nextSlide);
        }, 5000);

        // Initialize first slide
        if (slides.length > 0) {
            showSlide(0);
        }

        console.log('✅ Hero Slider initialized:', slides.length, 'slides');
    }
});

// ============================================
// PRODUCT IMAGE SLIDER MODAL
// ============================================
let currentSlideIndex = 0;
let products = []; // Will be populated from blade template

// Open slider modal
function openSlider(index) {
    currentSlideIndex = index;
    const modal = document.getElementById('imageSliderModal');

    if (modal && products.length > 0) {
        showSlide();
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

// Close slider modal
function closeSlider() {
    const modal = document.getElementById('imageSliderModal');

    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

// Change slide in modal
function changeSlideModal(direction) {
    currentSlideIndex += direction;

    // Loop around
    if (currentSlideIndex >= products.length) {
        currentSlideIndex = 0;
    }
    if (currentSlideIndex < 0) {
        currentSlideIndex = products.length - 1;
    }

    showSlide();
}

// Show current slide
function showSlide() {
    if (products.length === 0) return;

    const product = products[currentSlideIndex];
    const sliderImage = document.getElementById('sliderImage');
    const sliderTitle = document.getElementById('sliderTitle');

    if (sliderImage && product.product_image) {
        sliderImage.src = product.product_image;
        sliderImage.alt = product.product_name || 'Product Image';
    }

    if (sliderTitle && product.product_name) {
        sliderTitle.textContent = product.product_name;
    }
}

// Keyboard navigation for modal
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('imageSliderModal');

    if (modal && modal.style.display === 'flex') {
        switch(e.key) {
            case 'ArrowLeft':
                changeSlideModal(-1);
                break;
            case 'ArrowRight':
                changeSlideModal(1);
                break;
            case 'Escape':
                closeSlider();
                break;
        }
    }
});

// Close modal on outside click
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageSliderModal');

    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeSlider();
            }
        });
    }
});

// ============================================
// BLOG SHOW PAGE FUNCTIONALITY
// ============================================
document.addEventListener('DOMContentLoaded', function() {

    // Check if we're on blog show page
    const blogDetailPage = document.querySelector('.blog-detail-image');
    if (!blogDetailPage) return;

    // --------------------------------------------
    // Smooth Image Loading Animation
    // --------------------------------------------
    const blogImage = document.querySelector('.blog-detail-image img');
    if (blogImage) {
        blogImage.style.opacity = '0';

        blogImage.addEventListener('load', function() {
            this.style.transition = 'opacity 0.5s ease';
            this.style.opacity = '1';
        });

        // If image is already cached
        if (blogImage.complete) {
            blogImage.style.opacity = '1';
        }
    }

    // --------------------------------------------
    // Fade-in Animation for Content
    // --------------------------------------------
    const contentElements = document.querySelectorAll(
        '.blog-detail-category, .blog-detail-title, .blog-detail-meta, .blog-detail-body'
    );

    contentElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';

        setTimeout(() => {
            element.style.transition = 'all 0.6s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 150);
    });

    // --------------------------------------------
    // Share Buttons Animation & Functionality
    // --------------------------------------------
    const shareButtons = document.querySelectorAll('.share-btn');

    shareButtons.forEach((button, index) => {
        // Initial animation
        button.style.opacity = '0';
        button.style.transform = 'scale(0.8)';

        setTimeout(() => {
            button.style.transition = 'all 0.4s ease';
            button.style.opacity = '1';
            button.style.transform = 'scale(1)';
        }, 1000 + (index * 100));

        // Click event with ripple effect
        button.addEventListener('click', function(e) {
            const platform = this.classList.contains('facebook') ? 'Facebook' :
                           this.classList.contains('twitter') ? 'Twitter' :
                           this.classList.contains('linkedin') ? 'LinkedIn' :
                           this.classList.contains('whatsapp') ? 'WhatsApp' : 'Unknown';

            console.log(`📤 Sharing on ${platform}`);

            // Create ripple effect
            const ripple = document.createElement('span');
            ripple.className = 'share-ripple';

            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = e.clientX - rect.left - size / 2 + 'px';
            ripple.style.top = e.clientY - rect.top - size / 2 + 'px';

            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });

    // --------------------------------------------
    // Post Navigation Hover Effects
    // --------------------------------------------
    const navLinks = document.querySelectorAll('.post-nav-link');

    navLinks.forEach(link => {
        const title = link.querySelector('.post-nav-title');

        if (title) {
            link.addEventListener('mouseenter', function() {
                title.style.color = '#e74c3c';
                title.style.transition = 'color 0.3s';
            });

            link.addEventListener('mouseleave', function() {
                title.style.color = '#222';
            });
        }
    });

    // --------------------------------------------
    // Sidebar Animation
    // --------------------------------------------
    const sidebarElements = document.querySelectorAll('.blog-detail-container .sidebar');

    sidebarElements.forEach((sidebar, index) => {
        sidebar.style.opacity = '0';
        sidebar.style.transform = 'translateX(20px)';

        setTimeout(() => {
            sidebar.style.transition = 'all 0.5s ease';
            sidebar.style.opacity = '1';
            sidebar.style.transform = 'translateX(0)';
        }, 500 + (index * 200));
    });

    // --------------------------------------------
    // Category Items Hover Effect
    // --------------------------------------------
    const categoryItems = document.querySelectorAll('.category-item');

    categoryItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
            this.style.transition = 'transform 0.3s';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // --------------------------------------------
    // Recent Posts Hover Effect
    // --------------------------------------------
    const recentPosts = document.querySelectorAll('.recent-post-item');

    recentPosts.forEach(post => {
        const img = post.querySelector('.recent-post-image img');

        if (img) {
            post.addEventListener('mouseenter', function() {
                img.style.transform = 'scale(1.1)';
                img.style.transition = 'transform 0.3s';
            });

            post.addEventListener('mouseleave', function() {
                img.style.transform = 'scale(1)';
            });
        }
    });

    // --------------------------------------------
    // Smooth Scroll for Internal Links
    // --------------------------------------------
    const internalLinks = document.querySelectorAll('.blog-detail-body a[href^="#"]');

    internalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // --------------------------------------------
    // Reading Progress Bar
    // --------------------------------------------
    const progressBar = document.createElement('div');
    progressBar.className = 'reading-progress-bar';
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(to right, #e74c3c, #c0392b);
        z-index: 9999;
        transition: width 0.2s ease;
    `;
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', function() {
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight - windowHeight;
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollPercentage = Math.min((scrollTop / documentHeight) * 100, 100);

        progressBar.style.width = scrollPercentage + '%';
    });

    // --------------------------------------------
    // Copy Code Button for Code Blocks
    // --------------------------------------------
    const codeBlocks = document.querySelectorAll('.blog-detail-body pre code');

    codeBlocks.forEach(code => {
        const pre = code.parentElement;
        const copyButton = document.createElement('button');
        copyButton.textContent = 'Copy';
        copyButton.className = 'copy-code-btn';
        copyButton.style.cssText = `
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s;
        `;

        pre.style.position = 'relative';
        pre.appendChild(copyButton);

        pre.addEventListener('mouseenter', () => {
            copyButton.style.opacity = '1';
        });

        pre.addEventListener('mouseleave', () => {
            copyButton.style.opacity = '0';
        });

        copyButton.addEventListener('click', function() {
            navigator.clipboard.writeText(code.textContent).then(() => {
                this.textContent = 'Copied!';
                this.style.background = '#27ae60';

                setTimeout(() => {
                    this.textContent = 'Copy';
                    this.style.background = '#e74c3c';
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy:', err);
            });
        });
    });

    // --------------------------------------------
    // Back to Top Button
    // --------------------------------------------
    const backToTop = document.createElement('button');
    backToTop.innerHTML = '<i class="fas fa-arrow-up"></i>';
    backToTop.className = 'back-to-top';
    backToTop.setAttribute('aria-label', 'Back to top');
    backToTop.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: #e74c3c;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        transition: all 0.3s;
    `;
    document.body.appendChild(backToTop);

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTop.style.display = 'flex';
        } else {
            backToTop.style.display = 'none';
        }
    });

    backToTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    backToTop.addEventListener('mouseenter', function() {
        this.style.background = '#c0392b';
        this.style.transform = 'translateY(-5px)';
    });

    backToTop.addEventListener('mouseleave', function() {
        this.style.background = '#e74c3c';
        this.style.transform = 'translateY(0)';
    });

    // --------------------------------------------
    // Image Zoom on Click
    // --------------------------------------------
    const contentImages = document.querySelectorAll('.blog-detail-body img');

    contentImages.forEach(img => {
        img.style.cursor = 'pointer';
        img.setAttribute('title', 'Click to zoom');

        img.addEventListener('click', function() {
            const modal = document.createElement('div');
            modal.className = 'image-zoom-modal';
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.9);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                cursor: pointer;
                animation: fadeIn 0.3s;
            `;

            const modalImg = document.createElement('img');
            modalImg.src = this.src;
            modalImg.alt = this.alt || 'Zoomed image';
            modalImg.style.cssText = `
                max-width: 90%;
                max-height: 90%;
                border-radius: 8px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            `;

            const closeBtn = document.createElement('button');
            closeBtn.innerHTML = '×';
            closeBtn.style.cssText = `
                position: absolute;
                top: 20px;
                right: 20px;
                background: white;
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                font-size: 24px;
                cursor: pointer;
                color: #333;
            `;

            modal.appendChild(modalImg);
            modal.appendChild(closeBtn);
            document.body.appendChild(modal);

            // Close on click
            modal.addEventListener('click', function(e) {
                if (e.target === modal || e.target === closeBtn) {
                    this.style.animation = 'fadeOut 0.3s';
                    setTimeout(() => this.remove(), 300);
                }
            });

            // Close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal) {
                    modal.style.animation = 'fadeOut 0.3s';
                    setTimeout(() => modal.remove(), 300);
                }
            });
        });
    });

    console.log('✅ Blog show page initialized');
    console.log('📖 Reading progress bar enabled');
    console.log('🎨 Share buttons:', shareButtons.length);
});

// ============================================
// BLOG POST PAGE FUNCTIONALITY
// ============================================
document.addEventListener('DOMContentLoaded', function() {

    // Check if we're on blog post listing page
    const blogPostPage = document.querySelector('.blog-card');
    if (!blogPostPage) return;

    // --------------------------------------------
    // Category Dropdown Functionality
    // --------------------------------------------
    const dropdownBtn = document.getElementById('categoryDropdownBtn');
    const dropdownMenu = document.getElementById('categoryDropdownMenu');

    if (dropdownBtn && dropdownMenu) {
        // Toggle dropdown
        dropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            dropdownMenu.classList.toggle('show');
        });

        // Close on outside click
        document.addEventListener('click', function(e) {
            if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownBtn.classList.remove('active');
                dropdownMenu.classList.remove('show');
            }
        });

        // Update button text on category selection
        const dropdownItems = document.querySelectorAll('.category-dropdown-item a');
        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                const categoryName = this.querySelector('span:first-child')?.textContent;
                const selectedCategory = document.querySelector('.selected-category');

                if (categoryName && selectedCategory) {
                    selectedCategory.textContent = categoryName;
                }

                dropdownBtn.classList.remove('active');
                dropdownMenu.classList.remove('show');
            });
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                dropdownBtn.classList.remove('active');
                dropdownMenu.classList.remove('show');
            }
        });
    }

    // --------------------------------------------
    // Scroll Animation for Blog Cards
    // --------------------------------------------
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '0';
                entry.target.style.transform = 'translateY(30px)';

                setTimeout(() => {
                    entry.target.style.transition = 'all 0.6s ease';
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, 100);

                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const blogCards = document.querySelectorAll('.blog-card');
    blogCards.forEach(card => observer.observe(card));

    // --------------------------------------------
    // Search Functionality
    // --------------------------------------------
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');

    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const input = this.querySelector('input[name="search"]');

            // Validate empty search
            if (input && input.value.trim() === '') {
                e.preventDefault();
                input.focus();
                input.style.borderColor = '#e74c3c';

                setTimeout(() => {
                    input.style.borderColor = '';
                }, 1000);

                return false;
            }

            // Add loading state
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            }
        });
    }

    // Search input effects
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.parentElement.style.boxShadow = '0 0 0 3px rgba(231, 76, 60, 0.1)';
            this.parentElement.style.transition = 'box-shadow 0.3s';
        });

        searchInput.addEventListener('blur', function() {
            this.parentElement.style.boxShadow = 'none';
        });

        // Clear on Escape
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                this.value = '';
                this.blur();
            }
        });
    }

    // --------------------------------------------
    // Sidebar Animation
    // --------------------------------------------
    const sidebarItems = document.querySelectorAll('.blog-post-page .sidebar');

    sidebarItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(20px)';

        setTimeout(() => {
            item.style.transition = 'all 0.5s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, 300 + (index * 150));
    });

    // --------------------------------------------
    // Read More Button Ripple Effect
    // --------------------------------------------
    const readMoreButtons = document.querySelectorAll('.read-more');

    readMoreButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.className = 'ripple';

            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';

            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });

    // --------------------------------------------
    // Category Dropdown Items Hover
    // --------------------------------------------
    const categoryDropdownItems = document.querySelectorAll('.category-dropdown-item');

    categoryDropdownItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transition = 'transform 0.2s';
            this.style.transform = 'translateX(5px)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // --------------------------------------------
    // Recent Posts Hover Effect
    // --------------------------------------------
    const recentPostItems = document.querySelectorAll('.recent-post-item');

    recentPostItems.forEach(post => {
        const img = post.querySelector('img');

        if (img) {
            post.addEventListener('mouseenter', function() {
                img.style.transform = 'scale(1.05)';
                img.style.transition = 'transform 0.3s';
            });

            post.addEventListener('mouseleave', function() {
                img.style.transform = 'scale(1)';
            });
        }
    });

    // --------------------------------------------
    // Lazy Load Images
    // --------------------------------------------
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;

                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }

                    imageObserver.unobserve(img);
                }
            });
        });

        const lazyImages = document.querySelectorAll('img[data-src]');
        lazyImages.forEach(img => imageObserver.observe(img));
    }

    console.log('✅ Blog post page initialized');
    console.log('📝 Total blog cards:', blogCards.length);
    console.log('📂 Dropdown initialized:', dropdownBtn !== null);
    console.log('🔍 Search form initialized:', searchForm !== null);
});

// ============================================
// GLOBAL UTILITIES
// ============================================

// Back to top button (global)
document.addEventListener('DOMContentLoaded', function() {
    const backToTopGlobal = document.querySelector('.back-to-top-global');

    if (backToTopGlobal) {
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopGlobal.classList.add('visible');
            } else {
                backToTopGlobal.classList.remove('visible');
            }
        });

        backToTopGlobal.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});

// ============================================
// DYNAMIC CSS INJECTION
// ============================================
const dynamicStyles = document.createElement('style');
dynamicStyles.textContent = `
    /* Share ripple animation */
    .share-ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: share-ripple-animation 0.6s ease-out;
        pointer-events: none;
    }

    @keyframes share-ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Button ripple animation */
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(231, 76, 60, 0.3);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Read more button positioning */
    .read-more {
        position: relative;
        overflow: hidden;
    }

    /* Back to top button */
    .back-to-top,
    .back-to-top-global {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #e74c3c;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: none;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        transition: all 0.3s;
    }

    .back-to-top.visible,
    .back-to-top-global.visible {
        display: flex;
    }

    .back-to-top:hover,
    .back-to-top-global:hover {
        background: #c0392b;
        transform: translateY(-5px);
    }

    /* Fade animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }

    /* Image zoom modal */
    .image-zoom-modal {
        animation: fadeIn 0.3s ease;
    }

    /* Category dropdown show class */
    .category-dropdown-menu.show {
        display: block;
        animation: fadeIn 0.2s ease;
    }

    /* Smooth transitions */
    * {
        -webkit-tap-highlight-color: transparent;
    }

    /* Loading spinner */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .fa-spinner {
        animation: spin 1s linear infinite;
    }
`;
document.head.appendChild(dynamicStyles);

// ============================================
// CONSOLE LOG
// ============================================
console.log('%c✅ Custom.js loaded successfully', 'color: #27ae60; font-weight: bold; font-size: 14px;');
console.log('%c📦 All modules initialized', 'color: #3498db; font-size: 12px;');
