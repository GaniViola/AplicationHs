@extends('admin.layouts.app')
@section('title', 'Data Customer') 
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Customer</h1>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('admin.customers') }}" class="d-flex">
                <input type="text" name="search" placeholder="🔍 Search Email/Nama..." value="{{ $search }}" 
                    class="form-control mr-2">
                <button type="submit" class="btn btn-success">
                    Cari
                </button>
            </form>
        </div>
    </div>

    <!-- Table Responsive -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Daftar Customer</h6>
        </div>
        <div class="card-body">
            <!-- Bulk Actions -->
            <form method="POST" action="{{ route('admin.customers.bulk') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="d-flex">
                            <select name="action" class="form-control mr-2">
                                <option value="">-- Pilih Aksi --</option>
                                <option value="block">Blokir</option>
                                <option value="activate">Aktifkan</option>
                            </select>
                            <button type="submit" class="btn btn-success">
                                Terapkan
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <input type="checkbox" id="select_all">
                                </th>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $index => $customer)
                            <tr>
                                <td>
                                    <input type="checkbox" name="user_ids[]" value="{{ $customer->id }}">
                                </td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone ?? '-' }}</td>
                                <td>
                                    @if($customer->status == 'aktif')
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Blokir</span>
                                    @endif
                                </td>
                                <td>
                                    @if($customer->status == 'aktif')
                                        <form action="{{ route('admin.customers.block', $customer->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            {{-- Hapus @method('PATCH') jika route hanya menerima POST --}}
                                            <button type="submit" class="btn btn-warning btn-sm">
                                                🔒 Blokir
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.customers.activate', $customer->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            {{-- Hapus @method('PATCH') jika route hanya menerima POST --}}
                                            <button type="submit" class="btn btn-info btn-sm">
                                                🔓 Aktifkan
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @if(count($customers) == 0)
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data customer.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script select all --}}
<script>
    document.getElementById('select_all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
@endsection