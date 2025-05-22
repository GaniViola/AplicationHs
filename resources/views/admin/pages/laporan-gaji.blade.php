@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <h1 class="fw-bold text-success mb-0">{{ $title }}</h1>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0">
            <div class="badge bg-success rounded-pill px-3 py-2 shadow-sm">
                <i class="far fa-calendar-alt me-2"></i>
                {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card border-0 shadow-sm rounded-3 mb-4 overflow-hidden">
        <div class="card-header bg-white border-bottom border-light py-3">
            <h5 class="mb-0">
                <i class="fas fa-filter text-success me-2"></i>
                Filter Data Gaji
            </h5>
        </div>
        <div class="card-body bg-light py-4">
            <form method="GET" action="{{ route('admin.gaji.index') }}" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small text-muted fw-bold">Dari Tanggal</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-calendar-alt text-success"></i>
                        </span>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="form-control border-start-0 ps-0 shadow-none">
                    </div>
                </div>
                <div class="col-md-5">
                    <label class="form-label small text-muted fw-bold">Sampai Tanggal</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-calendar-alt text-success"></i>
                        </span>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="form-control border-start-0 ps-0 shadow-none">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-search me-2"></i>
                        <span>Tampilkan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Gaji Card -->
    <div class="card border-0 shadow rounded-3 overflow-hidden mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3 bg-white border-bottom">
            <h5 class="mb-0 text-success">
                <i class="fas fa-money-bill-wave me-2"></i>
                Data Gaji Pekerja
            </h5>
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-success" title="Export Excel">
                    <i class="fas fa-file-excel me-1"></i> Excel
                </button>
                <button type="button" class="btn btn-sm btn-outline-success" title="Print">
                    <i class="fas fa-print me-1"></i> Print
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="gajiTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" width="5%">#</th>
                            <th>Nama Pekerja</th>
                            <th class="text-center">Jumlah Transaksi</th>
                            <th class="text-end">Total Gaji (80%)</th>
                            <th class="text-end">Rata-rata per Transaksi</th>
                            <th class="text-center">Terakhir Setor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gajiPerPekerja as $index => $gaji)
                            <tr class="row-hover">
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-success text-white me-2">
                                            {{ substr($gaji->worker->username ?? 'U', 0, 1) }}
                                        </div>
                                        <span class="fw-bold">{{ $gaji->worker->username ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill px-3 py-2">{{ $gaji->jumlah_setoran }}</span>
                                </td>
                                <td class="text-end fw-bold text-success">
                                    Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}
                                </td>
                                <td class="text-end text-secondary">
                                    Rp {{ number_format($gaji->jumlah_setoran > 0 ? $gaji->total_gaji / $gaji->jumlah_setoran : 0, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">
                                        <i class="far fa-calendar-check me-1"></i>
                                        {{ \Carbon\Carbon::parse($gaji->terakhir_setor)->format('d-m-Y') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-file-search fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Tidak ada data setoran ditemukan.</p>
                                        <button class="btn btn-sm btn-outline-success mt-2">
                                            <i class="fas fa-sync-alt me-1"></i> Refresh Data
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center py-3">
            <div class="text-muted small">
                Menampilkan {{ count($gajiPerPekerja) }} pekerja
            </div>
            <div class="pagination-sm">
                <!-- Pagination akan ditambahkan jika diperlukan -->
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .row-hover:hover {
        background-color: rgba(13, 110, 253, 0.05);
        transition: all 0.2s;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem;
    }

    #gajiTable {
        border-collapse: separate;
        border-spacing: 0;
    }

    #gajiTable th {
        font-weight: 600;
        border-top: 0;
    }

    .card {
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-2px);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi table sorting jika diperlukan
    if (typeof sortTable === 'function') {
        sortTable('gajiTable');
    }

    // Efek highlight pada baris yang baru diklik
    const rows = document.querySelectorAll('.row-hover');
    rows.forEach(row => {
        row.addEventListener('click', function() {
            rows.forEach(r => r.classList.remove('bg-light'));
            this.classList.add('bg-light');
        });
    });
});
</script>
@endsection
