@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Tambah Menu</h4>
        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.menu.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Nama Menu *</label>
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                           value="{{ old('nama') }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Icon (Bootstrap Icons)</label>
                                    <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"
                                           value="{{ old('icon') }}" placeholder="bi bi-house">
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Contoh: bi bi-house, bi bi-info-circle
                                        <a href="https://icons.getbootstrap.com/" target="_blank">Lihat icon</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Link/URL</label>
                                    <input type="text" name="link" class="form-control @error('link') is-invalid @enderror"
                                           value="{{ old('link') }}" placeholder="#beranda atau /halaman">
                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Kosongkan jika menu memiliki sub menu (dropdown)
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Target Link</label>
                                    <select name="target" class="form-select @error('target') is-invalid @enderror">
                                        <option value="_self" {{ old('target') == '_self' ? 'selected' : '' }}>
                                            Same Window (_self)
                                        </option>
                                        <option value="_blank" {{ old('target') == '_blank' ? 'selected' : '' }}>
                                            New Tab (_blank)
                                        </option>
                                    </select>
                                    @error('target')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Menu Induk</label>
                                    <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                        <option value="">-- Menu Utama --</option>
                                        @foreach($parentMenus as $parent)
                                            <option value="{{ $parent->id }}"
                                                    {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                                {{ $parent->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Pilih menu induk jika ini adalah sub menu
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Urutan *</label>
                                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                                           value="{{ old('urutan', 0) }}" min="0" required>
                                    @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" name="is_active"
                                               id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Menu
                            </button>
                            <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-info-circle"></i> Petunjuk
                    </h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6>Tips Penggunaan:</h6>
                        <ul class="mb-0">
                            <li><strong>Menu Utama:</strong> Biarkan "Menu Induk" kosong</li>
                            <li><strong>Sub Menu:</strong> Pilih menu induknya</li>
                            <li><strong>Dropdown:</strong> Kosongkan link untuk menu yang punya sub menu</li>
                            <li><strong>Urutan:</strong> Angka lebih kecil akan muncul lebih dulu</li>
                            <li><strong>Icon:</strong> Gunakan class Bootstrap Icons</li>
                        </ul>
                    </div>

                    <h6>Contoh Link:</h6>
                    <ul class="list-unstyled">
                        <li><code>#beranda</code> - Anchor link</li>
                        <li><code>/profil</code> - Internal route</li>
                        <li><code>{{ route('admin.berita.index') }}</code> - Named route</li>
                        <li><code>https://example.com</code> - External link</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
