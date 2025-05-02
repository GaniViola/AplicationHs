{{-- views/admin/orders/index.blade.php --}}
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
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-box"></i></span>
                            <select class="form-select" name="service_id">
                                <option value="">Semua Layanan</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-cog"></i></span>
                            <select class="form-select" name="status">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai_pengerjaan" {{ request('status') == 'selesai_pengerjaan' ? 'selected' : '' }}>Selesai Pengerjaan</option>
                                <option value="pending_setoran" {{ request('status') == 'pending_setoran' ? 'selected' : '' }}>Pending Setoran</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Orders Table -->
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
                            </td>
                            <td>Rp {{ number_format($order->orderDetails->sum('subtotal'), 0, ',', '.') }}</td>
                            <td>
                                <div class="btn-group mb-2" role="group">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    @if($order->status == 'pending')
                                    <!-- Form untuk memilih pekerja -->
                                    @if(!$order->worker_id)
                                    <form action="{{ route('orders.assignWorker', $order->id) }}" method="POST" class="d-flex">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <select name="worker_id" class="form-select form-select-sm me-2" required>
                                                <option value="">Pilih Pekerja</option>
                                                @foreach($workers as $worker)
                                                    <option value="{{ $worker->id }}">
                                                        {{ $worker->username }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Set</button>
                                        </form>
                                    @else
                                        <!-- Jika pekerja sudah dipilih -->
                                        <form action="{{ route('orders.accept', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Terima</button>
                                        </form>
                                    @endif
                                @endif
                                
                                <!-- Untuk aksi menolak -->
                                @if($order->status == 'pending')
                                    <form action="{{ route('orders.reject', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                    </form>
                                @endif
                                
                            
                                    @if($order->status == 'proses')
                                        <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('complete-form-{{ $order->id }}').submit()">
                                            <i class="fas fa-check-double"></i> Selesai
                                        </button>
                                        <form id="complete-form-{{ $order->id }}" action="{{ route('orders.complete', $order->id) }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    @endif
                            
                                    @if($order->status == 'selesai_pengerjaan')
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="document.getElementById('ready-payment-form-{{ $order->id }}').submit()">
                                            <i class="fas fa-money-bill"></i> Siap Bayar
                                        </button>
                                        <form id="ready-payment-form-{{ $order->id }}" action="{{ route('orders.readyPayment', $order->id) }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    @endif
                                </div>
                            
                                {{-- Assign Worker --}}
                                @if($order->status == 'proses' && !$order->worker_id)
                                    <form action="{{ route('orders.assignWorker', $order->id) }}" method="POST" class="d-flex">
                                        @csrf
                                        <select name="worker_id" class="form-select form-select-sm me-2" required>
                                            <option value="">Pilih Pekerja</option>
                                            @foreach($workers as $worker)
                                                <option value="{{ $worker->id }}" {{ $order->worker_id == $worker->id ? 'selected' : '' }}>
                                                    {{ $worker->username }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Set</button>
                                    </form>
                                @endif
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
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<!-- View Order Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="viewOrderModalLabel">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="orderDetailContent">
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <div id="orderActionButtons"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Function to load order details
    function loadOrderDetails(orderId) {
        fetch(`/orders/${orderId}/details`)
            .then(response => response.json())
            .then(data => {
                let content = `
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Informasi Pelanggan</h6>
                            <p>
                                <strong>Nama:</strong> ${data.customer.username}<br>
                                <strong>Email:</strong> ${data.customer.email}<br>
                                <strong>Telepon:</strong> ${data.customer.phone}<br>
                                <strong>Alamat:</strong> ${data.customer.address || '-'}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Pesanan</h6>
                            <p>
                                <strong>ID Pesanan:</strong> #${data.order.id}<br>
                                <strong>Tanggal:</strong> ${new Date(data.order.tanggal_pemesanan).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}<br>
                                <strong>Status:</strong> ${getStatusBadge(data.order.status)}<br>
                                <strong>Metode Pembayaran:</strong> ${data.order.metode_pembayaran === 'tunai' ? 'Tunai' : 'Non-Tunai'}
                            </p>
                        </div>
                    </div>
                    <hr>
                    <h6>Detail Layanan</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Layanan</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>`;
                
                data.details.forEach(detail => {
                    content += `
                        <tr>
                            <td>${detail.service.name}</td>
                            <td>Rp ${formatNumber(detail.price)}</td>
                            <td>${detail.quantity}</td>
                            <td>Rp ${formatNumber(detail.subtotal)}</td>
                        </tr>
                    `;
                });
                
                content += `
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    <th>Rp ${formatNumber(data.total)}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                `;
                
                document.getElementById('orderDetailContent').innerHTML = content;
                
                // Set action buttons based on order status
                let actionButtons = '';
                if (data.order.status === 'pending') {
                    actionButtons = `
                        <button type="button" class="btn btn-success" onclick="acceptOrder(${data.order.id})">Terima</button>
                        <button type="button" class="btn btn-danger" onclick="rejectOrder(${data.order.id})">Tolak</button>
                    `;
                } else if (data.order.status === 'proses') {
                    actionButtons = `
                        <button type="button" class="btn btn-primary" onclick="completeOrder(${data.order.id})">Tandai Selesai</button>
                    `;
                } else if (data.order.status === 'selesai_pengerjaan') {
                    actionButtons = `
                        <button type="button" class="btn btn-secondary" onclick="readyForPayment(${data.order.id})">Siap Bayar</button>
                    `;
                }
                document.getElementById('orderActionButtons').innerHTML = actionButtons;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('orderDetailContent').innerHTML = '<div class="alert alert-danger">Gagal memuat detail pesanan</div>';
            });
    }
    
    // Helper function to format numbers as currency
    function formatNumber(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    }
    
    // Helper function to get status badge HTML
    function getStatusBadge(status) {
        switch(status) {
            case 'pending':
                return '<span class="badge bg-warning ">Pending</span>';
            case 'proses':
                return '<span class="badge bg-info">Proses</span>';
            case 'selesai_pengerjaan':
                return '<span class="badge bg-primary">Selesai Pengerjaan</span>';
            case 'pending_setoran':
                return '<span class="badge bg-secondary">Pending Setoran</span>';
            case 'selesai':
                return '<span class="badge bg-success">Selesai</span>';
            default:
                return '<span class="badge bg-secondary">Unknown</span>';
        }
    }
    
    // Action functions
    function acceptOrder(orderId) {
        document.getElementById(`accept-form-${orderId}`).submit();
    }
    
    function rejectOrder(orderId) {
        if (confirm('Apakah Anda yakin ingin menolak pesanan ini?')) {
            document.getElementById(`reject-form-${orderId}`).submit();
        }
    }
    
    function completeOrder(orderId) {
        document.getElementById(`complete-form-${orderId}`).submit();
    }
    
    function readyForPayment(orderId) {
        document.getElementById(`ready-payment-form-${orderId}`).submit();
    }
    
    // Event listener for opening modal
    document.addEventListener('DOMContentLoaded', function() {
        const viewOrderModal = document.getElementById('viewOrderModal');
        if (viewOrderModal) {
            viewOrderModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const orderId = button.getAttribute('data-order-id');
                loadOrderDetails(orderId);
            });
        }
    });
</script>
@endsection