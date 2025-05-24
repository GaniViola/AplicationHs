@extends('admin.layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Detail Pesanan #{{ $order->id }}</h4>
        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-light">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Pelanggan</h5>
                        <hr>
                        <p class="mb-1"><strong>Nama:</strong> {{ $order->user->username }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $order->user->email }}</p>
                        <p class="mb-1"><strong>No. Telepon:</strong> {{ $order->user->phone }}</p>
                        <p class="mb-0"><strong>Alamat:</strong> {{ $order->user->address ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Pesanan</h5>
                        <hr>
                        <p class="mb-1"><strong>ID Pesanan:</strong> #{{ $order->id }}</p>
                        <p class="mb-1"><strong>Tanggal Pemesanan:</strong> {{ \Carbon\Carbon::parse($order->tanggal_pemesanan)->format('d M Y') }}</p>
                        <p class="mb-1">
                            <strong>Status:</strong>
                            @if($order->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($order->status == 'proses')
                                <span class="badge bg-info">Proses</span>
                            @elseif($order->status == 'selesai_pengerjaan')
                                <span class="badge bg-primary">Selesai Pengerjaan</span>
                            @elseif($order->status == 'pending_setoran')
                                <span class="badge bg-secondary">Pending Setoran</span>
                            @elseif($order->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </p>
                        <p class="mb-0"><strong>Metode Pembayaran:</strong> {{ $order->metode_pembayaran == 'tunai' ? 'Tunai' : 'Non-Tunai' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Detail Layanan</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Layanan</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $detail->service->name ?? 'Layanan tidak ditemukan' }}</td>
                                <td>Rp{{ number_format($detail->service->price ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $detail->quantity }}</td> {{-- ✅ pakai quantity, bukan jumlah --}}
                                <td class="text-end">Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th class="text-end">
                                    Rp{{ number_format($order->orderDetails->sum('subtotal'), 0, ',', '.') }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
