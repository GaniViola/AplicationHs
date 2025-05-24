<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('images/logohitam.png') }}" type="image/x-icon">
    <title>@yield('title', 'Home Service')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('stocker-1.0.0/lib/animate/animate.min.css') }}" />
    <link href="{{ asset('stocker-1.0.0/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('stocker-1.0.0/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('stocker-1.0.0/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('stocker-1.0.0/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Include Topbar -->
    @include('partials.topbar')

    <!-- Include Navbar -->
    @include('partials.navbar')

    <!-- Content Section -->
    @yield('content')

    <!-- Include Footer -->
    @include('partials.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('stocker-1.0.0/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('stocker-1.0.0/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('stocker-1.0.0/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('stocker-1.0.0/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('stocker-1.0.0/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('stocker-1.0.0/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('stocker-1.0.0/js/main.js') }}"></script>
</body>

</html>
