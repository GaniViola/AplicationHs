@extends('layouts.app')

@section('content')
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Testimoni</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Halaman</a></li>
            <li class="breadcrumb-item active text-primary">Testimoni</li>
        </ol>    
    </div>
</div>

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
@endsection
