@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-gradient-success text-white py-3">
            <div class="d-flex align-items-center">
                <i class="bi bi-cash-coin fs-3 me-2"></i>
                <h4 class="mb-0">Input Setoran Baru</h4>
            </div>
        </div>
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-start border-danger border-4" role="alert">
                    <div class="d-flex">
                        <div class="me-3">
                            <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="alert-heading">Terjadi Kesalahan</h5>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.setoran.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row g-4">
                    <!-- Order Selection -->
                    <div class="col-md-12">
                        <div class="card bg-light border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-3">
                                    <i class="bi bi-bag-check me-2"></i>Informasi Order
                                </h5>
                                <div class="mb-4">
                                    <label for="order_id" class="form-label fw-bold">Pilih Order</label>
                                    <select name="order_id" id="order_id" class="form-select form-select-lg @error('order_id') is-invalid @enderror" required>
                                        <option value="" disabled {{ old('order_id') ? '' : 'selected' }}>-- Pilih Order --</option>
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
                                                {{ old('order_id') == $order->id ? 'selected' : '' }}
                                            >
                                                #ORD-{{ $order->id }} - {{ $layanan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Pilih order terlebih dahulu
                                    </div>
                                    @error('order_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Nama Pekerja</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="bi bi-person-badge"></i>
                                                </span>
                                                <input type="text" id="worker_name" class="form-control form-control-lg border-start-0" 
                                                    disabled placeholder="Nama pekerja akan tampil di sini">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Nama Customer</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="bi bi-person"></i>
                                                </span>
                                                <input type="text" id="customer_name" class="form-control form-control-lg border-start-0" 
                                                    disabled placeholder="Nama customer akan tampil di sini">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="col-md-12">
                        <div class="card bg-light border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-3">
                                    <i class="bi bi-currency-exchange me-2"></i>Informasi Pembayaran
                                </h5>

                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="jumlah_setoran" class="form-label fw-bold">Jumlah Setoran</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-white">Rp</span>
                                                <input 
                                                    type="number" 
                                                    name="jumlah_setoran" 
                                                    id="jumlah_setoran" 
                                                    class="form-control form-control-lg @error('jumlah_setoran') is-invalid @enderror"
                                                    value="{{ old('jumlah_setoran') }}"
                                                    placeholder="Masukkan jumlah setoran"
                                                    required
                                                >
                                                <div class="invalid-feedback">
                                                    Jumlah setoran harus diisi
                                                </div>
                                            </div>
                                            <div id="error-container"></div>
                                            @error('jumlah_setoran')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label class="form-label fw-bold">Total Tagihan</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="bi bi-tag-fill"></i>
                                                </span>
                                                <input type="text" id="total_order" class="form-control form-control-lg bg-white border-start-0" 
                                                    disabled placeholder="Total tagihan order">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label class="form-label fw-bold">Total untuk Admin (20%)</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="bi bi-wallet2"></i>
                                                </span>
                                                <input type="text" id="admin_share" class="form-control form-control-lg bg-white border-start-0" 
                                                    disabled placeholder="Bagian untuk admin">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Card -->
                    <div class="col-md-12">
                        <div class="card border-0 bg-light shadow-sm" id="summary-card" style="display: none;">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Ringkasan Transaksi
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th class="ps-0">Order ID</th>
                                                <td>:</td>
                                                <td id="summary-order-id">-</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0">Customer</th>
                                                <td>:</td>
                                                <td id="summary-customer">-</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0">Pekerja</th>
                                                <td>:</td>
                                                <td id="summary-worker">-</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th class="ps-0">Total Tagihan</th>
                                                <td>:</td>
                                                <td id="summary-total" class="fw-bold">-</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0">Jumlah Setoran</th>
                                                <td>:</td>
                                                <td id="summary-setoran" class="fw-bold text-success">-</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0">Kembalian</th>
                                                <td>:</td>
                                                <td id="summary-kembalian" class="fw-bold text-primary">-</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
        const jumlahSetoranInput = document.getElementById('jumlah_setoran');
        const form = document.querySelector('form');
        const summaryCard = document.getElementById('summary-card');
        
        // Summary elements
        const summaryOrderId = document.getElementById('summary-order-id');
        const summaryCustomer = document.getElementById('summary-customer');
        const summaryWorker = document.getElementById('summary-worker');
        const summaryTotal = document.getElementById('summary-total');
        const summarySetoran = document.getElementById('summary-setoran');
        const summaryKembalian = document.getElementById('summary-kembalian');

        // Format currency
        function formatRupiah(angka) {
            return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
        }

        // Set data saat halaman dimuat jika ada old input
        if (orderSelect.value) {
            updateFormFromSelect(orderSelect.options[orderSelect.selectedIndex]);
        }

        // Set data saat order dipilih
        orderSelect.addEventListener('change', function () {
            updateFormFromSelect(this.options[this.selectedIndex]);
        });

        function updateFormFromSelect(selectedOption) {
            const workerName = selectedOption.getAttribute('data-worker-name');
            const customerName = selectedOption.getAttribute('data-customer-name');
            const total = selectedOption.getAttribute('data-total');
            const orderId = selectedOption.value;

            workerNameInput.value = workerName || 'Tidak Diketahui';
            customerNameInput.value = customerName || 'Tidak Diketahui';

            if (total) {
                totalOrderInput.value = formatRupiah(total);
                adminShareInput.value = formatRupiah(Math.floor(0.2 * total));
                totalOrderInput.setAttribute('data-raw-total', total);
                
                // Atur minimal jumlah setoran
                jumlahSetoranInput.setAttribute('min', total);
                
                // Update summary
                summaryOrderId.textContent = '#ORD-' + orderId;
                summaryCustomer.textContent = customerName || 'Tidak Diketahui';
                summaryWorker.textContent = workerName || 'Tidak Diketahui';
                summaryTotal.textContent = formatRupiah(total);
                
                // Show summary card
                summaryCard.style.display = 'block';
                
                // Fokus ke input jumlah setoran
                jumlahSetoranInput.focus();
            } else {
                totalOrderInput.value = '';
                adminShareInput.value = '';
                totalOrderInput.removeAttribute('data-raw-total');
                jumlahSetoranInput.removeAttribute('min');
                
                // Hide summary card
                summaryCard.style.display = 'none';
            }
        }

        // Update summary saat jumlah setoran berubah
        jumlahSetoranInput.addEventListener('input', function() {
            const totalRaw = parseInt(totalOrderInput.getAttribute('data-raw-total') || 0);
            const jumlahSetoran = parseInt(this.value || 0);
            
            // Reset invalid state
            this.classList.remove('is-invalid');
            const errorContainer = document.getElementById('error-container');
            errorContainer.innerHTML = '';
            
            // Update summary
            summarySetoran.textContent = formatRupiah(jumlahSetoran);
            
            const kembalian = jumlahSetoran - totalRaw;
            if (kembalian >= 0) {
                summaryKembalian.textContent = formatRupiah(kembalian);
                summaryKembalian.classList.remove('text-danger');
                summaryKembalian.classList.add('text-primary');
            } else {
                summaryKembalian.textContent = '- ' + formatRupiah(Math.abs(kembalian));
                summaryKembalian.classList.remove('text-primary');
                summaryKembalian.classList.add('text-danger');
            }
        });

        // Validasi client-side
        form.addEventListener('submit', function (e) {
            const totalRaw = parseInt(totalOrderInput.getAttribute('data-raw-total') || 0);
            const jumlahSetoran = parseInt(jumlahSetoranInput.value || 0);
            const errorContainer = document.getElementById('error-container');
            
            // Hapus error jika sebelumnya sudah ada
            errorContainer.innerHTML = '';

            if (jumlahSetoran < totalRaw) {
                e.preventDefault(); // Cegah form dikirim jika jumlah kurang
                
                // Tampilkan error sebagai feedback visual langsung
                const errorHtml = `
                    <div class="alert alert-danger mt-2 border-start border-danger border-4 d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        <div>
                            Jumlah setoran (${formatRupiah(jumlahSetoran)}) kurang dari total tagihan (${formatRupiah(totalRaw)}). 
                            Harap isi setoran minimal sebesar total tagihan.
                        </div>
                    </div>`;
                errorContainer.innerHTML = errorHtml;
                
                // Tambahkan class is-invalid untuk visual feedback
                jumlahSetoranInput.classList.add('is-invalid');
                
                // Scroll to error
                errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    });
</script>

@endsection