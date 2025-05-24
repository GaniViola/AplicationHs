<!-- Navbar Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
       <a href="{{ route('home') }}" class="navbar-brand p-0 d-flex align-items-center">
    <img src="/images/logohijau.png" alt="Logo" style="height: 40px; margin-right: 10px;">
    <span class="text-primary fw-bold" style="font-size: 1.5rem;">Home Service</span>
    </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'about' ? 'active' : '' }}">About</a>
                <a href="{{ route('service') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'service' ? 'active' : '' }}">Services</a>
                <a href="{{ route('blog') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'blog' ? 'active' : '' }}">Blogs</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown">
                        <span class="dropdown-toggle">Pages</span>
                    </a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('feature') }}" class="dropdown-item">Our Features</a>
                        <a href="{{ route('team') }}" class="dropdown-item">Our team</a>
                        <a href="{{ route('testimonial') }}" class="dropdown-item">Testimonial</a>
                        <a href="{{ route('offer') }}" class="dropdown-item">Our offer</a>
                        <a href="{{ route('faq') }}" class="dropdown-item">FAQs</a>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">Contact Us</a>
    </nav>
</div>
<!-- Navbar End -->