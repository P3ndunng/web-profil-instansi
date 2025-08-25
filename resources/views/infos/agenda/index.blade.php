@extends('layouts.app')

@section('title', 'Agenda')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Manajemen Agenda</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah Hanya Icon & Biru -->
    <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary mb-3 btn-icon" title="Tambah Agenda"
       style="padding: 0.375rem; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
        <i data-feather="plus-circle"></i>
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Tanggal</th>
                    <th>Nama Kegiatan</th>
                    <th>Tempat</th>
                    <th>Gambar</th>
                    <th style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal ?? '-' }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->isi ?? '-' }}</td>
                    <td>
                        @if($item->gambar)
                            <img src="{{ asset('storage/'.$item->gambar) }}" alt="gambar" width="50">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <!-- Tombol Edit Hanya Icon & Kuning -->
                            <a href="{{ route('admin.agenda.edit', $item->id) }}" class="btn btn-warning btn-sm btn-icon" title="Edit"
                               style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                                <i data-feather="edit"></i>
                            </a>

                            <!-- Tombol Hapus Hanya Icon & Merah -->
                            <form action="{{ route('admin.agenda.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
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
                    <td colspan="6" class="text-center text-muted">Belum ada agenda.</td>
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
