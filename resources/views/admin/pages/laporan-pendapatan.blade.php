@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Pendapatan Admin</h1>

    <form method="GET" action="{{ route('admin.laporan.pendapatan') }}" class="form-inline mb-4">
        <label class="mr-2">Dari Tanggal:</label>
        <input type="date" name="start_date" value="{{ $startDate }}" class="form-control mr-2">

        <label class="mr-2">Sampai:</label>
        <input type="date" name="end_date" value="{{ $endDate }}" class="form-control mr-2">

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    @if($pendapatan && $pendapatan->total_transaksi > 0)
    <div class="card shadow mb-4">
        <div class="card-body">
            <p><strong>Total Pendapatan Admin:</strong> Rp {{ number_format($pendapatan->total_pendapatan, 0, ',', '.') }}</p>
            <p><strong>Total Transaksi:</strong> {{ $pendapatan->total_transaksi }}</p>
            <p><strong>Setoran Terakhir:</strong> {{ $pendapatan->terakhir_setoran ? \Carbon\Carbon::parse($pendapatan->terakhir_setoran)->format('d-m-Y H:i') : '-' }}</p>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <strong>Detail Setoran</strong>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
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
                        <td>{{ $setoran->order_id }}</td>
                        <td>{{ $setoran->order->customer->username ?? '-' }}</td>
                        <td>{{ $setoran->worker->username ?? '-' }}</td>
                        <td>Rp {{ number_format($setoran->jumlah_setoran, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($setoran->jumlah_admin, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
        <div class="alert alert-warning">Tidak ada data setoran pada rentang tanggal ini.</div>
    @endif
</div>
@endsection
