@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Menu</h4>

    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $menu->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Link</label>
            <input type="text" name="link" class="form-control" value="{{ $menu->link }}" required>
        </div>

        <div class="mb-3">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" value="{{ $menu->urutan }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
