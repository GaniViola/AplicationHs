@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Data Setoran Pekerja</h2>

    <a href="{{ route('admin.setoran.create') }}" class="btn btn-primary mb-3">Tambah Setoran Baru</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Customer</th>
                <th>Pekerja</th>
                <th>Service</th>
                <th>Total</th>
                <th>Jumlah Setoran</th>
                <th>Status</th>
                <th>Tanggal Setoran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($setorans as $setoran)
                @php
                    $order = $setoran->order;
                    $total = $order->orderDetails->sum('subtotal');
                @endphp
                <tr>
                    <td>{{ $order->customer->name ?? '-' }}</td>
                    <td>{{ $setoran->worker->name ?? '-' }}</td>
                    <td>
                        <ul>
                            @foreach ($order->orderDetails as $detail)
                                <li>{{ $detail->service->nama_jasa ?? '-' }} (x{{ $detail->quantity }}) - Rp{{ number_format($detail->subtotal) }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>Rp{{ number_format($total) }}</td>
                    <td>Rp{{ number_format($setoran->jumlah_setoran) }}</td>
                    <td>
                        <span class="badge bg-{{ $setoran->status_setoran === 'selesai' ? 'success' : ($setoran->status_setoran === 'kurang' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($setoran->status_setoran) }}
                        </span>
                    </td>
                    <td>{{ $setoran->tanggal_setoran->format('d-m-Y H:i') }}</td>
                    <td>
                        @if (in_array($setoran->status_setoran, ['pending', 'kurang']))
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalSetor{{ $setoran->id }}">
                                Setor
                            </button>
                        @else
                            <span class="text-muted">Selesai</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Edit Setoran -->
@foreach ($setorans as $setoran)
    <div class="modal fade" id="modalSetor{{ $setoran->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $setoran->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.setoran.update', $setoran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel{{ $setoran->id }}">Update Setoran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Customer:</strong> {{ $setoran->order->customer->name ?? '-' }}</p>
                        <p><strong>Pekerja:</strong> {{ $setoran->worker->name ?? '-' }}</p>
                        <p><strong>Total Tagihan:</strong> Rp{{ number_format($setoran->order->orderDetails->sum('subtotal')) }}</p>
                        <div class="mb-3">
                            <label for="jumlah_setoran_{{ $setoran->id }}" class="form-label">Jumlah Setoran</label>
                            <input type="number" class="form-control" name="jumlah_setoran" id="jumlah_setoran_{{ $setoran->id }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach
@endsection

@section('scripts')
<!-- Pastikan Bootstrap JS sudah dimuat -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
