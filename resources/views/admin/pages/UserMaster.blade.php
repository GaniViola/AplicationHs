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
        <div class="btn-group mb-3" role="group" aria-label="Filter Role">
            <a href="/UserMaster?role=admin" class="btn btn-outline-primary {{ request('role') == 'admin' ? 'active' : '' }}">Admin</a>
            <a href="/UserMaster?role=worker" class="btn btn-outline-primary {{ request('role') == 'worker' ? 'active' : '' }}">Worker</a>
        </div>
        <div>
            <form action="/UserMaster" method="GET">
                <input type="hidden" name="role" value="{{ request('role') }}">
                <div class="input-group mb-3">
                    <input style="width: 300px;" type="text" class="form-control" placeholder="Search..." name="searchuser" value="{{ request('searchuser') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
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
                            <td class="text-center align-middle">
                                @if (request('role') == 'worker')
                                    <a href="#" class="btn btn-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#showModal{{ $user->id }}"> Show </a>
                                @endif
                                <a href="" class="btn btn-warning btn-sm me-1">Edit</a>
                                <form action="{{ route('destroyuser', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Show Detail -->
                        <div class="modal fade" id="showModal{{ $user->id }}" tabindex="-1" aria-labelledby="showModalLabel{{ $user->id }}" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="showModalLabel{{ $user->id }}">Detail User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <strong>Skill:</strong>
                                @if($user->service->count())
                                    <ul>
                                        @foreach ($user->service as $service)
                                            <li>{{ $service->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted">Belum memiliki layanan</p>
                                @endif
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
