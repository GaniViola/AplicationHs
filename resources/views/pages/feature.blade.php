@extends('layouts.app')

@section('content')
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Fitur Unggulan</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Halaman</a></li>
            <li class="breadcrumb-item active text-primary">Fitur</li>
        </ol>    
    </div>
</div>

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
@endsection
