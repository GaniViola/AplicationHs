@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Hubungi Kami</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Halaman</a></li>
            <li class="breadcrumb-item active text-primary">Kontak</li>
        </ol>    
    </div>
</div>

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
