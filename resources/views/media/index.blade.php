@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Manajemen Media</h4>

    <a href="{{ route('media.create') }}" class="btn btn-primary mb-3">Tambah Media</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>File</th>
                <th>Tipe</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($media as $item)
            <tr>
                <td>{{ $item->judul }}</td>
                <td><a href="{{ asset('storage/'.$item->file) }}" target="_blank">Lihat File</a></td>
                <td>{{ $item->tipe }}</td>
                <td>
                    <a href="{{ route('media.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('media.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus media?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
