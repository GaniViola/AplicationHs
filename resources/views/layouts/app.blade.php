<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <!-- Bootstrap CSS -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <title>Home Service</title>

  <!-- Custom Styling -->
  <style>
    /* Preloader Styles */
    #preloader {
        position: fixed;
        background-color: white;
        width: 100vw;
        height: 100vh;
        top: 0;
        left: 0;
        z-index: 99999;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: opacity 0.5s ease;
    }

    #preloader img {
        width: 120px;
        margin-bottom: 20px;
    }

    #loading-text {
        font-family: 'Nunito', sans-serif;
        font-size: 20px;
        color: #333;
        letter-spacing: 1px;
    }

    body.loaded #preloader {
        opacity: 0;
        visibility: hidden;
    }
  </style>

</head>

<body>

  <!-- Preloader -->
  <div id="preloader">
      <img src="{{ asset('images/logo.png') }}" alt="Logo">
      <div id="loading-text">Loading<span id="dots"></span></div>
  </div>

  <!-- Start Header/Navigation -->
  @include('partials.navbar')
  <!-- End Header/Navigation -->

  @yield('content')

  @include('partials.footer')

  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/tiny-slider.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>

  <!-- Preloader Script -->
  <script>
    // Hilangkan preloader setelah halaman dimuat
    window.addEventListener('load', function () {
        document.body.classList.add('loaded');
    });

    // Animasi titik-titik di teks loading
    document.addEventListener('DOMContentLoaded', function () {
        const dots = document.getElementById('dots');
        let count = 0;
        setInterval(() => {
            count = (count + 1) % 4; // 0 to 3
            dots.textContent = '.'.repeat(count);
        }, 500);
    });
  </script>

</body>
</html>
