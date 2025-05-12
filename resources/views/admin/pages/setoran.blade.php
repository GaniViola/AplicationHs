@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Setoran</h4>
           <a href="{{ route('admin.setoran.create') }}" class="btn btn-light text-primary">
    + Tambah Setoran
</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Setoran</th>
                        <th>Nama Pekerja</th>
                        <th>Nama Customer</th>
                        <th>Layanan</th>
                        <th>Total Tagihan</th>
                        <th>Setoran Masuk</th>
                        <th>Untuk Admin (80%)</th>
                        <th>Untuk Pekerja (20%)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($setorans as $index => $setoran)
                        @php
                            $layanan = $setoran->order->orderDetails->map(fn($od) => $od->service->name ?? '-')->join(', ');
                            $total = $setoran->order->orderDetails->sum('subtotal');
                            $adminShare = 0.8 * $total;
                            $workerShare = 0.2 * $total;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($setoran->tanggal_setoran)->format('d-m-Y') }}</td>
                            <td>{{ $setoran->worker->username ?? '-' }}</td>
                            <td>{{ $setoran->order->customer->username ?? '-' }}</td>
                            <td>{{ $layanan }}</td>
                            <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($setoran->jumlah_setoran, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($adminShare, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($workerShare, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $setoran->status_setoran == 'selesai' ? 'success' : ($setoran->status_setoran == 'kurang' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($setoran->status_setoran) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">Belum ada data setoran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
