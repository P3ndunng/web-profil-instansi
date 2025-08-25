@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Manajemen Informasi</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tab Menu -->
    <ul class="nav nav-tabs mb-3" id="infoTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="berita-tab" data-bs-toggle="tab" href="#berita" role="tab">Berita Terbaru</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="agenda-tab" data-bs-toggle="tab" href="#agenda" role="tab">Agenda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pengumuman-tab" data-bs-toggle="tab" href="#pengumuman" role="tab">Pengumuman</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="artikel-tab" data-bs-toggle="tab" href="#artikel" role="tab">Artikel</a>
        </li>
    </ul>

    <div class="tab-content" id="infoTabContent">
        <!-- Berita Terbaru -->
        <div class="tab-pane fade show active" id="berita" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Daftar Berita</h5>
                <!-- Tombol Tambah Berita -->
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">
                    + Tambah Berita
                </button>
            </div>
            @include('infos.partials.table', ['items' => $infos->where('kategori.nama', 'Berita')])
        </div>

        <!-- Agenda -->
        <div class="tab-pane fade" id="agenda" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Daftar Agenda</h5>
                <a href="{{ route('infos.create', ['kategori' => 'Agenda']) }}" class="btn btn-primary btn-sm">
                    + Tambah Agenda
                </a>
            </div>
            @include('infos.partials.table-agenda', ['items' => $infos->where('kategori.nama', 'Agenda')])
        </div>

        <!-- Pengumuman -->
        <div class="tab-pane fade" id="pengumuman" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Daftar Pengumuman</h5>
                <a href="{{ route('infos.create', ['kategori' => 'Pengumuman']) }}" class="btn btn-primary btn-sm">
                    + Tambah Pengumuman
                </a>
            </div>
            @include('infos.partials.table', ['items' => $infos->where('kategori.nama', 'Pengumuman')])
        </div>

        <!-- Artikel -->
        <div class="tab-pane fade" id="artikel" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Daftar Artikel</h5>
                <a href="{{ route('infos.create', ['kategori' => 'Artikel']) }}" class="btn btn-primary btn-sm">
                    + Tambah Artikel
                </a>
            </div>
            @include('infos.partials.table', ['items' => $infos->where('kategori.nama', 'Artikel')])
        </div>
    </div>
</div>

<!-- Modal Tambah Berita -->
<div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('infos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="kategori_id" value="{{ \App\Models\Kategori::where('nama', 'Berita')->first()->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahBeritaLabel">Tambah Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi</label>
                        <textarea name="isi" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImage(event)">
                        <img id="preview" src="#" alt="Preview" class="mt-2 img-thumbnail d-none" width="150">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Script preview gambar -->
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
