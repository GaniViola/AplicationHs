@extends('admin.layouts.app')

@section('content')
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="card shadow mb-4">
    <div class="text-center p-3">
        <h2 class="m-0 font-weight-bold text-secondary">Data Users</h2>
    </div>
    
    <div class="d-flex justify-content-between align-items-center px-4 pb-2">
        <div>
            <form action="/UserMaster" method="GET">
                <div class="input-group mb-3">
                    <input style="width: 300px;" type="text" class="form-control" placeholder="Search..." name="searchuser" value="{{ request('searchuser') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
            {{-- <input type="text" class="form-control d-inline-block me-2" placeholder="Search..." style="width: 400px;" autofocus> --}}
            {{-- <a href="#" class="btn btn-success btn-sm">Tambah</a> --}}
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Gambar</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">
                                @if($user->photo)
                                    <img src="{{ asset('storage/'.$user->photo) }}" width="80" class="rounded" alt="Gambar">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">{{ $user->username }}</td>
                            <td class="text-center align-middle">{{ $user->email }}</td>
                            <td class="text-center align-middle">{{ $user->address }}</td>
                            <td class="text-center align-middle">{{ $user->phone }}</td>
                            <td class="text-center align-middle">{{ $user->role }}</td>
                            <td class="text-center align-middle">
                                <a href="" class="btn btn-warning btn-sm me-1">Edit</a>
                                <form action="{{ route('destroyuser', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection