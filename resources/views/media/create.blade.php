@extends('layouts.app')

@section('title', 'Tambah Media')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Tambah Media</h4>

    {{-- Alert Error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Judul --}}
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        {{-- File --}}
        <div class="mb-3">
            <label for="file" class="form-label">File</label>
            <input type="file" name="file" id="file" class="form-control" required>
            <small class="form-text text-muted">Format: jpg, jpeg, png, mp4, avi, pdf, docx</small>
        </div>

        {{-- Tombol --}}
        <div class="d-flex gap-2">
            {{-- Simpan --}}
            <button type="submit" class="btn btn-primary" title="Simpan">
                <i data-feather="plus-circle"></i>
            </button>

            {{-- Batal --}}
            <a href="{{ route('admin.media.index') }}" class="btn btn-secondary" title="Batal">
                <i data-feather="x-circle"></i>
            </a>
        </div>
    </form>
</div>

{{-- Feather icons --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if(typeof feather !== 'undefined') feather.replace();
    });
</script>
@endpush
@endsection
