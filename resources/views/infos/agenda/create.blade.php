@extends('layouts.app')

@section('title', 'Tambah Agenda')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Agenda</h3>

    <form action="{{ route('admin.agenda.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan') }}" required>
        </div>

        <div class="mb-3">
            <label for="tempat" class="form-label">Tempat</label>
            <input type="text" name="tempat" id="tempat" class="form-control" value="{{ old('tempat') }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success"><i data-feather="save" class="icon-xs"></i></button>
        <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary"><i data-feather="x-circle" class="icon-xs"></i></a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') { feather.replace(); }
    });
</script>
@endsection
