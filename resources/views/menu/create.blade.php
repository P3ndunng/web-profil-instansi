@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Menu</h4>

    <form action="{{ route('admin.menu.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Link</label>
            <input type="text" name="link" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
