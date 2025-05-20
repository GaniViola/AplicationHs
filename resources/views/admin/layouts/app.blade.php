<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="{{ asset('images/logohitam.png') }}" type="image/x-icon">

    <title>Home Service - {{ $title }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom Styling -->
    <style>
        .badge.bg-warning,
        .badge.bg-info,
        .badge.bg-primary,
        .badge.bg-secondary,
        .badge.bg-success {
            color: white !important;
        }

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

<body id="page-top">

    <!-- Preloader -->
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <div id="loading-text">Loading<span id="dots"></span></div>
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Home Service 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap JS (wajib untuk modal bisa close) -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>

    <!-- Preloader Script -->
    <script>
        // Hilangkan preloader setelah halaman dimuat
        window.addEventListener('load', function () {
            document.body.classList.add('loaded');
        });

        // Tampilkan preloader saat klik link internal
        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('a:not([target="_blank"]):not([href^="#"]):not([data-bs-toggle])');
            links.forEach(link => {
                link.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    const isSamePage = href === window.location.href || href === '#';
                    if (!isSamePage && href && !href.startsWith('javascript')) {
                        document.body.classList.remove('loaded');
                        document.getElementById('preloader').style.visibility = 'visible';
                        document.getElementById('preloader').style.opacity = '1';
                    }
                });
            });

            // Animasi titik-titik di teks loading
            const dots = document.getElementById('dots');
            let count = 0;
            setInterval(() => {
                count = (count + 1) % 4;
                dots.textContent = '.'.repeat(count);
            }, 500);
        });
    </script>

    <script>
        // Toggle untuk Password
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('inputPassword4');
            const icon = this;

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';  // Ubah ke text
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';  // Kembali ke password
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    
        // Toggle untuk Confirm Password
        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const icon = this;
    
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';  // Ubah ke text
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                confirmPasswordInput.type = 'password';  // Kembali ke password
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    </script>

</body>

</html>
