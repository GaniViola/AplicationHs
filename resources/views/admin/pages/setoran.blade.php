@extends('admin.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap5.min.css">
<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        border-bottom: none;
        padding: 20px 25px;
    }

    .btn-add {
        border-radius: 10px;
        font-weight: 600;
        padding: 8px 16px;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }

    .table td {
        vertical-align: middle;
    }

    .badge {
        padding: 7px 12px;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .alert {
        border-radius: 10px;
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: #28a745;
        background-color: rgba(40, 167, 69, 0.1);
    }

    .status-indicator {
        width: 10px;
        height: 10px;
        display: inline-block;
        border-radius: 50%;
        margin-right: 5px;
    }

    .status-selesai {
        background-color: #28a745;
    }

    .status-kurang {
        background-color: #ffc107;
    }

    .status-default {
        background-color: #6c757d;
    }

    .shimmer {
        position: relative;
        overflow: hidden;
        background: #f6f7f8;
    }

    .shimmer::after {
        content: '';
        position: absolute;
        top: 0;
        left: -150%;
        width: 150%;
        height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.5) 50%, rgba(255,255,255,0) 100%);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        to {
            left: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="card border-0">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 d-inline-flex align-items-center">
                    <i class="fas fa-hand-holding-usd me-2"></i>
                    Daftar Setoran
                </h4>
                <span class="badge bg-light text-primary ms-2 rounded-pill">{{ $setorans->count() }} data</span>
            </div>
            <a href="{{ route('admin.setoran.create') }}" class="btn btn-light text-primary btn-add">
                <i class="fas fa-plus-circle me-1"></i> Tambah Setoran
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table id="setoranTable" class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Tanggal</th>
                            <th width="12%">Pekerja</th>
                            <th width="12%">Customer</th>
                            <th width="13%">Layanan</th>
                            <th width="10%">Total Tagihan</th>
                            <th width="10%">Setoran Masuk</th>
                            <th width="8%">Admin (20%)</th>
                            <th width="8%">Pekerja (80%)</th>
                            <th width="10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($setorans as $index => $setoran)
                            @php
                                $layanan = $setoran->order->orderDetails->map(fn($od) => $od->service->name ?? '-')->join(', ');
                                $total = $setoran->order->orderDetails->sum('subtotal');
                                $adminShare = 0.2 * $total;
                                $workerShare = 0.8 * $total;
                            @endphp
                            <tr>
                                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="far fa-calendar-alt text-primary me-2"></i>
                                        {{ \Carbon\Carbon::parse($setoran->tanggal_setoran)->format('d-m-Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2 bg-light rounded-circle text-center" style="width: 35px; height: 35px; line-height: 35px;">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <span>{{ $setoran->worker->username ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2 bg-light rounded-circle text-center" style="width: 35px; height: 35px; line-height: 35px;">
                                            <i class="fas fa-user-tie text-secondary"></i>
                                        </div>
                                        <span>{{ $setoran->order->customer->username ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 200px;" data-bs-toggle="tooltip" title="{{ $layanan }}">
                                        {{ $layanan }}
                                    </span>
                                </td>
                                <td class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                <td class="fw-bold text-primary">Rp {{ number_format($setoran->jumlah_setoran, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($adminShare, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($workerShare, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-{{ $setoran->status_setoran == 'selesai' ? 'success' : ($setoran->status_setoran == 'kurang' ? 'warning' : 'secondary') }} d-flex align-items-center">
                                        <span class="status-indicator status-{{ $setoran->status_setoran == 'selesai' ? 'selesai' : ($setoran->status_setoran == 'kurang' ? 'kurang' : 'default') }}"></span>
                                        {{ ucfirst($setoran->status_setoran) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada data setoran</h5>
                                        <p class="text-muted mb-3">Tambahkan setoran baru untuk memulai</p>
                                        <a href="{{ route('admin.setoran.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus-circle me-1"></i> Tambah Setoran Baru
                                        </a>
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

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#setoranTable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            dom: "<'row'<'col-sm-12'tr>>" +
                 "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            pageLength: 10,
            ordering: true,
            responsive: true,
            columnDefs: [
                { orderable: false, targets: [0, 4] }
            ]
        });

        // Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Card animation
        setTimeout(function() {
            $('.card').css('opacity', '1');
        }, 300);
    });
</script>

@endsection