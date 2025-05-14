@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Input Setoran Baru</h4>
        </div>
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.setoran.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-4">
                            <label for="order_id" class="form-label fw-bold text-secondary">Pilih Order</label>
                            <select name="order_id" id="order_id" class="form-select form-select-lg" required>
                                <option value="" disabled selected>Pilih Order</option>
                                @foreach ($orders as $order)
                                    @php
                                        $layanan = $order->orderDetails->map(fn($od) => $od->service->name ?? 'Layanan tidak diketahui')->join(', ');
                                        $subtotal = $order->orderDetails->sum('subtotal');
                                    @endphp
                                    <option 
                                        value="{{ $order->id }}"
                                        data-worker-name="{{ $order->worker->username ?? 'Tidak Diketahui' }}"
                                        data-customer-name="{{ $order->customer->username ?? 'Customer Tidak Diketahui' }}"
                                        data-total="{{ $subtotal }}"
                                    >
                                        {{ $layanan }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">Nama Pekerja</label>
                            <input type="text" id="worker_name" class="form-control form-control-lg" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">Nama Customer</label>
                            <input type="text" id="customer_name" class="form-control form-control-lg" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-4">
                            <label for="jumlah_setoran" class="form-label fw-bold text-secondary">Jumlah Setoran</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" name="jumlah_setoran" id="jumlah_setoran" class="form-control form-control-lg" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">Total Tagihan</label>
                            <input type="text" id="total_order" class="form-control form-control-lg bg-light" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">Total untuk Admin (80%)</label>
                            <input type="text" id="admin_share" class="form-control form-control-lg bg-light" disabled>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.setoran.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success btn-lg px-4">
                        <i class="bi bi-save me-1"></i> Simpan Setoran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script JS --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const orderSelect = document.getElementById('order_id');
        const workerNameInput = document.getElementById('worker_name');
        const customerNameInput = document.getElementById('customer_name');
        const totalOrderInput = document.getElementById('total_order');
        const adminShareInput = document.getElementById('admin_share');

        orderSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const workerName = selectedOption.getAttribute('data-worker-name');
            const customerName = selectedOption.getAttribute('data-customer-name');
            const total = selectedOption.getAttribute('data-total');

            workerNameInput.value = workerName || 'Tidak Diketahui';
            customerNameInput.value = customerName || 'Tidak Diketahui';
            totalOrderInput.value = total ? 'Rp ' + parseInt(total).toLocaleString('id-ID') : '';
            adminShareInput.value = total ? 'Rp ' + Math.floor(0.8 * total).toLocaleString('id-ID') : '';
        });
    });
</script>
@endsection
