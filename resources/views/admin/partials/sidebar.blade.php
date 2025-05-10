<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Kode HTML yang Ditingkatkan -->
<a class="sidebar-brand" href="index.html">
    <div class="brand-container">
        <div class="brand-logo">
            <img src="/images/logopolosputih.png" alt="HomeService Logo">
        </div>
        <div class="brand-text">
            <span class="brand-name">HOMESERVICE</span>
            <span class="brand-subtitle">ADMIN PANEL</span>
        </div>
    </div>
</a>

<!-- CSS yang Ditingkatkan -->
<style>
.sidebar-brand {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0.8rem 0.5rem;
    text-decoration: none;
    transition: all 0.3s ease;
    width: 100%;
    background-color: #4e73df;
    overflow: visible;
    box-sizing: border-box;
}

.brand-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    width: 100%;
    max-width: 100%;
}

.brand-logo {
    margin-right: 0.25rem;
    display: flex;
    align-items: center;
    flex-shrink: 0;
}

.brand-logo img {
    height: 35px;
    width: auto;
    /* Menghilangkan background putih pada gambar */
    filter: drop-shadow(0 0 3px rgba(0, 0, 0, 0.25));
}

.brand-text {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    white-space: nowrap;
    overflow: hidden;
    flex-grow: 1;
    max-width: calc(100% - 40px);
}

.brand-name {
    color: #ffffff;
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);
    font-family: 'Montserrat', sans-serif;
    line-height: 1.2;
    width: 100%;
    text-overflow: ellipsis;
    overflow: hidden;
}

.brand-subtitle {
    color: #e0e0e0;
    font-size: 9px;
    font-weight: 400;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    width: 100%;
    text-overflow: ellipsis;
    overflow: hidden;
}

/* Efek hover */
.sidebar-brand:hover .brand-name {
    color: #fdfdfd;
    background: linear-gradient(90deg, #ffffff, #e0e0e0);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
}

.sidebar-brand:hover .brand-subtitle {
    color: #ffffff;
}

.sidebar-brand:hover .brand-logo img {
    transform: scale(1.05);
    filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.4));
}

/* Font import - hanya gunakan jika diperlukan */
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap');
</style>
    
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        <i class="fas fa-tasks mr-2"></i>Manajemen Layanan
    </div>

    <!-- Nav Item - Pesanan Masuk -->
    <li class="nav-item">
        <a class="nav-link" href="/orders">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Pesanan Masuk</span>
        </a>
    </li>

    <!-- Nav Item - Kategori Layanan -->
    <li class="nav-item">
        <a class="nav-link" href="/categories">
            <i class="fas fa-fw fa-list"></i>
            <span>Kategori Layanan</span>
        </a>
    </li>

    <!-- Nav Item - Jenis Layanan -->
    <li class="nav-item">
        <a class="nav-link" href="/services">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Jenis Layanan</span>
        </a>
    </li>

    <!-- Nav Item - Harga & Promo -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.setoran.index') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>Setoran</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        <i class="fas fa-users mr-2"></i>Pengguna
    </div>

    <!-- Nav Item - Buat Akun Baru -->
    <li class="nav-item">
        <a class="nav-link" href="/CreateAccount">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>Buat Akun</span>
        </a>
    </li>

    <!-- Nav Item - Data Pekerja -->
    <li class="nav-item">
        <a class="nav-link" href="/UserMaster">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Data User</span>
        </a>
    </li>

    <!-- Nav Item - Data Pelanggan -->
    <li class="nav-item">
        <a class="nav-link" href="/DataCustomer">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pelanggan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        <i class="fas fa-chart-line mr-2"></i>Analisis
    </div>

    <!-- Nav Item - Laporan Pendapatan -->
    <li class="nav-item">
        <a class="nav-link" href="/laporan/pendapatan">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Laporan Pendapatan</span>
        </a>
    </li>

    <!-- Nav Item - Statistik Layanan -->
    <li class="nav-item">
        <a class="nav-link" href="/laporan/layanan">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Statistik Layanan</span>
        </a>
    </li>

    <!-- Nav Item - Kinerja Pekerja -->
    <li class="nav-item">
        <a class="nav-link" href="/laporan/kinerja">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Laporan Pekerja</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-3">
        <button class="rounded-circle border-0" id="sidebarToggle">
            <i class="fas fa-angle-left"></i>
        </button>
    </div>

    <!-- Sidebar Card - Pro Version -->
    <div class="sidebar-card d-none d-lg-flex mt-3 mb-5">
        <div class="card bg-light text-primary shadow-sm">
            <div class="card-body p-3">
                <div class="text-center">
                    <img src="https://static.vecteezy.com/system/resources/previews/004/695/389/original/flat-illustration-of-rocket-used-for-print-app-web-advertising-etc-free-vector.jpg" 
                         alt="Rocket" class="sidebar-card-illustration mb-2" style="width: 50px;">
                    <h6 class="font-weight-bold mb-1">HomeService Pro</h6>
                    <p class="small mb-2">Platform manajemen layanan rumah terpercaya</p>
                    <a href="#" class="btn btn-primary btn-sm">
                        <i class="fas fa-rocket mr-1"></i> Upgrade
                    </a>
                </div>
            </div>
        </div>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- CSS untuk meningkatkan tampilan -->
<style>
    #accordionSidebar {
        background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: all 0.3s;
        max-height: 100vh;
        overflow-y: auto;
        position: relative;
        scroll-behavior: smooth; /* Untuk scroll yang halus */
    }
    
    /* Custom scrollbar untuk sidebar */
    #accordionSidebar::-webkit-scrollbar {
        width: 5px;
    }
    
    #accordionSidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }
    
    #accordionSidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 10px;
    }
    
    #accordionSidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }
    
    .sidebar-brand {
        height: 80px;
        padding: 1.5rem 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .sidebar-brand-icon {
        background-color: white;
        color: #4e73df;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-right: 0.5rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-brand-text {
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }
    
    .sidebar-heading {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .nav-item .nav-link {
        padding: 0.8rem 1rem;
        margin: 0.2rem 0.7rem;
        border-radius: 10px;
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }
    
    .nav-item .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
    }
    
    .nav-item .nav-link:before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 3px;
        background-color: #fff;
        transform: scaleY(0);
        transition: transform 0.2s;
    }
    
    .nav-item .nav-link:hover:before {
        transform: scaleY(1);
    }
    
    .nav-item .nav-link i {
        width: 1.5rem;
        text-align: center;
        margin-right: 0.8rem;
        font-size: 0.9rem;
    }
    
    /* Stlye untuk menu aktif */
    .nav-item .nav-link.active {
        background-color: #fff;
        color: #4e73df;
        font-weight: 600;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .nav-item .nav-link.active i {
        color: #4e73df;
    }
    
    .sidebar-divider {
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        margin: 1rem 0;
    }
    
    #sidebarToggle {
        background-color: rgba(255, 255, 255, 0.2);
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        transition: all 0.2s;
    }
    
    #sidebarToggle:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }
    
    .sidebar-card {
        margin: 1rem;
        position: relative; /* Ubah dari sticky ke relative */
        z-index: 1;
    }
    
    .sidebar-card-illustration {
        transition: transform 0.2s;
    }
    
    .sidebar-card:hover .sidebar-card-illustration {
        transform: translateY(-5px);
    }
    
    .sidebar-card .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .sidebar-card .btn-outline-primary {
        border-color: #4e73df;
        color: #4e73df;
    }
    
    .sidebar-card .btn-outline-primary:hover {
        background-color: #4e73df;
        color: white;
    }
</style>

<!-- JavaScript untuk efek aktif pada menu dan mengingat posisi scroll -->
<script>
$(document).ready(function() {
    // Mendapatkan path halaman saat ini
    var path = window.location.pathname;
    
    // Menambahkan class active pada menu yang sesuai dengan halaman saat ini
    $('.nav-item .nav-link').each(function() {
        var href = $(this).attr('href');
        if (path === href || path.indexOf(href) === 0) {
            $(this).addClass('active');
        }
    });
    
    // Efek hover pada menu
    $('.nav-item').hover(
        function() {
            $(this).find('.nav-link > i').addClass('fa-beat-fade');
        },
        function() {
            $(this).find('.nav-link > i').removeClass('fa-beat-fade');
        }
    );
    
    // Menyimpan posisi scroll saat ini ke localStorage saat scrolling
    $('#accordionSidebar').on('scroll', function() {
        localStorage.setItem('sidebarScrollPos', $(this).scrollTop());
    });
    
    // Mengembalikan posisi scroll setelah halaman dimuat
    if (localStorage.getItem('sidebarScrollPos') !== null) {
        $('#accordionSidebar').scrollTop(parseInt(localStorage.getItem('sidebarScrollPos')));
    }
    
    // Efek click pada menu dengan penyimpanan posisi scroll
    $('.nav-link').click(function(e) {
        // Hapus class active dari semua link
        $('.nav-link').removeClass('active');
        
        // Tambahkan class active ke link yang diklik
        $(this).addClass('active');
        
        // Simpan posisi scroll saat ini
        localStorage.setItem('sidebarScrollPos', $('#accordionSidebar').scrollTop());
    });
    
    // Animasi saat halaman dimuat
    $('.nav-item').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateX(-20px)'
        }).delay(80 * index).animate({
            'opacity': '1',
            'transform': 'translateX(0)'
        }, 300);
    });
});
</script>