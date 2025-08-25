@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="container mt-4">
  <h2>Manajemen User</h2>

  {{-- Notifikasi sukses --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Tombol Tambah Hanya Icon & Biru --}}
  <div class="mb-3">
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-icon" title="Tambah User"
       style="padding: 0.375rem; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
      <i data-feather="plus-circle"></i>
    </a>
  </div>

  {{-- Tabel Data User --}}
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead class="table-dark">
        <tr>
          <th width="5%">No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th width="100">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $index => $user)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-1">
                {{-- Tombol Edit Hanya Icon & Kuning --}}
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm btn-icon" title="Edit"
                   style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                  <i data-feather="edit"></i>
                </a>

                {{-- Tombol Hapus Hanya Icon & Merah --}}
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Hapus"
                          style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                    <i data-feather="trash-2"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center text-muted">Tidak ada data user.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
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
