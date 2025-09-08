@extends('layouts.app')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Manajemen Galeri</h3>

    <!-- Tombol Tambah Hanya Icon & Biru -->
    <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary mb-3 btn-icon" title="Tambah Gambar"
       style="padding: 0.375rem; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
        <i data-feather="plus-circle"></i>
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($galeris as $item)
        <div class="col-md-3 mb-3">
            <div class="card h-100 shadow-sm rounded-3">
                <img src="{{ asset('storage/'.$item->gambar) }}" 
                     class="card-img-top" 
                     alt="{{ $item->judul }}" 
                     style="height:200px; object-fit:cover;">
                <div class="card-body">
                    <h6 class="card-title text-truncate">{{ $item->judul }}</h6>
                </div>
                <div class="card-footer text-center d-flex justify-content-center gap-1">
                    <!-- Tombol Edit -->
                    <a href="{{ route('admin.galeri.edit', $item->id) }}" 
                       class="btn btn-warning btn-sm btn-icon" 
                       title="Edit"
                       style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                        <i data-feather="edit"></i>
                    </a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Hapus"
                                style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                            <i data-feather="trash-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Tidak ada data galeri.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endsection
