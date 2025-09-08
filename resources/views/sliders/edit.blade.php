@extends('layouts.app')

@section('title', 'Edit Slider')

@section('content')
<div class="container mt-4">
    <h3>Edit Slider</h3>

    <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $slider->judul }}">
        </div>
        <div class="mb-3">
            <label>Gambar Saat Ini</label><br>
            <img src="{{ asset('storage/'.$slider->gambar) }}" width="200" class="rounded mb-2">
            <input type="file" name="gambar" class="form-control mt-2">
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $slider->deskripsi }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <i data-feather="save"></i> Update
        </button>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
            <i data-feather="arrow-left"></i> Kembali
        </a>
    </form>
</div>

<script> feather.replace() </script>
@endsection
