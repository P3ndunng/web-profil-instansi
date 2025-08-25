<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Tanggal</th>
            <th width="100">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($items as $info)
        <tr>
            <td>{{ $info->judul }}</td>
            <td>{{ $info->kategori->nama }}</td>
            <td>{{ $info->created_at->format('d-m-Y') }}</td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('infos.edit', $info->id) }}" class="btn btn-sm btn-warning" title="Edit">
                        <i data-feather="edit" class="icon-xs"></i>
                    </a>
                    <form action="{{ route('infos.destroy', $info->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
            <td colspan="4" class="text-center">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<script>
    // Inisialisasi Feather Icons untuk konten yang dinamis
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
