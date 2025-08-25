@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah User</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Ups!</strong> Ada beberapa masalah dengan inputan Anda:<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" id="password" name="password" class="form-control" required minlength="6">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Ulangi Kata Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required minlength="6">
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left" class="icon-xs"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i data-feather="save" class="icon-xs"></i> Simpan
            </button>
        </div>
    </form>
</div>

<script>
    // Inisialisasi Feather Icons
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endsection
