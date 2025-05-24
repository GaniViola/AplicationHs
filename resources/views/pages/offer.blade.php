@extends('layouts.app')

@section('content')
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Penawaran Kami</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Halaman</a></li>
            <li class="breadcrumb-item active text-primary">Penawaran</li>
        </ol>    
    </div>
</div>

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
@endsection
