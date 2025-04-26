@extends('admin.layouts.app') <!-- Atau sesuaikan dengan nama layout kamu -->

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Pesanan Masuk</h1>

    <!-- Table Responsive -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Layanan</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->nama_pelanggan }}</td>
                            <td>{{ $order->layanan }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->waktu)->format('d M Y, H:i') }}</td>
                            <td>
                                @if($order->status == 'menunggu')
                                    <span class="badge badge-warning">Menunggu</span>
                                @elseif($order->status == 'diterima')
                                    <span class="badge badge-success">Diterima</span>
                                @elseif($order->status == 'ditolak')
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('orders.accept', $order->id) }}" class="btn btn-success btn-sm">Terima</a>
                                <a href="{{ route('orders.reject', $order->id) }}" class="btn btn-danger btn-sm">Tolak</a>
                            </td>
                        </tr>
                        @endforeach
                        @if($orders->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pesanan masuk.</td>
                        </tr>
                        @endif
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
