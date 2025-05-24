@extends('layouts.app')

@section('content')
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Tentang Kami</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Halaman</a></li>
            <li class="breadcrumb-item active text-primary">Tentang</li>
        </ol>    
    </div>
</div>

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
@endsection
