@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Berita</h3>

    <form action="{{ route('admin.berita.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" value="{{ $item->judul }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Isi</label>
            <textarea name="isi" rows="5" class="form-control" required>{{ $item->isi }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar</label>
            @if($item->gambar)
                <p><img src="{{ asset('storage/'.$item->gambar) }}" alt="gambar" width="150"></p>
            @endif
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
