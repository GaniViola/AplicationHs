@extends('admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mt-4 mb-3 fw-bold text-primary">{{ $title }}</h1>
        </div>
        <div class="col-md-4 text-end mt-4">
            <span class="badge bg-info fs-6">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</span>
        </div>
    </div>

    <!-- Filter Form Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0"><i class="fas fa-filter me-2"></i>Filter Data Gaji</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.gaji.index') }}" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label fw-bold">Dari Tanggal</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-bold">Sampai Tanggal</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>Tampilkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Gaji Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Data Gaji Pekerja</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama Pekerja</th>
                            <th class="text-center">Jumlah Transaksi</th>
                            <th class="text-end">Total Gaji (20%)</th>
                            <th class="text-end">Rata-rata per Transaksi</th>
                            <th class="text-center">Terakhir Setor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gajiPerPekerja as $index => $gaji)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <span class="fw-bold">{{ $gaji->worker->username ?? '-' }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">{{ $gaji->jumlah_setoran }}</span>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bold text-primary">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-end">
                                    Rp {{ number_format($gaji->jumlah_setoran > 0 ? $gaji->total_gaji / $gaji->jumlah_setoran : 0, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ \Carbon\Carbon::parse($gaji->terakhir_setor)->format('d-m-Y') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle me-2"></i>Tidak ada data setoran ditemukan.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection