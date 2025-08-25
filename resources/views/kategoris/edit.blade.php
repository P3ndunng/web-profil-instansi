@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Kategori</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.kategoris.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama', $kategori->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left" class="icon-xs"></i> Batal
            </a>
            <button type="submit" class="btn btn-success">
                <i data-feather="save" class="icon-xs"></i> Perbarui
            </button>
        </div>
    </form>
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
