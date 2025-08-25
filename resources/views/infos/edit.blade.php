@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Info</h4>

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

    <form action="{{ route('infos.update', $info->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $info->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi</label>
            <textarea name="isi" class="form-control" rows="5" required>{{ old('isi', $info->isi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-select" required>
                @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ old('kategori_id', $info->kategori_id) == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label><br>
            @if ($info->gambar)
                <img src="{{ asset('storage/' . $info->gambar) }}" alt="Gambar Info" width="150" class="mb-2 img-thumbnail" id="current-image">
            @else
                <p class="text-muted">Belum ada gambar.</p>
            @endif
            <input type="file" name="gambar" class="form-control mt-2" accept="image/*" onchange="previewImage(event)">
            <img id="preview" src="#" alt="Preview Gambar Baru" class="mt-2 img-thumbnail d-none" width="150">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i data-feather="save" class="icon-xs"></i> Update
            </button>
            <a href="{{ route('infos.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left" class="icon-xs"></i> Batal
            </a>
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

    // Fungsi preview gambar baru
    function previewImage(event) {
        let input = event.target;
        let preview = document.getElementById('preview');
        let currentImage = document.getElementById('current-image');

        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');

                // Sembunyikan gambar lama jika ada
                if (currentImage) {
                    currentImage.classList.add('d-none');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
