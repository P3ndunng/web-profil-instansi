@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="container mt-4">
  <h2>Manajemen User</h2>

  {{-- Notifikasi sukses --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Tombol Tambah --}}
  <div class="mb-3">
    <a href="{{ route('users.create') }}" class="btn btn-primary">
      <i data-feather="plus-circle" class="icon-xs"></i> Tambah User
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
            <td>
              <div class="d-flex gap-2">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Edit">
                  <i data-feather="edit" class="icon-xs"></i>
                </a>

                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                    <i data-feather="trash-2" class="icon-xs"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">Tidak ada data user.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<script>
    // Inisialisasi Feather Icons untuk konten yang dinamis
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endsection
