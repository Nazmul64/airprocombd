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
