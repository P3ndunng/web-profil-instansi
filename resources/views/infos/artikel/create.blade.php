@extends('layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Artikel</h3>

    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal (opsional)</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}">
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi Artikel</label>
            <textarea name="isi" id="isi" class="form-control" rows="5" required>{{ old('isi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <!-- Button Save icon -->
        <button type="submit" class="btn btn-success" title="Simpan">
            <i data-feather="save" class="icon-xs"></i>
        </button>

        <!-- Button Cancel icon -->
        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary" title="Batal">
            <i data-feather="x-circle" class="icon-xs"></i>
        </a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') { feather.replace(); }
    });
</script>
@endsection
