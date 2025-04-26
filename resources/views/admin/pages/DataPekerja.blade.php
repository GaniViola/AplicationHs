@extends('admin.layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Teknisi</h1>
    <a href="#" class="btn btn-primary">Tambah Teknisi</a>
</div>

<!-- Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Teknisi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Teknisi</th>
                        <th>Spesialisasi</th>
                        <th>Telepon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Fahri Ramadhan</td>
                        <td>AC Service</td>
                        <td>081234567890</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Lisa Permata</td>
                        <td>Cleaning Service</td>
                        <td>089876543210</td>
                        <td><span class="badge badge-danger">Tidak Aktif</span></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </td>
                    </tr>
                    <!-- Tambahkan baris lain sesuai teknisi -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
