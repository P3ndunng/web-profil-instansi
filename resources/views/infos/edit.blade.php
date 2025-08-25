@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Berita</h3>

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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('infos.update', $info->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $info->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label">Isi</label>
                    <textarea id="tinymce-editor" name="isi" class="form-control @error('isi') is-invalid @enderror" rows="5" required>
                        {{ old('isi', $info->isi) }}
                    </textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $info->kategori_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label><br>
                    @if ($info->gambar)
                        <img src="{{ asset('storage/' . $info->gambar) }}" alt="Gambar Info" width="150" class="mb-2 img-thumbnail" id="current-image">
                    @else
                        <p class="text-muted">Belum ada gambar.</p>
                    @endif
                    <input type="file" name="gambar" class="form-control mt-2 @error('gambar') is-invalid @enderror"
                           accept="image/*" onchange="previewImage(event)">
                    <img id="preview" src="#" alt="Preview Gambar Baru" class="mt-2 img-thumbnail d-none" width="150">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
    </div>
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

@push('scripts')
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/q23oijllb0bh4qykqtjcusb7uz11j58hfgtviaj22aerotgy/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#tinymce-editor',
            height: 500,
            plugins: 'print preview paste importcss searchreplace autolink autosave save ' +
                     'directionality code visualblocks visualchars fullscreen image link media ' +
                     'template codesample table charmap hr pagebreak nonbreaking anchor toc ' +
                     'insertdatetime advlist lists wordcount imagetools textpattern noneditable help ' +
                     'charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | ' +
                     'alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | ' +
                     'forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | ' +
                     'charmap emoticons | fullscreen preview save print | ' +
                     'insertfile image media pageembed template link anchor codesample | ' +
                     'a11ycheck ltr rtl | showcomments addcomment',
            toolbar_sticky: true,
            autosave_restore_when_empty: true,
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
@endpush
