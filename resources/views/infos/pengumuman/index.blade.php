@extends('layouts.app')

@section('title', 'Daftar Pengumuman')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Pengumuman</h5>
                    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary btn-sm">
                        <i data-feather="plus" class="icon-xs"></i> Tambah Pengumuman
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Isi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($item->gambar)
                                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                                     alt="{{ $item->judul }}"
                                                     class="img-thumbnail"
                                                     width="80">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ Str::limit($item->judul, 50) }}</strong>
                                        </td>
                                        <td>
                                            {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : 'Tidak ada tanggal' }}
                                        </td>
                                        <td>
                                            {{ Str::limit(strip_tags($item->isi), 100) }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.pengumuman.edit', $item->id) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i data-feather="edit-2" class="icon-xs"></i>
                                                </a>

                                                <form action="{{ route('admin.pengumuman.destroy', $item->id) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i data-feather="trash-2" class="icon-xs"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            Belum ada pengumuman
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endsection
