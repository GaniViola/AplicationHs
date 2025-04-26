@extends('admin.layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Layanan</h1>
    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahServiceModal">
        Tambah Layanan
    </button>
</div>

<!-- Notifikasi -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Table Daftar Layanan -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Layanan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $index => $service)
                    <tr>
                        <td>{{ $services->firstItem() + $index }}</td> <!-- Menampilkan nomor urut berdasarkan halaman -->
                        <td>
                            @if($service->image)
                                <img src="{{ asset('storage/'.$service->image) }}" width="80" class="rounded" alt="Gambar">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->category->name ?? '-' }}</td>
                        <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm mb-1" data-toggle="modal" data-target="#editServiceModal{{ $service->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Yakin mau hapus layanan ini?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Tombol Previous -->
            <li class="page-item {{ $services->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $services->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <!-- Link Nomor Halaman -->
            @for ($i = 1; $i <= $services->lastPage(); $i++)
                @if ($i == 1 || $i == $services->lastPage() || ($i >= $services->currentPage() - 2 && $i <= $services->currentPage() + 2))
                    <li class="page-item {{ $services->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $services->url($i) }}">{{ $i }}</a>
                    </li>
                @elseif ($i == 2 && $services->currentPage() > 4)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @elseif ($i == $services->lastPage() - 1 && $services->currentPage() < $services->lastPage() - 3)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
            @endfor

            <!-- Tombol Next -->
            <li class="page-item {{ !$services->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $services->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

        </div>
    </div>
</div>

<!-- Modal Tambah Layanan -->
<div class="modal fade" id="tambahServiceModal" tabindex="-1" role="dialog" aria-labelledby="tambahServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahServiceModalLabel">Tambah Layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Nama Layanan</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama layanan" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Deskripsi layanan">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Harga dalam rupiah" value="{{ old('price') }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Layanan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit per Service -->
@foreach($services as $service)
<div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="editServiceModalLabel{{ $service->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editServiceModalLabel{{ $service->id }}">Edit Layanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" class="form-control" required>
              <option value="">-- Pilih Kategori --</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $service->category_id == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="name">Nama Layanan</label>
            <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
          </div>

          <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3">{{ $service->description }}</textarea>
          </div>

          <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ $service->price }}" required min="0">
          </div>

          <div class="form-group">
            <label for="image">Gambar (Kosongkan jika tidak ganti)</label>
            <input type="file" name="image" class="form-control-file">
            @if($service->image)
              <img src="{{ asset('storage/'.$service->image) }}" width="100" class="mt-2 rounded">
            @endif
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Update Layanan</button> <!-- Ganti ke btn-success -->
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@endsection

@section('css')
<style>
    .pagination {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .pagination .page-item:hover .page-link {
        background-color: #0056b3;
        border-color: #0056b3;
        color: white;
    }

    .pagination .page-item.disabled .page-link {
        background-color: #e9ecef;
        border-color: #e9ecef;
        color: #6c757d;
    }
</style>
@endsection
