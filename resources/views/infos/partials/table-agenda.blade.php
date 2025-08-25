<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th style="width: 50px;">No</th>
                <th>Judul Agenda</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th style="width: 120px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $agenda)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $agenda->judul }}</td>
                <td>{{ $agenda->tanggal }}</td>
                <td>{{ $agenda->lokasi }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('agenda.edit', $agenda->id) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i data-feather="edit" class="icon-xs"></i>
                        </a>
                        <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
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
                <td colspan="5" class="text-center">Belum ada data agenda.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
