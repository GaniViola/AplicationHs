@extends('layouts.app')

@section('content')
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Blog Kami</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Halaman</a></li>
            <li class="breadcrumb-item active text-primary">Blog</li>
        </ol>    
    </div>
</div>

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
@endsection
