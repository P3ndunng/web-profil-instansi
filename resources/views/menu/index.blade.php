@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Manajemen Menu</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tombol Tambah Hanya Icon & Biru -->
    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary mb-3 btn-icon" title="Tambah Menu"
       style="padding: 0.375rem; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
        <i data-feather="plus-circle"></i>
    </a>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Menu</th>
                            <th>Link</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th>Target</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $menu)
                            @if(is_null($menu->parent_id))
                                <!-- Menu Utama -->
                                <tr class="fw-bold bg-light">
                                    <td>
                                        <i class="{{ $menu->icon ?: 'bi bi-menu-button-wide' }}"></i>
                                        {{ $menu->nama }}
                                    </td>
                                    <td>
                                        <code>{{ $menu->link ?: '#' }}</code>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $menu->urutan }}</span>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                   onchange="toggleStatus({{ $menu->id }})"
                                                   {{ $menu->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $menu->target }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <!-- Tombol Edit Hanya Icon & Kuning -->
                                            <a href="{{ route('admin.menu.edit', $menu) }}" class="btn btn-warning btn-sm btn-icon" title="Edit"
                                               style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                                                <i data-feather="edit"></i>
                                            </a>

                                            <!-- Tombol Hapus Hanya Icon & Merah -->
                                            <button type="button" class="btn btn-danger btn-sm btn-icon" title="Hapus"
                                                    onclick="deleteMenu({{ $menu->id }})"
                                                    style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Sub Menu -->
                                @foreach($menu->children as $child)
                                    <tr>
                                        <td class="ps-4">
                                            <i class="bi bi-arrow-return-right text-muted me-2"></i>
                                            <i class="{{ $child->icon ?: 'bi bi-dot' }}"></i>
                                            {{ $child->nama }}
                                        </td>
                                        <td>
                                            <code>{{ $child->link ?: '#' }}</code>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $child->urutan }}</span>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                       onchange="toggleStatus({{ $child->id }})"
                                                       {{ $child->is_active ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    {{ $child->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $child->target }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <!-- Tombol Edit Hanya Icon & Kuning -->
                                                <a href="{{ route('admin.menu.edit', $child) }}" class="btn btn-warning btn-sm btn-icon" title="Edit"
                                                   style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Tombol Hapus Hanya Icon & Merah -->
                                                <button type="button" class="btn btn-danger btn-sm btn-icon" title="Hapus"
                                                        onclick="deleteMenu({{ $child->id }})"
                                                        style="padding: 0.25rem; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada menu. <a href="{{ route('admin.menu.create') }}">Tambah menu pertama</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Form delete tersembunyi -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- Form toggle status tersembunyi -->
<form id="toggleForm" method="POST" style="display: none;">
    @csrf
    @method('PATCH')
</form>

@endsection

@push('scripts')
<script>
function deleteMenu(id) {
    if (confirm('Apakah Anda yakin ingin menghapus menu ini? Semua sub menu akan ikut terhapus.')) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/menu/${id}`;
        form.submit();
    }
}

function toggleStatus(id) {
    const form = document.getElementById('toggleForm');
    form.action = `/admin/menu/${id}/toggle`;
    form.submit();
}

// Inisialisasi Feather Icons
document.addEventListener('DOMContentLoaded', function() {
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
});
</script>
@endpush
