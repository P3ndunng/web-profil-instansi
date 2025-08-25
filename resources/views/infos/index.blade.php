@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Manajemen Informasi</h3>
    <div class="row">
        <!-- Manajemen Berita -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Berita</h5>
                    <p class="text-muted">Kelola berita terbaru</p>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-primary">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Manajemen Pengumuman -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Pengumuman</h5>
                    <p class="text-muted">Kelola pengumuman</p>
                    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-primary">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Manajemen Artikel -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Artikel</h5>
                    <p class="text-muted">Kelola artikel</p>
                    <a href="{{ route('admin.artikel.index') }}" class="btn btn-primary">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Manajemen Agenda -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Agenda</h5>
                    <p class="text-muted">Kelola agenda kegiatan</p>
                    <a href="{{ route('admin.agenda.index') }}" class="btn btn-primary">Kelola</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
