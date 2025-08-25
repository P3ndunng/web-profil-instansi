@extends('layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Pengumuman</h3>

    <form action="{{ route('admin.pengumuman.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $item->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi Pengumuman</label>
            <textarea name="isi" id="isi" class="form-control" rows="5" required>{{ old('isi', $item->isi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $item->tanggal) }}">
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
            @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Pengumuman" class="img-thumbnail mt-2" width="200">
            @endif
        </div>

        <button type="submit" class="btn btn-success">
            <i data-feather="save" class="icon-xs"></i>
        </button>
        <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">
            <i data-feather="x-circle" class="icon-xs"></i>
        </a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endsection
