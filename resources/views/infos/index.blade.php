@extends('layouts.app')

@section('title', 'Informasi')

@section('content')
<div class="container mt-4">
    <h2>Informasi Terbaru</h2>

    <h4>Berita</h4>
    <ul>
        @forelse($berita as $item)
            <li>{{ $item->judul }}</li>
        @empty
            <li>Tidak ada berita</li>
        @endforelse
    </ul>

    <h4>Artikel</h4>
    <ul>
        @forelse($artikel as $item)
            <li>{{ $item->judul }}</li>
        @empty
            <li>Tidak ada artikel</li>
        @endforelse
    </ul>

    <h4>Pengumuman</h4>
    <ul>
        @forelse($pengumuman as $item)
            <li>{{ $item->judul }}</li>
        @empty
            <li>Tidak ada pengumuman</li>
        @endforelse
    </ul>

    <h4>Agenda</h4>
    <ul>
        @forelse($agenda as $item)
            <li>{{ $item->judul }}</li>
        @empty
            <li>Tidak ada agenda</li>
        @endforelse
    </ul>
</div>
@endsection
