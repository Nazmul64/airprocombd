<!-- Footer -->
    <footer style="background: #1a1a1a; color: #aaa; padding: 60px 0 30px;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div style="font-size: 28px; font-weight: 800; color: white; margin-bottom: 20px;">TRITECH</div>
                    <p><i class="fas fa-map-marker-alt" style="color: #ff6b35;"></i> JCX Business Tower, Plot - 1136/A, Japan Street, Block - I, Bashundhara R/A, Dhaka 1229</p>
                    <p><i class="fas fa-phone" style="color: #ff6b35;"></i> 096 1033 1033, +880-1786337711</p>
                    <p><i class="fas fa-envelope" style="color: #ff6b35;"></i> tritech@tritechbd.com</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 style="color: #ff6b35; font-weight: 700; margin-bottom: 25px;">Navigation</h5>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 12px;"><a href="#" style="color: #aaa; text-decoration: none;">Home</a></li>
                        <li style="margin-bottom: 12px;"><a href="#" style="color: #aaa; text-decoration: none;">About Tritech</a></li>
                        <li style="margin-bottom: 12px;"><a href="#" style="color: #aaa; text-decoration: none;">Products</a></li>
                        <li style="margin-bottom: 12px;"><a href="#" style="color: #aaa; text-decoration: none;">Solutions</a></li>
                        <li style="margin-bottom: 12px;"><a href="#" style="color: #aaa; text-decoration: none;">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 style="color: #ff6b35; font-weight: 700; margin-bottom: 25px;">Socialise with us</h5>
                    <div>
                        <a href="#" style="color: white; margin-right: 15px; font-size: 20px;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="color: white; margin-right: 15px; font-size: 20px;"><i class="fab fa-twitter"></i></a>
                        <a href="#" style="color: white; margin-right: 15px; font-size: 20px;"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" style="color: white; font-size: 20px;"><i class="fab fa-youtube"></i></a>
                    </div>
                    <h5 style="color: #ff6b35; font-weight: 700; margin: 25px 0;">Working Hours</h5>
                    <p>Saturday - Thursday: 09am - 06pm<br>Friday: Closed</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 style="color: #ff6b35; font-weight: 700; margin-bottom: 25px;">Latest News</h5>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 12px;"><a href="#" style="color: #aaa; text-decoration: none; font-size: 14px;">Football Fun-Fest 2026</a></li>
                        <li style="margin-bottom: 12px;"><a href="#" style="color: #aaa; text-decoration: none; font-size: 14px;">Tritech Holdings New Chapter</a></li>
                    </ul>
                </div>
            </div>
            <div style="border-top: 1px solid #333; margin-top: 40px; padding-top: 30px; text-align: center; color: #666;">
                <p>&copy; 2026 Tritech Building Services Limited. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        const totalSlides = slides.length;

        function showSlide(n) {
            slides.forEach(s => s.style.opacity = '0');
            dots.forEach(d => {
                d.style.width = '12px';
                d.style.borderRadius = '50%';
                d.style.background = 'rgba(255,255,255,0.5)';
                d.classList.remove('active');
            });

            currentSlide = (n + totalSlides) % totalSlides;
            slides[currentSlide].style.opacity = '1';
            dots[currentSlide].style.width = '30px';
            dots[currentSlide].style.borderRadius = '6px';
            dots[currentSlide].style.background = 'white';
            dots[currentSlide].classList.add('active');
        }

        function goToSlide(n) {
            showSlide(n);
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);

        // Dropdown hover functionality
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function() {
                this.querySelector('.dropdown-menu').style.display = 'block';
            });
            dropdown.addEventListener('mouseleave', function() {
                this.querySelector('.dropdown-menu').style.display = 'none';
            });
        });

        // Nested dropdown hover
        document.querySelectorAll('.dropdown-submenu').forEach(submenu => {
            submenu.addEventListener('mouseenter', function() {
                const menu = this.querySelector('.dropdown-menu');
                if(menu) menu.style.display = 'block';
            });
            submenu.addEventListener('mouseleave', function() {
                const menu = this.querySelector('.dropdown-menu');
                if(menu) menu.style.display = 'none';
            });
        });

        // Product card hover effects
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px)';
                this.style.boxShadow = '0 15px 40px rgba(0,86,179,0.2)';
                this.style.borderColor = '#0056b3';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 5px 20px rgba(0,0,0,0.08)';
                this.style.borderColor = 'transparent';
            });
        });

        // Nav link hover effects
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.background = 'rgba(255,255,255,0.15)';
            });
            link.addEventListener('mouseleave', function() {
                this.style.background = 'transparent';
            });
        });

        // Dropdown item hover effects
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.background = 'rgba(255,255,255,0.1)';
                this.style.borderLeft = '3px solid #ff6b35';
                this.style.paddingLeft = '30px';
            });
            item.addEventListener('mouseleave', function() {
                this.style.background = 'transparent';
                this.style.borderLeft = '3px solid transparent';
                this.style.paddingLeft = '20px';
            });
        });

        // Partners Slider Functionality
        let partnerSlidePosition = 0;
        const partnersSlider = document.getElementById('partnersSlider');
        const partnerBoxes = document.querySelectorAll('.partner-box');
        const totalPartners = partnerBoxes.length;
        const partnersToShow = 5;
        const maxSlide = totalPartners - partnersToShow;

        function slidePartners(direction) {
            if (direction === 'next') {
                if (partnerSlidePosition < maxSlide) {
                    partnerSlidePosition++;
                } else {
                    partnerSlidePosition = 0;
                }
            } else {
                if (partnerSlidePosition > 0) {
                    partnerSlidePosition--;
                } else {
                    partnerSlidePosition = maxSlide;
                }
            }

            const slideAmount = partnerSlidePosition * (100 / partnersToShow);
            partnersSlider.style.transform = `translateX(-${slideAmount}%)`;
        }

        // Auto slide partners every 3 seconds
        setInterval(() => {
            slidePartners('next');
        }, 3000);

        // Partner box hover effects
        document.querySelectorAll('.partner-box').forEach(box => {
            box.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
                this.style.boxShadow = '0 5px 20px rgba(0,0,0,0.1)';
            });
            box.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = 'none';
            });
        });

        // Hexagon 3D hover effects
        document.querySelectorAll('.hexagon-card').forEach((card, index) => {
            const hexagon = card.querySelector('div > div');

            card.addEventListener('mouseenter', function() {
                hexagon.style.transform = 'translateY(-10px) rotateX(5deg) rotateY(5deg) scale(1.05)';
                hexagon.style.transition = 'transform 0.5s ease';
            });

            card.addEventListener('mouseleave', function() {
                hexagon.style.transform = 'translateY(0) rotateX(0) rotateY(0) scale(1)';
            });

            // Add floating animation
            hexagon.style.animation = `float${index} 3s ease-in-out infinite`;
        });

        // Add floating keyframes dynamically
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float0 {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-15px); }
            }
            @keyframes float1 {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            @keyframes float2 {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-15px); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
