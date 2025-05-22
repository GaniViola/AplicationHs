@extends('layouts.app')

@section('content')
<!-- Carousel Start -->
<div class="header-carousel owl-carousel">
    <div class="header-carousel-item">
        <img src="{{ asset('stocker-1.0.0/img/carousel-1.jpg') }}" class="img-fluid w-100" alt="Image">
        <div class="carousel-caption">
            <div class="container">
                <div class="row gy-0 gx-5">
                    <div class="col-lg-0 col-xl-5"></div>
                    <div class="col-xl-7 animated fadeInLeft">
                        <div class="text-sm-center text-md-end">
                            <h4 class="text-primary text-uppercase fw-bold mb-4">Selamat Datang di Home Service</h4>
                            <h1 class="display-4 text-uppercase text-white mb-4">Layanan Rumah Terpercaya dan Cepat</h1>
                            <p class="mb-5 fs-5">Kami menyediakan berbagai layanan rumah seperti perbaikan, pembersihan, dan instalasi, langsung ke rumah Anda dengan mudah dan profesional.</p>
                            <div class="d-flex justify-content-center justify-content-md-end flex-shrink-0 mb-4">
                                <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="#"><i class="fas fa-play-circle me-2"></i> Lihat Video</a>
                                <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2" href="#">Pelajari Lebih Lanjut</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                                <h2 class="text-white me-2">Ikuti Kami:</h2>
                                <div class="d-flex justify-content-end ms-2">
                                    <a class="btn btn-md-square btn-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle mx-2" href="https://www.tiktok.com/@username" target="_blank">
                                    <i class="fab fa-tiktok"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-carousel-item">
        <img src="{{ asset('stocker-1.0.0/img/carousel-2.jpg') }}" class="img-fluid w-100" alt="Image">
        <div class="carousel-caption">
            <div class="container">
                <div class="row g-5">
                    <div class="col-12 animated fadeInUp">
                        <div class="text-center">
                            <h4 class="text-primary text-uppercase fw-bold mb-4">Selamat Datang di Home Service</h4>
                            <h1 class="display-4 text-uppercase text-white mb-4">Solusi Rumah Anda Dalam Satu Tempat</h1>
                            <p class="mb-5 fs-5">Dari AC hingga perbaikan listrik, layanan kami hadir untuk memastikan rumah Anda selalu dalam kondisi terbaik, kapan pun Anda butuhkan.</p>
                            <div class="d-flex justify-content-center flex-shrink-0 mb-4">
                                <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="#"><i class="fas fa-play-circle me-2"></i> Lihat Video</a>
                                <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2" href="#">Pelajari Lebih Lanjut</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <h2 class="text-white me-2">Ikuti Kami:</h2>
                                <div class="d-flex justify-content-end ms-2">
                                    <a class="btn btn-md-square btn-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-md-square btn-light rounded-circle ms-2" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

<!-- About Start -->
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.2s">
                <div>
                    <h4 class="text-primary">Tentang Kami</h4>
                    <h1 class="display-5 mb-4">Solusi Layanan Rumah Profesional & Terpercaya</h1>
                    <p class="mb-4">Kami adalah penyedia layanan home service yang berdedikasi untuk memudahkan hidup Anda. Mulai dari perbaikan listrik, plumbing, hingga pembersihan rumah, tim kami siap membantu Anda dengan kualitas terbaik.</p>
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="d-flex">
                                <div><i class="fas fa-tools fa-3x text-primary"></i></div>
                                <div class="ms-4">
                                    <h4>Layanan Komplit</h4>
                                    <p>Dari AC hingga keran bocor, kami tangani semuanya dengan cepat dan efisien.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="d-flex">
                                <div><i class="bi bi-award-fill fa-3x text-primary"></i></div>
                                <div class="ms-4">
                                    <h4>Berpengalaman</h4>
                                    <p>Tim kami berpengalaman bertahun-tahun di bidang perawatan dan perbaikan rumah.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <a href="#" class="btn btn-primary rounded-pill py-3 px-5 flex-shrink-0">Lihat Layanan</a>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex">
                                <i class="fas fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Hubungi Kami</h4>
                                    <p class="mb-0 fs-5" style="letter-spacing: 1px;">+01234567890</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 wow fadeInRight" data-wow-delay="0.2s">
                <div class="bg-primary rounded position-relative overflow-hidden">
                    <img src="stocker-1.0.0/img/about-2.png" class="img-fluid rounded w-100" alt="">
                    <div style="position: absolute; top: -15px; right: -15px;">
                        <img src="stocker-1.0.0/img/about-3.png" class="img-fluid" style="width: 150px; height: 150px; opacity: 0.7;" alt="">
                    </div>
                    <div style="position: absolute; top: -20px; left: 10px; transform: rotate(90deg);">
                        <img src="stocker-1.0.0/img/about-4.png" class="img-fluid" style="width: 100px; height: 150px; opacity: 0.9;" alt="">
                    </div>
                    <div class="rounded-bottom">
                        <img src="stocker-1.0.0/img/about-5.jpg" class="img-fluid rounded-bottom w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
<!-- Services Start -->
<div class="container-fluid service pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Layanan Kami</h4>
            <h1 class="display-5 mb-4">Kami Hadir untuk Membantu Rumah Anda</h1>
            <p class="mb-0">Dari perbaikan rumah hingga layanan kebersihan profesional, kami menyediakan berbagai solusi untuk menjaga kenyamanan dan keamanan tempat tinggal Anda.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="service-item">
                    <div class="service-img">
                        <img src="stocker-1.0.0/img/service-1.jpg" class="img-fluid rounded-top w-100" alt="Image">
                    </div>
                    <div class="rounded-bottom p-4">
                        <a href="#" class="h4 d-inline-block mb-4">Perbaikan Listrik</a>
                        <p class="mb-4">Layanan teknisi listrik profesional untuk instalasi, perbaikan, dan pengecekan sistem kelistrikan rumah Anda.</p>
                        <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.4s">
                <div class="service-item">
                    <div class="service-img">
                        <img src="stocker-1.0.0/img/service-2.jpg" class="img-fluid rounded-top w-100" alt="Image">
                    </div>
                    <div class="rounded-bottom p-4">
                        <a href="#" class="h4 d-inline-block mb-4">Service AC</a>
                        <p class="mb-4">Pembersihan, isi freon, hingga perbaikan unit AC Anda agar selalu dingin dan hemat energi.</p>
                        <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.6s">
                <div class="service-item">
                    <div class="service-img">
                        <img src="stocker-1.0.0/img/service-3.jpg" class="img-fluid rounded-top w-100" alt="Image">
                    </div>
                    <div class="rounded-bottom p-4">
                        <a href="#" class="h4 d-inline-block mb-4">Pembersihan Rumah</a>
                        <p class="mb-4">Layanan kebersihan menyeluruh, dari ruangan hingga dapur dan kamar mandi dengan standar higienis tinggi.</p>
                        <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="service-item">
                    <div class="service-img">
                        <img src="stocker-1.0.0/img/service-4.jpg" class="img-fluid rounded-top w-100" alt="Image">
                    </div>
                    <div class="rounded-bottom p-4">
                        <a href="#" class="h4 d-inline-block mb-4">Perbaikan Pipa & Plumbing</a>
                        <p class="mb-4">Atasi kebocoran, saluran mampet, dan instalasi pipa baru dengan cepat dan tepat.</p>
                        <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.4s">
                <div class="service-item">
                    <div class="service-img">
                        <img src="stocker-1.0.0/img/service-5.jpg" class="img-fluid rounded-top w-100" alt="Image">
                    </div>
                    <div class="rounded-bottom p-4">
                        <a href="#" class="h4 d-inline-block mb-4">Perawatan Taman</a>
                        <p class="mb-4">Jasa perawatan taman, pemangkasan tanaman, dan desain taman minimalis untuk kenyamanan luar ruangan Anda.</p>
                        <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.6s">
                <div class="service-item">
                    <div class="service-img">
                        <img src="stocker-1.0.0/img/service-6.jpg" class="img-fluid rounded-top w-100" alt="Image">
                    </div>
                    <div class="rounded-bottom p-4">
                        <a href="#" class="h4 d-inline-block mb-4">Jasa Bongkar-Pasang</a>
                        <p class="mb-4">Layanan bongkar-pasang perabot, TV, rak, dan instalasi perlengkapan rumah lainnya oleh teknisi berpengalaman.</p>
                        <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->
<!-- Blog Start -->
<div class="container-fluid blog pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Blog & Tips</h4>
            <h1 class="display-5 mb-4">Artikel Seputar Layanan Rumah Tangga</h1>
            <p class="mb-0">Temukan berbagai tips, panduan, dan inspirasi seputar perawatan rumah, perbaikan, kebersihan, dan layanan jasa lainnya untuk menjadikan rumah Anda lebih nyaman dan aman.</p>
        </div>

        <div class="owl-carousel blog-carousel wow fadeInUp" data-wow-delay="0.2s">
            <div class="blog-item p-4">
                <div class="blog-img mb-4">
                    <img src="stocker-1.0.0/img/service-1.jpg" class="img-fluid w-100 rounded" alt="">
                    <div class="blog-title">
                        <a href="#" class="btn">Perawatan AC</a>
                    </div>
                </div>
                <a href="#" class="h4 d-inline-block mb-3">Tips Merawat AC Agar Awet dan Hemat Energi</a>
                <p class="mb-4">Pelajari cara sederhana untuk menjaga performa AC di rumah Anda agar tetap dingin dan hemat listrik.</p>
                <div class="d-flex align-items-center">
                    <img src="stocker-1.0.0/img/testimonial-1.jpg" class="img-fluid rounded-circle" style="width: 60px; height: 60px;" alt="">
                    <div class="ms-3">
                        <h5>Admin</h5>
                        <p class="mb-0">9 Oktober 2025</p>
                    </div>
                </div>
            </div>

            <div class="blog-item p-4">
                <div class="blog-img mb-4">
                    <img src="stocker-1.0.0/img/service-2.jpg" class="img-fluid w-100 rounded" alt="">
                    <div class="blog-title">
                        <a href="#" class="btn">Pembersihan Rumah</a>
                    </div>
                </div>
                <a href="#" class="h4 d-inline-block mb-3">Rahasia Rumah Bersih Bebas Debu</a>
                <p class="mb-4">Simak panduan praktis membersihkan rumah agar bebas dari debu dan alergen, cocok untuk keluarga dengan anak-anak.</p>
                <div class="d-flex align-items-center">
                    <img src="stocker-1.0.0/img/testimonial-2.jpg" class="img-fluid rounded-circle" style="width: 60px; height: 60px;" alt="">
                    <div class="ms-3">
                        <h5>Admin</h5>
                        <p class="mb-0">9 Oktober 2025</p>
                    </div>
                </div>
            </div>

            <div class="blog-item p-4">
                <div class="blog-img mb-4">
                    <img src="stocker-1.0.0/img/service-3.jpg" class="img-fluid w-100 rounded" alt="">
                    <div class="blog-title">
                        <a href="#" class="btn">Plumbing</a>
                    </div>
                </div>
                <a href="#" class="h4 d-inline-block mb-3">Cara Mengatasi Saluran Air Mampet</a>
                <p class="mb-4">Solusi cepat dan aman untuk mengatasi masalah saluran air di rumah tanpa harus membongkar pipa.</p>
                <div class="d-flex align-items-center">
                    <img src="stocker-1.0.0/img/testimonial-3.jpg" class="img-fluid rounded-circle" style="width: 60px; height: 60px;" alt="">
                    <div class="ms-3">
                        <h5>Admin</h5>
                        <p class="mb-0">9 Oktober 2025</p>
                    </div>
                </div>
            </div>

            <div class="blog-item p-4">
                <div class="blog-img mb-4">
                    <img src="stocker-1.0.0/img/service-4.jpg" class="img-fluid w-100 rounded" alt="">
                    <div class="blog-title">
                        <a href="#" class="btn">Keamanan Rumah</a>
                    </div>
                </div>
                <a href="#" class="h4 d-inline-block mb-3">Panduan Memasang CCTV di Rumah</a>
                <p class="mb-4">Tingkatkan keamanan rumah Anda dengan memasang CCTV sendiri menggunakan panduan langkah demi langkah ini.</p>
                <div class="d-flex align-items-center">
                    <img src="stocker-1.0.0/img/testimonial-1.jpg" class="img-fluid rounded-circle" style="width: 60px; height: 60px;" alt="">
                    <div class="ms-3">
                        <h5>Admin</h5>
                        <p class="mb-0">9 Oktober 2025</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->
<!-- Features Start -->
<div class="container-fluid feature pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Fitur Layanan Kami</h4>
            <h1 class="display-5 mb-4">Menyambungkan Anda dengan Solusi Rumah Terbaik</h1>
            <p class="mb-0">Kami menyediakan berbagai layanan rumah tangga profesional yang dirancang untuk membuat hidup Anda lebih nyaman dan bebas repot.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-tools fa-4x text-primary"></i>
                    </div>
                    <h4>Layanan Perbaikan</h4>
                    <p class="mb-4">Teknisi handal untuk segala jenis perbaikan rumah, mulai dari listrik hingga plumbing.</p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-broom fa-4x text-primary"></i>
                    </div>
                    <h4>Kebersihan Rumah</h4>
                    <p class="mb-4">Jasa cleaning profesional untuk kebersihan menyeluruh rumah Anda.</p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-snowflake fa-4x text-primary"></i>
                    </div>
                    <h4>Servis AC & Elektronik</h4>
                    <p class="mb-4">Perawatan dan perbaikan AC, mesin cuci, kulkas, dan perangkat elektronik lainnya.</p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-user-shield fa-4x text-primary"></i>
                    </div>
                    <h4>Layanan Keamanan</h4>
                    <p class="mb-4">Instalasi dan pemeliharaan sistem keamanan seperti CCTV dan alarm rumah.</p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features End -->
<!-- Team Start -->
<div class="container-fluid team pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Tim Profesional</h4>
            <h1 class="display-5 mb-4">Kenalan dengan Ahli Layanan Rumah Kami</h1>
            <p class="mb-0">Kami memiliki tim yang berdedikasi untuk memberikan pelayanan rumah tangga terbaik dengan profesionalisme dan keahlian di bidangnya.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="stocker-1.0.0/img/team-1.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">Gani Prasetyo</h4>
                        <p class="mb-0">Teknisi Listrik</p>
                    </div>
                    <div class="team-icon">
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-tiktok"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="stocker-1.0.0/img/team-2.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">Farhan Maulana</h4>
                        <p class="mb-0">Ahli Kebersihan</p>
                    </div>
                    <div class="team-icon">
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-tiktok"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="stocker-1.0.0/img/team-3.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">Alex Rohmatullah</h4>
                        <p class="mb-0">Teknisi AC</p>
                    </div>
                    <div class="team-icon">
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-tiktok"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="stocker-1.0.0/img/team-4.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">Wahyu Ananda</h4>
                        <p class="mb-0">Customer Support</p>
                    </div>
                    <div class="team-icon">
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-tiktok"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->
<!-- Testimonial Start -->
<div class="container-fluid testimonial pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Apa Kata Mereka</h4>
            <h1 class="display-5 mb-4">Ulasan Pelanggan Kami</h1>
            <p class="mb-0">Kami berkomitmen untuk memberikan layanan terbaik bagi pelanggan kami. Berikut adalah beberapa ulasan dari mereka yang telah merasakan manfaat dari layanan kami.</p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.2s">
            <div class="testimonial-item">
                <div class="testimonial-quote-left">
                    <i class="fas fa-quote-left fa-2x"></i>
                </div>
                <div class="testimonial-img">
                    <img src="stocker-1.0.0/img/testimonial-1.jpg" class="img-fluid" alt="Image">
                </div>
                <div class="testimonial-text">
                    <p class="mb-0">Pelayanan sangat cepat dan teknisi AC-nya profesional. Sekarang rumah saya jauh lebih nyaman. Terima kasih!</p>
                </div>
                <div class="testimonial-title">
                    <div>
                        <h4 class="mb-0">Lina Kurniawati</h4>
                        <p class="mb-0">Ibu Rumah Tangga</p>
                    </div>
                    <div class="d-flex text-primary">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-quote-right">
                    <i class="fas fa-quote-right fa-2x"></i>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-quote-left">
                    <i class="fas fa-quote-left fa-2x"></i>
                </div>
                <div class="testimonial-img">
                    <img src="stocker-1.0.0/img/testimonial-2.jpg" class="img-fluid" alt="Image">
                </div>
                <div class="testimonial-text">
                    <p class="mb-0">Saya memesan jasa pembersihan rumah, hasilnya luar biasa bersih dan rapi. Layanan yang sangat direkomendasikan!</p>
                </div>
                <div class="testimonial-title">
                    <div>
                        <h4 class="mb-0">Fajar Ramadhan</h4>
                        <p class="mb-0">Karyawan Swasta</p>
                    </div>
                    <div class="d-flex text-primary">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                <div class="testimonial-quote-right">
                    <i class="fas fa-quote-right fa-2x"></i>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-quote-left">
                    <i class="fas fa-quote-left fa-2x"></i>
                </div>
                <div class="testimonial-img">
                    <img src="stocker-1.0.0/img/testimonial-3.jpg" class="img-fluid" alt="Image">
                </div>
                <div class="testimonial-text">
                    <p class="mb-0">Teknisi listrik datang tepat waktu dan menyelesaikan masalah dengan cepat. Harga juga transparan. Sangat puas!</p>
                </div>
                <div class="testimonial-title">
                    <div>
                        <h4 class="mb-0">Dedi Mulyana</h4>
                        <p class="mb-0">Wirausaha</p>
                    </div>
                    <div class="d-flex text-primary">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-quote-right">
                    <i class="fas fa-quote-right fa-2x"></i>
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-quote-left">
                    <i class="fas fa-quote-left fa-2x"></i>
                </div>
                <div class="testimonial-img">
                    <img src="stocker-1.0.0/img/testimonial-2.jpg" class="img-fluid" alt="Image">
                </div>
                <div class="testimonial-text">
                    <p class="mb-0">Saya senang dengan kemudahan pemesanan layanan secara online. Customer service juga responsif.</p>
                </div>
                <div class="testimonial-title">
                    <div>
                        <h4 class="mb-0">Nurul Aini</h4>
                        <p class="mb-0">Guru</p>
                    </div>
                    <div class="d-flex text-primary">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                <div class="testimonial-quote-right">
                    <i class="fas fa-quote-right fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
<!-- Offer Start -->
<div class="container-fluid offer-section pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Penawaran Spesial</h4>
            <h1 class="display-5 mb-4">Manfaat Layanan Kami</h1>
            <p class="mb-0">Kami memberikan berbagai layanan perawatan rumah terbaik yang cepat, andal, dan terjangkau. Berikut beberapa layanan unggulan kami yang bisa Anda manfaatkan.</p>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="nav nav-pills bg-light rounded p-5">
                    <a class="accordion-link p-4 active mb-4" data-bs-toggle="pill" href="#collapseOne">
                        <h5 class="mb-0">Perawatan & Servis AC Profesional</h5>
                    </a>
                    <a class="accordion-link p-4 mb-4" data-bs-toggle="pill" href="#collapseTwo">
                        <h5 class="mb-0">Layanan Kebersihan Rumah & Apartemen</h5>
                    </a>
                    <a class="accordion-link p-4 mb-4" data-bs-toggle="pill" href="#collapseThree">
                        <h5 class="mb-0">Perbaikan Instalasi Listrik & Darurat</h5>
                    </a>
                    <a class="accordion-link p-4 mb-0" data-bs-toggle="pill" href="#collapseFour">
                        <h5 class="mb-0">Pemasangan Peralatan Rumah Tangga</h5>
                    </a>
                </div>
            </div>
            <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.4s">
                <div class="tab-content">
                    <div id="collapseOne" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-md-7">
                                <img src="stocker-1.0.0/img/offer-1.jpg" class="img-fluid w-100 rounded" alt="">
                            </div>
                            <div class="col-md-5">
                                <h1 class="display-5 mb-4">Servis AC Cepat & Terpercaya</h1>
                                <p class="mb-4">Teknisi kami berpengalaman dalam menangani berbagai merk AC dengan cepat dan efisien. Kami menjamin kenyamanan udara sejuk di rumah Anda.</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>
                    <div id="collapseTwo" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-7">
                                <img src="stocker-1.0.0/img/offer-2.jpg" class="img-fluid w-100 rounded" alt="">
                            </div>
                            <div class="col-md-5">
                                <h1 class="display-5 mb-4">Rumah Bersih & Nyaman</h1>
                                <p class="mb-4">Kami menyediakan layanan kebersihan menyeluruh untuk rumah dan apartemen Anda. Staf kami menggunakan produk ramah lingkungan untuk hasil maksimal.</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>
                    <div id="collapseThree" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-7">
                                <img src="stocker-1.0.0/img/offer-3.jpg" class="img-fluid w-100 rounded" alt="">
                            </div>
                            <div class="col-md-5">
                                <h1 class="display-5 mb-4">Layanan Listrik 24 Jam</h1>
                                <p class="mb-4">Butuh perbaikan listrik mendadak? Tim kami siap membantu Anda kapan saja, dengan peralatan dan keahlian terbaik.</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>
                    <div id="collapseFour" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-7">
                                <img src="stocker-1.0.0/img/offer-4.jpg" class="img-fluid w-100 rounded" alt="">
                            </div>
                            <div class="col-md-5">
                                <h1 class="display-5 mb-4">Instalasi Mudah & Aman</h1>
                                <p class="mb-4">Kami bantu pasang water heater, mesin cuci, TV dinding, dan lainnya tanpa ribet. Semua dilakukan oleh teknisi profesional dan berpengalaman.</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->
<!-- FAQs Start -->
<div class="container-fluid faq-section pb-5">
    <div class="container pb-5 overflow-hidden">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">FAQ</h4>
            <h1 class="display-5 mb-4">Pertanyaan yang Sering Diajukan</h1>
            <p class="mb-0">Berikut adalah beberapa pertanyaan umum dari pelanggan kami terkait layanan servis rumah seperti AC, listrik, dan lainnya.</p>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="accordion accordion-flush bg-light rounded p-5" id="accordionFlushSection">
                    <div class="accordion-item rounded-top">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Bagaimana cara memesan layanan servis?
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                Anda bisa memesan layanan melalui website kami dengan memilih jenis layanan, tanggal, dan jam yang diinginkan. Kami juga melayani pemesanan melalui WhatsApp.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Apakah teknisi tersedia di hari libur?
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                Ya, teknisi kami tersedia setiap hari termasuk akhir pekan dan hari libur nasional dengan jadwal yang telah disesuaikan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Apakah ada garansi untuk layanan servis?
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                Kami memberikan garansi selama 7 hari setelah servis selesai untuk memastikan kualitas layanan kami.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                Layanan apa saja yang tersedia?
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                Kami menyediakan layanan servis AC, perbaikan listrik, kebersihan rumah, pemasangan alat rumah tangga, dan lainnya.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                Bagaimana saya mengetahui biaya servis?
                            </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                Estimasi harga akan ditampilkan saat pemesanan layanan. Harga final akan diinformasikan oleh teknisi setelah survei awal jika dibutuhkan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item rounded-bottom">
                        <h2 class="accordion-header" id="flush-headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                Apakah bisa membayar secara online?
                            </button>
                        </h2>
                        <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                Tentu, kami menerima pembayaran melalui transfer bank, e-wallet seperti OVO dan GoPay, serta pembayaran tunai di tempat.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                <div class="bg-primary rounded">
                    <img src="stocker-1.0.0/img/about-2.png" class="img-fluid w-100" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FAQs End -->
<!-- Contact Start -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Contact Info -->
            <div class="col-xl-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <div class="bg-light rounded p-5 mb-5">
                        <h4 class="text-primary mb-4">Informasi Kontak</h4>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="contact-add-item">
                                    <div class="contact-icon text-primary mb-4">
                                        <i class="fas fa-map-marker-alt fa-2x"></i>
                                    </div>
                                    <div>
                                        <h4>Alamat</h4>
                                        <p class="mb-0">Jl. Raya Situbondo,
                                            Blindungan, Kec. Bondowoso, Kabupaten Bondowoso, Jawa Timur 68211</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-add-item">
                                    <div class="contact-icon text-primary mb-4">
                                        <i class="fas fa-envelope fa-2x"></i>
                                    </div>
                                    <div>
                                        <h4>Email</h4>
                                        <p class="mb-0">cs@homeservice.id</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-add-item">
                                    <div class="contact-icon text-primary mb-4">
                                        <i class="fa fa-phone-alt fa-2x"></i>
                                    </div>
                                    <div>
                                        <h4>Telepon</h4>
                                        <p class="mb-0">(+62) 812-3456-7890</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-add-item">
                                    <div class="contact-icon text-primary mb-4">
                                        <i class="fab fa-whatsapp fa-2x"></i>
                                    </div>
                                    <div>
                                        <h4>WhatsApp</h4>
                                        <p class="mb-0">(+62) 812-3456-7890</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-light p-5 rounded h-100 wow fadeInUp" data-wow-delay="0.2s">
                        <h4 class="text-primary">Kirim Pesan Anda</h4>
                        <p class="mb-4">Ada pertanyaan atau ingin konsultasi servis? Kirimkan pesan Anda melalui formulir di bawah ini dan tim kami akan segera menghubungi Anda.</p>
                        <form action="#" method="POST">
                            <div class="row g-4">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="name" placeholder="Nama Anda">
                                        <label for="name">Nama Anda</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control border-0" id="email" placeholder="Email Anda">
                                        <label for="email">Email Anda</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="phone" placeholder="Telepon">
                                        <label for="phone">Telepon</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="layanan" placeholder="Jenis Layanan">
                                        <label for="layanan">Jenis Layanan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="subject" placeholder="Subjek">
                                        <label for="subject">Subjek</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control border-0" placeholder="Pesan" id="message" style="height: 160px"></textarea>
                                        <label for="message">Pesan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Google Maps -->
            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                <div class="rounded h-100">
                    <iframe class="rounded h-100 w-100" style="height: 400px;"
                         src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.8290681236867!2d113.82659647432446!3d-7.912917578759558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6dcc189532a17%3A0x9d3e7d37667ab0e1!2sPoliteknik%20Negeri%20Jember%20Kampus%20Bondowoso!5e0!3m2!1sid!2sid!4v1747875042999!5m2!1sid!2sid"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection
