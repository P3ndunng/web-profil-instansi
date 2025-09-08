@extends('layouts.app')

@section('title', 'Tambah Slider')

@section('content')
<div class="container mt-4">
    <h3>Tambah Slider</h3>

    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control">
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <i data-feather="save"></i> Simpan
        </button>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
            <i data-feather="arrow-left"></i> Kembali
        </a>
    </form>
</div>

<script> feather.replace() </script>
@endsection
