@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Menu</h4>

    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $menu->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Link</label>
            <input type="text" name="link" class="form-control" value="{{ $menu->link }}">
        </div>

        <div class="mb-3">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" value="{{ $menu->urutan }}" required>
        </div>

        <div class="mb-3">
            <label>Menu Induk</label>
            <select name="parent_id" class="form-control">
                <option value="">Pilih Menu Induk (Opsional)</option>
                @foreach($parentMenus as $parent)
                    <option value="{{ $parent->id }}" {{ $menu->parent_id == $parent->id ? 'selected' : '' }}>
                        {{ $parent->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Icon</label>
            <input type="text" name="icon" class="form-control" value="{{ $menu->icon }}" placeholder="Contoh: fa fa-home">
        </div>

        <div class="mb-3">
            <label>Target Link</label>
            <select name="target" class="form-control" required>
                <option value="_self" {{ $menu->target == '_self' ? 'selected' : '' }}>Same Window (_self)</option>
                <option value="_blank" {{ $menu->target == '_blank' ? 'selected' : '' }}>New Window (_blank)</option>
            </select>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ $menu->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Aktif
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
