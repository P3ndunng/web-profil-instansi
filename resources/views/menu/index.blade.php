@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Manajemen Menu</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-block-helper me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Alert untuk notifikasi AJAX -->
    <div id="ajaxAlert" class="alert alert-dismissible fade" role="alert" style="display: none;">
        <span id="ajaxAlertMessage"></span>
        <button type="button" class="btn-close" onclick="closeAjaxAlert()"></button>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Daftar Menu</h4>
                        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-plus me-1"></i> Tambah Menu
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Menu</th>
                                    <th>Link</th>
                                    <th style="width: 80px;">Urutan</th>
                                    <th style="width: 150px;">Status</th>
                                    <th style="width: 100px;">Target</th>
                                    <th style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menus as $menu)
                                    @if(is_null($menu->parent_id))
                                        <!-- Menu Utama -->
                                        <tr class="fw-bold bg-light">
                                            <td>
                                                <i class="{{ $menu->icon ?: 'mdi mdi-menu' }}"></i>
                                                {{ $menu->nama }}
                                            </td>
                                            <td>
                                                <code class="text-primary">{{ $menu->link ?: '#' }}</code>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary">{{ $menu->urutan }}</span>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-switch-md">
                                                    <input class="form-check-input toggle-status"
                                                           type="checkbox"
                                                           data-menu-id="{{ $menu->id }}"
                                                           {{ $menu->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label" id="label-{{ $menu->id }}">
                                                        {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-soft-info">{{ $menu->target }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.menu.edit', $menu) }}"
                                                       class="btn btn-warning btn-sm"
                                                       title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-danger btn-sm"
                                                            title="Hapus"
                                                            onclick="deleteMenu({{ $menu->id }})">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Sub Menu -->
                                        @foreach($menu->children as $child)
                                            <tr>
                                                <td class="ps-4">
                                                    <i class="mdi mdi-subdirectory-arrow-right text-muted me-2"></i>
                                                    <i class="{{ $child->icon ?: 'mdi mdi-circle-small' }}"></i>
                                                    {{ $child->nama }}
                                                </td>
                                                <td>
                                                    <code class="text-primary">{{ $child->link ?: '#' }}</code>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-secondary">{{ $child->urutan }}</span>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch form-switch-md">
                                                        <input class="form-check-input toggle-status"
                                                               type="checkbox"
                                                               data-menu-id="{{ $child->id }}"
                                                               {{ $child->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label" id="label-{{ $child->id }}">
                                                            {{ $child->is_active ? 'Aktif' : 'Nonaktif' }}
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-soft-info">{{ $child->target }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('admin.menu.edit', $child) }}"
                                                           class="btn btn-warning btn-sm"
                                                           title="Edit">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-danger btn-sm"
                                                                title="Hapus"
                                                                onclick="deleteMenu({{ $child->id }})">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-2"></i>
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
    </div>
</div>

<!-- Form delete tersembunyi -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
// Fungsi untuk menampilkan alert AJAX
function showAjaxAlert(message, type = 'success') {
    const alert = document.getElementById('ajaxAlert');
    const alertMessage = document.getElementById('ajaxAlertMessage');

    const icon = type === 'success' ? 'mdi-check-all' : 'mdi-alert-circle-outline';
    alertMessage.innerHTML = `<i class="mdi ${icon} me-2"></i>${message}`;
    alert.className = `alert alert-${type} alert-dismissible fade show`;
    alert.style.display = 'block';

    // Auto close setelah 3 detik
    setTimeout(() => {
        closeAjaxAlert();
    }, 3000);
}

function closeAjaxAlert() {
    const alert = document.getElementById('ajaxAlert');
    alert.style.display = 'none';
}

// Toggle status dengan AJAX
document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk semua toggle switch
    document.querySelectorAll('.toggle-status').forEach(function(toggle) {
        toggle.addEventListener('change', function() {
            const menuId = this.getAttribute('data-menu-id');
            const isChecked = this.checked;
            const label = document.getElementById('label-' + menuId);
            const originalState = !isChecked;

            // Disable toggle sementara
            this.disabled = true;

            // Kirim request AJAX
            fetch(`/admin/menu/${menuId}/toggle`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    is_active: isChecked
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update label
                    label.textContent = isChecked ? 'Aktif' : 'Nonaktif';

                    // Tampilkan notifikasi sukses
                    showAjaxAlert(data.message || 'Status menu berhasil diubah', 'success');
                } else {
                    // Kembalikan toggle ke state semula jika gagal
                    toggle.checked = originalState;
                    showAjaxAlert(data.message || 'Gagal mengubah status menu', 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Kembalikan toggle ke state semula jika error
                toggle.checked = originalState;
                showAjaxAlert('Terjadi kesalahan saat mengubah status menu', 'danger');
            })
            .finally(() => {
                // Enable toggle kembali
                toggle.disabled = false;
            });
        });
    });
});

function deleteMenu(id) {
    if (confirm('Apakah Anda yakin ingin menghapus menu ini? Semua sub menu akan ikut terhapus.')) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/menu/${id}`;
        form.submit();
    }
}
</script>
@endpush
