@extends('layouts.app')

@section('title', 'Manajemen Kontak')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Daftar Kontak</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah Hanya Icon & Biru -->
    <a href="{{ route('admin.kontak.create') }}" class="btn btn-primary mb-3 btn-icon" title="Tambah Kontak"
       style="padding: 0.375rem; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
        <i data-feather="plus-circle"></i>
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Pesan</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kontaks as $kontak)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kontak->nama }}</td>
                    <td>{{ $kontak->email }}</td>
                    <td>{{ $kontak->telepon }}</td>
                    <td>{{ Str::limit($kontak->pesan, 50) }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <!-- Tombol Edit Hanya Icon & Kuning -->
                            <a href="{{ route('admin.kontak.edit', $kontak->id) }}" class="btn btn-warning btn-sm btn-icon" title="Edit"
                               style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                                <i data-feather="edit"></i>
                            </a>

                            <!-- Tombol Hapus Hanya Icon & Merah -->
                            <form action="{{ route('admin.kontak.destroy', $kontak->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kontak ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Hapus"
                                        style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                                    <i data-feather="trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data kontak.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    // Inisialisasi Feather Icons
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endsection
