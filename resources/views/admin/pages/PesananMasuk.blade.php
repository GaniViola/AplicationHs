{{-- resources/views/admin/orders/index.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Manajemen Booking</h4>
        </div>
        <div class="card-body">
            <!-- Filter Section -->
            <form action="{{ route('orders.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select class="form-select" name="service_id">
                            <option value="">Semua Layanan</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai_pengerjaan" {{ request('status') == 'selesai_pengerjaan' ? 'selected' : '' }}>Selesai Pengerjaan</option>
                            <option value="pending_setoran" {{ request('status') == 'pending_setoran' ? 'selected' : '' }}>Pending Setoran</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Layanan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $key => $order)
                        <tr>
                            <td>{{ $orders->firstItem() + $key }}</td>
                            <td>{{ $order->user->username }}</td>
                            <td>
                                @foreach($order->orderDetails as $detail)
                                    {{ $detail->service->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </td>
                            <td>{{ \Carbon\Carbon::parse($order->tanggal_pemesanan)->format('d M Y') }}</td>
                            <td>
                                <span class="badge 
                                    @if($order->status == 'pending') bg-warning
                                    @elseif($order->status == 'proses') bg-info
                                    @elseif($order->status == 'selesai_pengerjaan') bg-primary
                                    @elseif($order->status == 'pending_setoran') bg-secondary
                                    @elseif($order->status == 'selesai') bg-success
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($order->orderDetails->sum('subtotal'), 0, ',', '.') }}</td>
                            <td>
                                <div class="mb-2">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info mb-1">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>

                                    @if($order->status === 'pending')
                                    @if(!$order->worker_id)
    <!-- Form assign worker -->
    <form action="{{ route('orders.assignWorker') }}" method="POST" class="d-flex mb-2">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <select name="worker_id" class="form-select form-select-sm me-2" required>
            <option value="">Pilih Pekerja</option>
            @foreach($workers as $worker)
                @php
                    // Ambil id layanan pekerja dan order
                    $workerServiceIds = $worker->services->pluck('id')->toArray();
                    $orderServiceIds = $order->orderDetails->pluck('service_id')->toArray();

                    // Cek apakah layanan pekerja cocok dengan pesanan
                    $hasMatchingService = !empty(array_intersect($workerServiceIds, $orderServiceIds));

                    // Cek apakah pekerja sedang aktif di order lain
                    $isAssigned = $orders->whereIn('status', ['pending', 'proses'])
                                        ->contains('worker_id', $worker->id);
                @endphp

                @if($hasMatchingService && !$isAssigned)
                    <option value="{{ $worker->id }}">{{ $worker->username }}</option>
                @endif
            @endforeach
        </select>

        <button type="submit" class="btn btn-sm btn-outline-primary">Set</button>
    </form>
@else
    <span class="badge bg-info">Pekerja: {{ $order->worker->username ?? 'N/A' }}</span>
@endif

                                    <!-- Tombol Tolak -->
                                    <form action="{{ route('orders.reject', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                    </form>
                                @endif
                                

                                    @if($order->status === 'proses')
                                        <form id="complete-form-{{ $order->id }}" action="{{ route('orders.complete', $order->id) }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('complete-form-{{ $order->id }}').submit()">
                                            <i class="fas fa-check-double"></i> Selesai
                                        </button>
                                    @endif

                                    @if($order->status === 'selesai_pengerjaan')
                                        <form id="ready-payment-form-{{ $order->id }}" action="{{ route('orders.readyPayment', $order->id) }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="document.getElementById('ready-payment-form-{{ $order->id }}').submit()">
                                            <i class="fas fa-money-bill"></i> Siap Bayar
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada pesanan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
