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
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <!-- Slider -->
       <li>
            <a href="{{ route('slider.index') }}">
                <div class="parent-icon"><i class="fas fa-sliders-h"></i></div>
                <div class="menu-title">Slider</div>
            </a>
        </li>

        <li>
            <a href="{{ route('product.index') }}">
                <div class="parent-icon"><i class="fas fa-sliders-h"></i></div>
                <div class="menu-title">Product</div>
            </a>
        </li>
         <li>
            <a href="{{ route('categories.index') }}">
                <div class="parent-icon"><i class="fas fa-sliders-h"></i></div>
                <div class="menu-title">Categories</div>
            </a>
        </li>

    <li>
        <a href="{{ route('subcategories.index') }}">
            <div class="parent-icon"><i class="fas fa-sliders-h"></i></div>
            <div class="menu-title">SubCategories</div>
        </a>
    </li>




      <li>
            <a href="{{ route('partner.index') }}">
                <div class="parent-icon"><i class="bi bi-people"></i></div>
                <div class="menu-title">Partner</div>
            </a>
        </li>



 <li>
             <a href="{{ route('supportlink.index') }}"><i class="bi bi-circle"></i>Support Link</a>
           </li>
        <!-- Why Choose Us Investment -->
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="menu-title">Why Choose Us Investment</div>
            </a>
            <ul>
                <li><a href="{{ route('whychooseusinvesment.index') }}"><i class="bi bi-circle"></i> Why Choose Us Investment</a></li>
            </ul>
        </li>

        <!-- About Us -->
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-info-circle"></i></div>
                <div class="menu-title">About Us</div>
            </a>
            <ul>
                <li><a href="{{ route('aboutus.index') }}"><i class="bi bi-circle"></i> About Us</a></li>
            </ul>
        </li>

        <!-- Counter -->
        <li>
            <a href="{{ route('counter.index') }}">
                <div class="parent-icon"><i class="bi bi-speedometer2"></i></div>
                <div class="menu-title">Counter</div>
            </a>
        </li>

        <!-- Settings -->
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-gear-fill"></i></div>
                <div class="menu-title">Settings</div>
            </a>
            <ul>
                <li><a href="{{ route('settings.index') }}" target="_blank"><i class="bi bi-circle"></i> Settings</a></li>
                <li><a href="{{ route('privacypolicy.index') }}" target="_blank"><i class="bi bi-circle"></i> Privacy Policy</a></li>
            </ul>
        </li>

        <!-- Contact -->
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-envelope-fill"></i></div>
                <div class="menu-title">Contact</div>
            </a>
            <ul>
                <li><a href="{{ route('contact.index') }}" target="_blank"><i class="bi bi-circle"></i> Contact</a></li>
            </ul>
        </li>




        <!-- Terms & Conditions -->
        <li>
            <a href="{{ route('Termscondition.index') }}">
                <div class="parent-icon"><i class="bi bi-file-text-fill"></i></div>
                <div class="menu-title">Terms & Conditions</div>
            </a>
        </li>
    </ul>

</aside>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
/* Hide submenus initially */
.metismenu ul {
    display: none;
}

/* Highlight active menu */
.metismenu .has-arrow.active {
    background-color: #f1f1f1;
}

/* Pointer cursor on clickable menu */
.metismenu .has-arrow {
    cursor: pointer;
}
</style>

<script>
$(document).ready(function(){
    $('.metismenu .has-arrow').on('click', function(e){
        e.preventDefault();
        let $this = $(this);

        // Close other open submenus
        $('.metismenu .has-arrow').not($this).removeClass('active').next('ul').slideUp();

        // Toggle current submenu
        $this.toggleClass('active');
        $this.next('ul').slideToggle(200);
    });
});
</script>
