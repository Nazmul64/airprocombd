// Hero Slider Functionality
document.addEventListener('DOMContentLoaded', () => {
    let currentSlide = 0;
    const slides = document.querySelectorAll('#heroSlider .slide');
    const dots = document.querySelectorAll('#heroSlider .slider-dot');

    function showSlide(index) {
        slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
        dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
        currentSlide = index;
    }

    // Click on dots
    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            const index = parseInt(dot.dataset.index);
            showSlide(index);
        });
    });

    // Auto slide every 5 seconds
    setInterval(() => {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }, 5000);

    // Initialize first slide
    showSlide(0);
});

// Product Image Slider Modal Functionality
// Note: products variable should be passed from blade template
let currentSlideIndex = 0;
let products = []; // This will be populated from blade template using @json($products)

function openSlider(index) {
    currentSlideIndex = index;
    showSlide();
    const modal = document.getElementById('imageSliderModal');
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeSlider() {
    const modal = document.getElementById('imageSliderModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

function changeSlideModal(direction) {
    currentSlideIndex += direction;
    if (currentSlideIndex >= products.length) {
        currentSlideIndex = 0;
    }
    if (currentSlideIndex < 0) {
        currentSlideIndex = products.length - 1;
    }
    showSlide();
}

function showSlide() {
    if (products.length === 0) return;

    const product = products[currentSlideIndex];
    const sliderImage = document.getElementById('sliderImage');
    const sliderTitle = document.getElementById('sliderTitle');

    if (sliderImage && product.product_image) {
        // Note: Base asset path should be set from blade template
        const imagePath = product.product_image;
        sliderImage.src = imagePath;
    }

    if (sliderTitle && product.product_name) {
        sliderTitle.textContent = product.product_name;
    }
}

// Keyboard navigation for modal
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('imageSliderModal');
    if (modal && modal.style.display === 'flex') {
        if (e.key === 'ArrowLeft') {
            changeSlideModal(-1);
        }
        if (e.key === 'ArrowRight') {
            changeSlideModal(1);
        }
        if (e.key === 'Escape') {
            closeSlider();
        }
    }
});

// Close modal on click outside
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

/**
 * Blog Show Page JavaScript
 * Handles animations and interactions for blog detail page
 */

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {

    // ============================================
    // Smooth Image Loading Animation
    // ============================================
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

    // ============================================
    // Fade-in Animation for Content
    // ============================================
    const contentElements = document.querySelectorAll('.blog-detail-category, .blog-detail-title, .blog-detail-meta, .blog-detail-body');
    contentElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';

        setTimeout(() => {
            element.style.transition = 'all 0.6s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 150);
    });

    // ============================================
    // Share Buttons Animation
    // ============================================
    const shareButtons = document.querySelectorAll('.share-btn');
    shareButtons.forEach((button, index) => {
        button.style.opacity = '0';
        button.style.transform = 'scale(0.8)';

        setTimeout(() => {
            button.style.transition = 'all 0.4s ease';
            button.style.opacity = '1';
            button.style.transform = 'scale(1)';
        }, 1000 + (index * 100));
    });

    // Add click tracking for share buttons
    shareButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const platform = this.classList.contains('facebook') ? 'Facebook' :
                           this.classList.contains('twitter') ? 'Twitter' :
                           this.classList.contains('linkedin') ? 'LinkedIn' :
                           this.classList.contains('whatsapp') ? 'WhatsApp' : 'Unknown';

            console.log(`📤 Sharing on ${platform}`);

            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.6)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'share-ripple 0.6s ease-out';
            ripple.style.pointerEvents = 'none';

            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = '50%';
            ripple.style.top = '50%';
            ripple.style.transform = 'translate(-50%, -50%)';

            this.style.position = 'relative';
            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });

    // ============================================
    // Post Navigation Hover Effects
    // ============================================
    const navLinks = document.querySelectorAll('.post-nav-link');
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.querySelector('.post-nav-title').style.color = '#e74c3c';
        });

        link.addEventListener('mouseleave', function() {
            this.querySelector('.post-nav-title').style.color = '#222';
        });
    });

    // ============================================
    // Sidebar Animation
    // ============================================
    const sidebarElements = document.querySelectorAll('.sidebar');
    sidebarElements.forEach((sidebar, index) => {
        sidebar.style.opacity = '0';
        sidebar.style.transform = 'translateX(20px)';

        setTimeout(() => {
            sidebar.style.transition = 'all 0.5s ease';
            sidebar.style.opacity = '1';
            sidebar.style.transform = 'translateX(0)';
        }, 500 + (index * 200));
    });

    // ============================================
    // Category Items Hover Effect
    // ============================================
    const categoryItems = document.querySelectorAll('.category-item');
    categoryItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(3px)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // ============================================
    // Recent Posts Hover Effect
    // ============================================
    const recentPosts = document.querySelectorAll('.recent-post-item');
    recentPosts.forEach(post => {
        post.addEventListener('mouseenter', function() {
            const img = this.querySelector('.recent-post-image img');
            if (img) {
                img.style.transform = 'scale(1.1)';
            }
        });

        post.addEventListener('mouseleave', function() {
            const img = this.querySelector('.recent-post-image img');
            if (img) {
                img.style.transform = 'scale(1)';
            }
        });
    });

    // ============================================
    // Smooth Scroll for Internal Links
    // ============================================
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

    // ============================================
    // Reading Progress Bar (Optional)
    // ============================================
    const progressBar = document.createElement('div');
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
        const scrollPercentage = (scrollTop / documentHeight) * 100;

        progressBar.style.width = scrollPercentage + '%';
    });

    // ============================================
    // Copy Code Button for Code Blocks
    // ============================================
    const codeBlocks = document.querySelectorAll('.blog-detail-body pre code');
    codeBlocks.forEach(code => {
        const pre = code.parentElement;
        const copyButton = document.createElement('button');
        copyButton.textContent = 'Copy';
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
                setTimeout(() => {
                    this.textContent = 'Copy';
                }, 2000);
            });
        });
    });

    // ============================================
    // Back to Top Button
    // ============================================
    const backToTop = document.createElement('button');
    backToTop.innerHTML = '<i class="fas fa-arrow-up"></i>';
    backToTop.className = 'back-to-top';
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

    // ============================================
    // Image Zoom on Click (Optional)
    // ============================================
    const contentImages = document.querySelectorAll('.blog-detail-body img');
    contentImages.forEach(img => {
        img.style.cursor = 'pointer';
        img.addEventListener('click', function() {
            const modal = document.createElement('div');
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
            `;

            const modalImg = document.createElement('img');
            modalImg.src = this.src;
            modalImg.style.cssText = `
                max-width: 90%;
                max-height: 90%;
                border-radius: 8px;
            `;

            modal.appendChild(modalImg);
            document.body.appendChild(modal);

            modal.addEventListener('click', function() {
                this.remove();
            });
        });
    });

    // ============================================
    // Console Log for Debugging
    // ============================================
    console.log('✅ Blog show page initialized');
    console.log('📖 Reading progress bar enabled');
    console.log('🎨 Share buttons:', shareButtons.length);
});

// Add CSS animation for share ripple
const style = document.createElement('style');
style.textContent = `
    @keyframes share-ripple {
        to {
            transform: translate(-50%, -50%) scale(2);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

/**
 * Blog Post Page JavaScript
 * Handles animations, interactions, and dropdown functionality
 */

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {

    // ============================================
    // Category Dropdown Functionality
    // ============================================
    const dropdownBtn = document.getElementById('categoryDropdownBtn');
    const dropdownMenu = document.getElementById('categoryDropdownMenu');

    if (dropdownBtn && dropdownMenu) {
        // Toggle dropdown on button click
        dropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            dropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownBtn.classList.remove('active');
                dropdownMenu.classList.remove('show');
            }
        });

        // Update button text when clicking on a category
        const dropdownItems = document.querySelectorAll('.category-dropdown-item a');
        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                const categoryName = this.querySelector('span:first-child').textContent;
                document.querySelector('.selected-category').textContent = categoryName;
                dropdownBtn.classList.remove('active');
                dropdownMenu.classList.remove('show');
            });
        });

        // Close dropdown on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                dropdownBtn.classList.remove('active');
                dropdownMenu.classList.remove('show');
            }
        });
    }

    // ============================================
    // Animation on scroll for blog cards
    // ============================================
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '0';
                entry.target.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    entry.target.style.transition = 'all 0.6s ease';
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, 100);

                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all blog cards
    const blogCards = document.querySelectorAll('.blog-card');
    blogCards.forEach(card => {
        observer.observe(card);
    });

    // ============================================
    // Search Functionality
    // ============================================

    // Add loading state to search button
    const searchForm = document.getElementById('searchForm');
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
                }, 500);
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

    // Search input focus effect
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.parentElement.style.boxShadow = '0 0 0 3px rgba(231, 76, 60, 0.1)';
            this.parentElement.style.transition = 'box-shadow 0.3s';
        });

        searchInput.addEventListener('blur', function() {
            this.parentElement.style.boxShadow = 'none';
        });

        // Clear search on Escape key
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                this.value = '';
                this.blur();
            }
        });
    }

    // ============================================
    // Smooth scroll to top functionality
    // ============================================
    const backToTopButton = document.querySelector('.back-to-top');
    if (backToTopButton) {
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });

        backToTopButton.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // ============================================
    // Lazy load images (optional enhancement)
    // ============================================
    const images = document.querySelectorAll('.blog-image img');
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

        images.forEach(img => imageObserver.observe(img));
    }

    // ============================================
    // Add fade-in effect to sidebar items
    // ============================================
    const sidebarItems = document.querySelectorAll('.sidebar');
    sidebarItems.forEach((item, index) => {
        setTimeout(() => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(20px)';
            item.style.transition = 'all 0.5s ease';

            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, 50);
        }, index * 100);
    });

    // ============================================
    // Add ripple effect to read more buttons
    // ============================================
    const readMoreButtons = document.querySelectorAll('.read-more');
    readMoreButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);

            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // ============================================
    // Category dropdown item hover animation
    // ============================================
    const categoryItems = document.querySelectorAll('.category-dropdown-item');
    categoryItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transition = 'transform 0.2s';
            this.style.transform = 'translateX(3px)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // ============================================
    // Recent post items hover effect
    // ============================================
    const recentPosts = document.querySelectorAll('.recent-post-item');
    recentPosts.forEach(post => {
        post.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s';
        });
    });

    // ============================================
    // Console log for debugging
    // ============================================
    console.log('✅ Blog post page initialized');
    console.log('📝 Total blog cards:', blogCards.length);
    console.log('📂 Dropdown initialized:', dropdownBtn !== null);
    console.log('🔍 Search form initialized:', searchForm !== null);
});

// ============================================
// Add CSS for ripple effect dynamically
// ============================================
const style = document.createElement('style');
style.textContent = `
    .read-more {
        position: relative;
        overflow: hidden;
    }

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

    /* Back to top button (optional) */
    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #e74c3c;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background: #c0392b;
        transform: translateY(-5px);
    }
`;
document.head.appendChild(style);
