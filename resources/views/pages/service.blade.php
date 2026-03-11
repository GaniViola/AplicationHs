@extends('layouts.app')

@section('content')

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Layanan Kami</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Halaman</a></li>
            <li class="breadcrumb-item active text-primary">Layanan</li>
        </ol>    
    </div>
</div>
<!-- Header End -->

<!-- Services Start -->
<div class="container-fluid service pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Layanan Kami</h4>
            <h1 class="display-5 mb-4">Kami Hadir untuk Membantu Rumah Anda</h1>
            <p class="mb-0">Dari perbaikan rumah hingga layanan kebersihan profesional, kami menyediakan berbagai solusi untuk menjaga kenyamanan dan keamanan tempat tinggal Anda.</p>
        </div>
        <div class="row g-4">
            @php
                $services = [
                    ['img' => 'service-1.jpg', 'title' => 'Perbaikan Listrik', 'desc' => 'Layanan teknisi listrik profesional untuk instalasi, perbaikan, dan pengecekan sistem kelistrikan rumah Anda.'],
                    ['img' => 'service-2.jpg', 'title' => 'Service AC', 'desc' => 'Pembersihan, isi freon, hingga perbaikan unit AC Anda agar selalu dingin dan hemat energi.'],
                    ['img' => 'service-3.jpg', 'title' => 'Pembersihan Rumah', 'desc' => 'Layanan kebersihan menyeluruh, dari ruangan hingga dapur dan kamar mandi dengan standar higienis tinggi.'],
                    ['img' => 'service-4.jpg', 'title' => 'Perbaikan Pipa & Plumbing', 'desc' => 'Atasi kebocoran, saluran mampet, dan instalasi pipa baru dengan cepat dan tepat.'],
                    ['img' => 'service-5.jpg', 'title' => 'Perawatan Taman', 'desc' => 'Jasa perawatan taman, pemangkasan tanaman, dan desain taman minimalis untuk kenyamanan luar ruangan Anda.'],
                    ['img' => 'service-6.jpg', 'title' => 'Jasa Bongkar-Pasang', 'desc' => 'Layanan bongkar-pasang perabot, TV, rak, dan instalasi perlengkapan rumah lainnya oleh teknisi berpengalaman.'],
                ];
            @endphp

            @foreach ($services as $index => $service)
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ 0.2 + ($index % 3) * 0.2 }}s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('stocker-1.0.0/img/' . $service['img']) }}" class="img-fluid rounded-top w-100" alt="{{ $service['title'] }}">
                        </div>
                        <div class="rounded-bottom p-4">
                            <a href="#" class="h4 d-inline-block mb-4">{{ $service['title'] }}</a>
                            <p class="mb-4">{{ $service['desc'] }}</p>
                            <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Services End -->

@endsection
