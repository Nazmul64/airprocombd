<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header d-flex align-items-center justify-content-between">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ optional(auth()->user())->name ?? 'Admin' }}</h4>
        </div>
        <div class="toggle-icon ms-auto">
            <i class="bi bi-list"></i>
        </div>
    </div>

    <!-- Navigation -->
    <ul class="metismenu" id="menu">
        <!-- Dashboard -->
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <!-- Slider -->
        <li>
            <a href="{{ route('slider.index') }}" class="{{ request()->routeIs('slider.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-images"></i></div>
                <div class="menu-title">Slider</div>
            </a>
        </li>

        <!-- Product Section -->
        <li>
            <a class="has-arrow" href="javascript:;" class="{{ request()->routeIs('product.*', 'categories.*', 'subcategories.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-box-seam"></i></div>
                <div class="menu-title">Product Section</div>
            </a>
            <ul>
                <li><a href="{{ route('product.index') }}" class="{{ request()->routeIs('product.*') ? 'active' : '' }}"><i class="bi bi-circle"></i> Product</a></li>
                <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}"><i class="bi bi-circle"></i> Categories</a></li>
                <li><a href="{{ route('subcategories.index') }}" class="{{ request()->routeIs('subcategories.*') ? 'active' : '' }}"><i class="bi bi-circle"></i> Subcategories</a></li>
            </ul>
        </li>

        <!-- Blog Section -->
        <li>
            <a class="has-arrow" href="javascript:;" class="{{ request()->routeIs('blogcategory.*', 'blog.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-newspaper"></i></div>
                <div class="menu-title">Blog Section</div>
            </a>
            <ul>
                <li><a href="{{ route('blogcategory.index') }}" class="{{ request()->routeIs('blogcategory.*') ? 'active' : '' }}"><i class="bi bi-circle"></i> Blog Category</a></li>
                <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}"><i class="bi bi-circle"></i> Blog Posts</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;" class="{{ request()->routeIs('blogcategory.*', 'blog.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-newspaper"></i></div>
                <div class="menu-title">Work Reference</div>
            </a>
            <ul>
                <li><a href="{{ route('workreferencecategory.index') }}" class="{{ request()->routeIs('blogcategory.*') ? 'active' : '' }}"><i class="bi bi-circle"></i>Workreference Category</a></li>
                <li><a href="{{ route('workreferencec.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}"><i class="bi bi-circle"></i> Blog Posts</a></li>
            </ul>
        </li>





        <!-- Video Section -->
        <li>
            <a class="has-arrow" href="javascript:;" class="{{ request()->routeIs('videosection.*', 'Presentationvideo.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-play-circle-fill"></i></div>
                <div class="menu-title">Video Section</div>
            </a>
            <ul>
                <li><a href="{{ route('videosection.index') }}" class="{{ request()->routeIs('videosection.*') ? 'active' : '' }}"><i class="bi bi-circle"></i> Video Section</a></li>
                <li><a href="{{ route('Presentationvideo.index') }}" class="{{ request()->routeIs('Presentationvideo.*') ? 'active' : '' }}"><i class="bi bi-circle"></i> Presentation Video</a></li>
            </ul>
        </li>

        <!-- Gallery -->
        <li>
            <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-image"></i></div>
                <div class="menu-title">Gallery</div>
            </a>
        </li>

        <!-- Partner -->
        <li>
            <a href="{{ route('partner.index') }}" class="{{ request()->routeIs('partner.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-people"></i></div>
                <div class="menu-title">Partner</div>
            </a>
        </li>

        <!-- Mission -->
        <li>
            <a href="{{ route('mission.index') }}" class="{{ request()->routeIs('mission.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-bullseye"></i></div>
                <div class="menu-title">Mission</div>
            </a>
        </li>

        <!-- Passion Section -->
        <li>
            <a href="{{ route('passionsection.index') }}" class="{{ request()->routeIs('passionsection.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-heart-fill"></i></div>
                <div class="menu-title">Passion Section</div>
            </a>
        </li>

        <!-- Solution Provider -->
        <li>
            <a href="{{ route('solutionprovider.index') }}" class="{{ request()->routeIs('solutionprovider.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-lightbulb"></i></div>
                <div class="menu-title">Solution Provider</div>
            </a>
        </li>

        <!-- Service Provider -->
        <li>
            <a href="{{ route('serviceprovider.index') }}" class="{{ request()->routeIs('serviceprovider.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-gear-wide-connected"></i></div>
                <div class="menu-title">Service Provider</div>
            </a>
        </li>

        <!-- Contact Messages -->
        <li>
            <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.index') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-envelope"></i></div>
                <div class="menu-title">Contact Messages</div>
            </a>
        </li>

        <!-- Contact Info -->
        <li>
            <a href="{{ route('contactinfo.index') }}" class="{{ request()->routeIs('contactinfo.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-info-circle"></i></div>
                <div class="menu-title">Contact Info</div>
            </a>
        </li>

        <!-- About Us -->
        <li>
            <a class="has-arrow" href="javascript:;" class="{{ request()->routeIs('aboutus.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-info-circle-fill"></i></div>
                <div class="menu-title">About Us</div>
            </a>
            <ul>
                <li><a href="{{ route('aboutus.index') }}" class="{{ request()->routeIs('aboutus.*') ? 'active' : '' }}"><i class="bi bi-circle"></i> About Us</a></li>
            </ul>
        </li>

        <!-- Settings -->
        <li>
            <a class="has-arrow" href="javascript:;" class="{{ request()->routeIs('settings.*', 'privacypolicy.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-gear-fill"></i></div>
                <div class="menu-title">Settings</div>
            </a>
            <ul>
                <li><a href="{{ route('settings.index') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}"><i class="bi bi-circle"></i> Settings</a></li>
                <li><a href="{{ route('privacypolicy.index') }}" class="{{ request()->routeIs('privacypolicy.*') ? 'active' : '' }}"><i class="bi bi-circle"></i> Privacy Policy</a></li>
            </ul>
        </li>

        <!-- Terms & Conditions -->
        <li>
            <a href="{{ route('Termscondition.index') }}" class="{{ request()->routeIs('Termscondition.*') ? 'active' : '' }}">
                <div class="parent-icon"><i class="bi bi-file-text-fill"></i></div>
                <div class="menu-title">Terms & Conditions</div>
            </a>
        </li>
    </ul>
</aside>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    // Handle submenu toggle
    $('.metismenu .has-arrow').on('click', function(e){
        e.preventDefault();
        let $this = $(this);
        let $submenu = $this.next('ul');

        // Close other open submenus
        $('.metismenu .has-arrow').not($this).removeClass('mm-active').next('ul').slideUp(250);

        // Toggle current submenu
        $this.toggleClass('mm-active');
        $submenu.slideToggle(250);
    });

    // Keep active menu open on page load
    $('.metismenu ul li a').each(function(){
        let currentUrl = window.location.href;
        let linkUrl = $(this).attr('href');

        if(currentUrl === linkUrl){
            $(this).addClass('active');
            $(this).closest('ul').show();
            $(this).closest('ul').prev('.has-arrow').addClass('mm-active');
        }
    });

    // Mobile sidebar toggle
    $('.toggle-icon').on('click', function(){
        $('.sidebar-wrapper').toggleClass('show');
    });

    // Close sidebar when clicking outside on mobile
    $(document).on('click', function(e){
        if($(window).width() <= 991){
            if(!$(e.target).closest('.sidebar-wrapper, .toggle-icon').length){
                $('.sidebar-wrapper').removeClass('show');
            }
        }
    });
});
</script>
