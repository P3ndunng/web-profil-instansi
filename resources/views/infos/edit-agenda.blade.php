@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Agenda</h4>

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
            <label for="judul" class="form-label">Nama Kegiatan *</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $info->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Deskripsi Kegiatan *</label>
            <textarea name="isi" class="form-control" rows="5" required>{{ old('isi', $info->isi) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tanggal" class="form-label">Tanggal Kegiatan *</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $info->tanggal) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="tempat" class="form-label">Tempat Kegiatan *</label>
                <input type="text" name="tempat" class="form-control" value="{{ old('tempat', $info->tempat) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label><br>
            @if ($info->gambar)
                <img src="{{ asset('storage/' . $info->gambar) }}" alt="Gambar Agenda" width="150" class="mb-2 img-thumbnail">
            @else
                <p class="text-muted">Belum ada gambar.</p>
            @endif
            <input type="file" name="gambar" class="form-control mt-2" accept="image/*" onchange="previewImage(event)">
            <img id="preview" src="#" alt="Preview" class="mt-2 img-thumbnail d-none" width="150">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('infos.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
function previewImage(event) {
    let input = event.target;
    let preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
