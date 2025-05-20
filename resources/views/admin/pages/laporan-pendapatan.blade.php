@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-3">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0 text-gray-800">Laporan Pendapatan Admin</h1>
        <div class="d-flex">
            <a href="{{ route('admin.pages.pendapatan.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-sm btn-outline-secondary me-2" target="_blank">
                <i class="fas fa-print me-1"></i> Cetak
            </a>
            <a href="{{ route('admin.pages.pendapatan.excel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-sm btn-outline-success">
                <i class="fas fa-file-excel me-1"></i> Export
            </a>
        </div>
    </div>

    <!-- Filter Date Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.laporan.pendapatan') }}" class="row g-2 align-items-end">
                <div class="col-md-4 col-sm-12">
                    <label class="form-label mb-1">Dari Tanggal:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-calendar text-success"></i>
                        </span>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="form-control" id="start-date">
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-12">
                    <label class="form-label mb-1">Sampai Tanggal:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-calendar text-success"></i>
                        </span>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="form-control" id="end-date">
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-12">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-filter me-1"></i> Terapkan Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($pendapatan && $pendapatan->total_transaksi > 0)
    <!-- Summary Data -->
    <div class="card shadow-sm mb-4">
        <div class="card-body py-3">
            <div class="row g-0">
                <div class="col-md-4 border-end">
                    <div class="text-center py-2">
                        <div class="text-success mb-1">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="text-muted small mb-1">Total Pendapatan Admin</div>
                        <div class="h4 mb-0">Rp {{ number_format($pendapatan->total_pendapatan, 0, ',', '.') }}</div>
                    </div>
                </div>
                
                <div class="col-md-4 border-end">
                    <div class="text-center py-2">
                        <div class="text-info mb-1">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="text-muted small mb-1">Total Transaksi</div>
                        <div class="h4 mb-0">{{ $pendapatan->total_transaksi }}</div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="text-center py-2">
                        <div class="text-success mb-1">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="text-muted small mb-1">Setoran Terakhir</div>
                        <div class="h4 mb-0">{{ $pendapatan->terakhir_setoran ? \Carbon\Carbon::parse($pendapatan->terakhir_setoran)->format('d-m-Y H:i') : '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow-sm">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">Detail Setoran</h6>
            <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari data...">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Pekerja</th>
                            <th>Jumlah Setoran</th>
                            <th>Untuk Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($setorans as $index => $setoran)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($setoran->tanggal_setoran)->format('d-m-Y') }}</td>
                            <td><span class="badge bg-light text-dark">{{ $setoran->order_id }}</span></td>
                            <td>{{ $setoran->order->customer->username ?? '-' }}</td>
                            <td>{{ $setoran->worker->username ?? '-' }}</td>
                            <td class="fw-medium">Rp {{ number_format($setoran->jumlah_setoran, 0, ',', '.') }}</td>
                            <td class="text-success fw-medium">Rp {{ number_format($setoran->jumlah_admin, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted small">Menampilkan {{ count($setorans) }} data setoran</span>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body p-4 text-center">
                <div class="py-4">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada data setoran</h5>
                    <p class="text-muted">Tidak ada data setoran pada rentang tanggal yang dipilih.</p>
                    <a href="{{ route('admin.laporan.pendapatan') }}" class="btn btn-outline-success mt-2">
                        <i class="fas fa-sync-alt me-1"></i> Reset Filter
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('#dataTable tbody tr');
                
                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }

        // Add datepicker enhancements
        const startDate = document.getElementById('start-date');
        const endDate = document.getElementById('end-date');
        
        if (startDate && endDate) {
            startDate.addEventListener('change', function() {
                endDate.min = this.value;
                if (endDate.value && endDate.value < this.value) {
                    endDate.value = this.value;
                }
            });
            
            endDate.addEventListener('change', function() {
                startDate.max = this.value;
                if (startDate.value && startDate.value > this.value) {
                    startDate.value = this.value;
                }
            });
        }
        
        // Set initial min/max dates
        if (startDate && endDate && startDate.value && endDate.value) {
            endDate.min = startDate.value;
            startDate.max = endDate.value;
        }
    });
</script>

<style>
    .table > :not(caption) > * > * {
        padding: 0.75rem;
    }
</style>
@endpush