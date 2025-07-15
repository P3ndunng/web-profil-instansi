@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Manajemen Galeri</h4>

    <a href="{{ route('galeri.create') }}" class="btn btn-primary mb-3">Tambah Gambar</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($galeris as $item)
        <div class="col-md-3 mb-3">
            <div class="card">
                <img src="{{ asset('storage/'.$item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="height:200px; object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <a href="{{ route('galeri.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('galeri.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus gambar?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
