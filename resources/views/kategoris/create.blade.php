@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Kategori</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali input Anda:</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.kategoris.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left" class="icon-xs"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i data-feather="save" class="icon-xs"></i> Simpan
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
