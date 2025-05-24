@extends('admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0 text-gray-800">
                <i class="fas fa-camera me-2 text-success"></i>
                Laporan Pekerja
            </h2>
            <p class="text-muted small mb-0">Dokumentasi pekerjaan sebelum dan sesudah</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-success btn-sm" id="refreshBtn">
                <i class="fas fa-sync-alt me-1"></i>
                Refresh
            </button>
            <div class="dropdown">
                <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i>
                    Export
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i>PDF</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-excel me-2"></i>Excel</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card shadow mb-4">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari customer, pekerja, atau layanan...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="filterWorker">
                        <option value="">Semua Pekerja</option>
                        @foreach(collect($workPhotos)->pluck('worker.username')->filter()->unique() as $worker)
                            <option value="{{ $worker }}">{{ $worker }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="filterDate">
                        <option value="">Semua Tanggal</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table -->
    <div class="card shadow mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success">Data Laporan Pekerja</h6>
            <small class="text-muted">Menampilkan <span id="showingStart">0</span> - <span id="showingEnd">0</span> dari <span id="totalEntries">{{ count($workPhotos) }}</span> data</small>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="workTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Foto Sebelum</th>
                            <th class="text-center">Foto Sesudah</th>
                            <th>Customer</th>
                            <th>Pekerja</th>
                            <th>Layanan</th>
                            <th>Catatan</th>
                            <th class="text-center">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($workPhotos as $i => $foto)
                            @php
                                $order = $foto->order;
                                $details = $order->orderDetails ?? collect();
                                $layanan = optional($details->first())->service->name ?? '-';
                                $customer = optional($order->customer)->username ?? '-';
                                $tanggal = optional($order)->tanggal_pemesanan
                                    ? \Carbon\Carbon::parse($order->tanggal_pemesanan)->format('d-m-Y')
                                    : '-';
                            @endphp
                            <tr class="work-row"
                                data-customer="{{ strtolower($customer) }}"
                                data-worker="{{ strtolower(optional($foto->worker)->username ?? '-') }}"
                                data-service="{{ strtolower($layanan) }}"
                                data-date="{{ $tanggal }}"
                                data-original-index="{{ $i }}">
                                <td class="text-center align-middle">
                                    <span class="badge bg-secondary row-number">{{ $i + 1 }}</span>
                                </td>
                                <td class="text-center align-middle">
                                    @if($foto->photo_before)
                                        <div class="photo-container">
                                            <img src="{{ asset('storage/' . $foto->photo_before) }}"
                                                 class="img-thumbnail photo-preview"
                                                 width="80"
                                                 style="cursor: pointer; transition: transform 0.2s;"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#photoModal"
                                                 data-photo="{{ asset('storage/' . $foto->photo_before) }}"
                                                 data-title="Foto Sebelum - {{ $customer }}"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                                 onload="this.style.display='block'; this.nextElementSibling.style.display='none';">
                                            <div class="photo-placeholder" style="display: none;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        </div>
                                    @else
                                        <div class="photo-placeholder">
                                            <i class="fas fa-image text-muted"></i>
                                            <small class="d-block text-muted">Tidak ada foto</small>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if($foto->photo_after)
                                        <div class="photo-container">
                                            <img src="{{ asset('storage/' . $foto->photo_after) }}"
                                                 class="img-thumbnail photo-preview"
                                                 width="80"
                                                 style="cursor: pointer; transition: transform 0.2s;"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#photoModal"
                                                 data-photo="{{ asset('storage/' . $foto->photo_after) }}"
                                                 data-title="Foto Sesudah - {{ $customer }}"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                                 onload="this.style.display='block'; this.nextElementSibling.style.display='none';">
                                            <div class="photo-placeholder" style="display: none;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        </div>
                                    @else
                                        <div class="photo-placeholder">
                                            <i class="fas fa-image text-muted"></i>
                                            <small class="d-block text-muted">Tidak ada foto</small>
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2">
                                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-size: 14px;">
                                                {{ substr($customer, 0, 1) }}
                                            </div>
                                        </div>
                                        <span class="fw-semibold">{{ $customer }}</span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2">
                                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-size: 14px;">
                                                {{ substr(optional($foto->worker)->username ?? '-', 0, 1) }}
                                            </div>
                                        </div>
                                        <span class="fw-semibold">{{ optional($foto->worker)->username ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-info text-dark">{{ $layanan }}</span>
                                </td>
                                <td class="align-middle">
                                    @if($foto->catatan)
                                        <div class="catatan-container" style="max-width: 200px;">
                                            <span class="catatan-text" data-bs-toggle="tooltip" title="{{ $foto->catatan }}">
                                                {{ Str::limit($foto->catatan, 50) }}
                                            </span>
                                            @if(strlen($foto->catatan) > 50)
                                                <button class="btn btn-sm btn-link p-0 ms-1" data-bs-toggle="modal" data-bs-target="#catatanModal" data-catatan="{{ $foto->catatan }}" data-customer="{{ $customer }}">
                                                    <i class="fas fa-expand-alt"></i>
                                                </button>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if($tanggal !== '-')
                                        <span class="badge bg-light text-dark border">{{ $tanggal }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-camera-retro fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Tidak ada data laporan foto pekerja</h5>
                                        <p class="text-muted">Data akan muncul di sini setelah pekerja mengirim laporan</p>
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

<!-- Photo Modal -->
<div class="modal fade" id="photoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Pekerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalPhoto" src="" class="img-fluid rounded" style="max-height: 70vh;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="downloadPhoto">
                    <i class="fas fa-download me-1"></i>Download
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Catatan Modal -->
<div class="modal fade" id="catatanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Catatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="catatanContent" class="p-3 bg-light rounded"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
.photo-preview:hover {
    transform: scale(1.05);
}

.photo-placeholder {
    width: 80px;
    height: 60px;
    border: 2px dashed #ddd;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #5a5c69;
    background-color: #f8f9fc;
}

.table-hover tbody tr:hover {
    background-color: #f8f9fc;
}

.empty-state {
    padding: 2rem 0;
}

.work-row {
    transition: all 0.2s ease;
}

.catatan-text {
    cursor: help;
}

.avatar {
    flex-shrink: 0;
}

.table-responsive {
    min-height: 300px;
}

#noResults {
    display: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables
    let allRows = Array.from(document.querySelectorAll('.work-row'));
    let filteredRows = [...allRows];

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Photo modal functionality
    const photoModal = document.getElementById('photoModal');
    const modalPhoto = document.getElementById('modalPhoto');
    let currentPhotoUrl = '';

    photoModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const photoUrl = button.getAttribute('data-photo');
        const title = button.getAttribute('data-title');

        currentPhotoUrl = photoUrl;
        modalPhoto.src = photoUrl;
        photoModal.querySelector('.modal-title').textContent = title;
    });

    // Download photo functionality
    document.getElementById('downloadPhoto').addEventListener('click', function() {
        if (currentPhotoUrl) {
            const link = document.createElement('a');
            link.href = currentPhotoUrl;
            link.download = 'foto-pekerjaan.jpg';
            link.click();
        }
    });

    // Catatan modal functionality
    const catatanModal = document.getElementById('catatanModal');
    catatanModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const catatan = button.getAttribute('data-catatan');
        const customer = button.getAttribute('data-customer');

        catatanModal.querySelector('.modal-title').textContent = `Catatan untuk ${customer}`;
        document.getElementById('catatanContent').textContent = catatan;
    });

    // Search and filter functionality
    const searchInput = document.getElementById('searchInput');
    const filterWorker = document.getElementById('filterWorker');
    const filterDate = document.getElementById('filterDate');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const workerFilter = filterWorker.value.toLowerCase();
        const dateFilter = filterDate.value;

        filteredRows = allRows.filter(row => {
            const customer = row.getAttribute('data-customer');
            const worker = row.getAttribute('data-worker');
            const service = row.getAttribute('data-service');
            const date = row.getAttribute('data-date');

            let matchesSearch = customer.includes(searchTerm) ||
                              worker.includes(searchTerm) ||
                              service.includes(searchTerm);

            let matchesWorker = !workerFilter || worker === workerFilter;

            let matchesDate = true;
            if (dateFilter && date !== '-') {
                const rowDate = new Date(date.split('-').reverse().join('-'));
                const today = new Date();

                switch(dateFilter) {
                    case 'today':
                        matchesDate = rowDate.toDateString() === today.toDateString();
                        break;
                    case 'week':
                        const weekAgo = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
                        matchesDate = rowDate >= weekAgo;
                        break;
                    case 'month':
                        matchesDate = rowDate.getMonth() === today.getMonth() &&
                                    rowDate.getFullYear() === today.getFullYear();
                        break;
                }
            }

            return matchesSearch && matchesWorker && matchesDate;
        });

        displayPage();
        updateInfo();
    }

    function displayPage() {
        const tableBody = document.getElementById('tableBody');
        const emptyRow = document.getElementById('emptyRow');

        // Hide all rows first
        allRows.forEach(row => row.style.display = 'none');

        if (filteredRows.length === 0) {
            if (emptyRow) {
                emptyRow.style.display = '';
                emptyRow.querySelector('.empty-state h5').textContent = 'Tidak ada data yang sesuai dengan pencarian';
                emptyRow.querySelector('.empty-state p').textContent = 'Coba ubah kata kunci pencarian atau filter';
            }
            return;
        } else {
            if (emptyRow) emptyRow.style.display = 'none';
        }

        // Show all filtered rows
        filteredRows.forEach((row, index) => {
            row.style.display = '';
            // Update row numbers
            const rowNumber = row.querySelector('.row-number');
            if (rowNumber) {
                rowNumber.textContent = index + 1;
            }
        });
    }

    function updateInfo() {
        const totalEntries = filteredRows.length;

        document.getElementById('showingStart').textContent = totalEntries > 0 ? 1 : 0;
        document.getElementById('showingEnd').textContent = totalEntries;
        document.getElementById('totalEntries').textContent = totalEntries;
    }

    // Event listeners
    searchInput.addEventListener('input', filterTable);
    filterWorker.addEventListener('change', filterTable);
    filterDate.addEventListener('change', filterTable);

    // Refresh button
    document.getElementById('refreshBtn').addEventListener('click', function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memuat...';
        btn.disabled = true;

        setTimeout(() => {
            location.reload();
        }, 500);
    });

    // Initialize page
    displayPage();
    updateInfo();
});
</script>
@endsection
