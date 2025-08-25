@extends('layouts.app')

@section('title', 'Manajemen Media')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Manajemen File Download</h4>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol Tambah Hanya Icon & Biru --}}
    <a href="{{ route('admin.media.create') }}" class="btn btn-primary mb-3 btn-icon" title="Tambah Media"
       style="padding: 0.375rem; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
        <i data-feather="plus-circle"></i>
    </a>

    {{-- Tabel Media --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Judul</th>
                    <th>File</th>
                    <th>Tipe</th>
                    <th style="width:160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($media as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td><a href="{{ asset('storage/'.$item->file) }}" target="_blank">Lihat File</a></td>
                    <td class="text-center">{{ $item->tipe }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            {{-- Tombol Edit Hanya Icon & Kuning --}}
                            <a href="{{ route('admin.media.edit', $item->id) }}" class="btn btn-warning btn-sm btn-icon" title="Edit"
                               style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                                <i data-feather="edit"></i>
                            </a>

                            {{-- Tombol Hapus Hanya Icon & Merah --}}
                            <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus media ini?');">
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
                    <td colspan="5" class="text-center text-muted">Belum ada media.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Load Feather icons --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endpush
@endsection
