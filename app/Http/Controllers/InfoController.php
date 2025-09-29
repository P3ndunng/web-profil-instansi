<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class InfoController extends Controller
{
    // ========================
    // BERITA PUBLIK - untuk BeritaController
    // ========================
    public function beritaPublik()
    {
        $beritas = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Berita'))
            ->latest()
            ->paginate(9);

        return view('infoP.berita', compact('beritas'));
    }

    // ========================
    // PENGUMUMAN PUBLIK - untuk halaman pengumuman publik
    // ========================
    public function pengumumanPublik()
    {
        $pengumumen = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Pengumuman'))
            ->latest()
            ->paginate(9);

        return view('infoP.pengumuman', compact('pengumumen'));
    }

    // ========================
    // ARTIKEL PUBLIK
    // ========================
    public function artikelPublik()
    {
        $artikels = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Artikel'))
            ->latest()
            ->paginate(9);

        return view('infoP.artikel', compact('artikels'));
    }

    // ========================
    // DETAIL METHODS
    // ========================
    public function detailBerita($id)
    {
        $berita = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Berita'))
            ->findOrFail($id);

        return view('infoP.berita.detail', compact('berita'));
    }

    public function detailPengumuman($id)
    {
        $pengumuman = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Pengumuman'))
            ->findOrFail($id);

        return view('infoP.pengumuman.detail', compact('pengumuman'));
    }

    public function detailArtikel($id)
    {
        $artikel = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Artikel'))
            ->findOrFail($id);

        return view('infoP.artikel.detail', compact('artikel'));
    }

    // ========================
    // ADMIN BERITA - untuk Dashboard
    // ========================
    public function indexBerita()
    {
        $items = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Berita'))
            ->latest()
            ->get();

        return view('infos.berita.index', compact('items'));
    }

    public function createBerita()
    {
        return view('infos.berita.create');
    }

    public function storeBerita(Request $request)
    {
        try {
            // Log untuk debugging
            Log::info('Store Berita dimulai', ['data' => $request->all()]);

            // Validasi
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'isi' => 'required|string',
                'tanggal' => 'nullable|date',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            Log::info('Validasi berhasil');

            // Cari atau buat kategori Berita
            $kategori = Kategori::where('nama', 'Berita')->first();

            if (!$kategori) {
                Log::info('Kategori Berita tidak ada, membuat baru');
                $kategori = Kategori::create([
                    'nama' => 'Berita',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            Log::info('Kategori ditemukan/dibuat', ['kategori_id' => $kategori->id]);

            // Siapkan data untuk disimpan
            $data = [
                'judul' => $validated['judul'],
                'isi' => $validated['isi'],
                'tanggal' => $validated['tanggal'] ?? now(),
                'kategori_id' => $kategori->id,
            ];

            // Handle upload gambar jika ada
            if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
                Log::info('Memproses upload gambar');
                $data['gambar'] = $request->file('gambar')->store('berita', 'public');
                Log::info('Gambar berhasil diupload', ['path' => $data['gambar']]);
            }

            Log::info('Data siap disimpan', $data);

            // Simpan ke database
            $berita = Info::create($data);

            if ($berita) {
                Log::info('Berita berhasil disimpan', ['id' => $berita->id]);
                return redirect()->route('admin.berita.index')
                    ->with('success', 'Berita berhasil ditambahkan');
            }

            throw new \Exception('Gagal menyimpan ke database');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error', ['errors' => $e->errors()]);
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Error saat menyimpan berita', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function editBerita($id)
    {
        $item = Info::findOrFail($id);
        return view('infos.berita.edit', compact('item'));
    }

    public function updateBerita(Request $request, $id)
    {
        try {
            $item = Info::findOrFail($id);

            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'isi' => 'required|string',
                'tanggal' => 'nullable|date',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $data = [
                'judul' => $validated['judul'],
                'isi' => $validated['isi'],
                'tanggal' => $validated['tanggal'],
            ];

            if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
                // Hapus gambar lama
                if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                    Storage::disk('public')->delete($item->gambar);
                }
                $data['gambar'] = $request->file('gambar')->store('berita', 'public');
            }

            $item->update($data);

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil diperbarui');

        } catch (\Exception $e) {
            Log::error('Error update berita', ['message' => $e->getMessage(), 'id' => $id]);
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroyBerita($id)
    {
        try {
            $item = Info::findOrFail($id);

            // Hapus gambar jika ada
            if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }

            $item->delete();

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil dihapus');

        } catch (\Exception $e) {
            Log::error('Error hapus berita', ['message' => $e->getMessage(), 'id' => $id]);
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ========================
    // ADMIN PENGUMUMAN
    // ========================
    public function indexPengumuman()
    {
        $items = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Pengumuman'))
            ->latest()
            ->get();

        return view('infos.pengumuman.index', compact('items'));
    }

    public function createPengumuman()
    {
        return view('infos.pengumuman.create');
    }

    public function storePengumuman(Request $request)
    {
        try {
            // Validasi
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'isi' => 'required|string',
                'tanggal' => 'nullable|date',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Cari atau buat kategori Pengumuman
            $kategori = Kategori::firstOrCreate(['nama' => 'Pengumuman']);

            $data = [
                'judul' => $validated['judul'],
                'isi' => $validated['isi'],
                'tanggal' => $validated['tanggal'] ?: now(),
                'kategori_id' => $kategori->id,
            ];

            if ($request->hasFile('gambar')) {
                $data['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
            }

            Info::create($data);

            return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan');

        } catch (\Exception $e) {
            Log::error('Error store pengumuman', ['message' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function editPengumuman($id)
    {
        $item = Info::findOrFail($id);
        return view('infos.pengumuman.edit', compact('item'));
    }

    public function updatePengumuman(Request $request, $id)
    {
        try {
            $item = Info::findOrFail($id);

            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'isi' => 'required|string',
                'tanggal' => 'nullable|date',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $data = [
                'judul' => $validated['judul'],
                'isi' => $validated['isi'],
                'tanggal' => $validated['tanggal'],
            ];

            if ($request->hasFile('gambar')) {
                if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                    Storage::disk('public')->delete($item->gambar);
                }
                $data['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
            }

            $item->update($data);

            return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui');

        } catch (\Exception $e) {
            Log::error('Error update pengumuman', ['message' => $e->getMessage(), 'id' => $id]);
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroyPengumuman($id)
    {
        try {
            $item = Info::findOrFail($id);

            if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }

            $item->delete();

            return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus');

        } catch (\Exception $e) {
            Log::error('Error hapus pengumuman', ['message' => $e->getMessage(), 'id' => $id]);
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ========================
    // ADMIN AGENDA
    // ========================
    public function indexAgenda()
    {
        $items = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Agenda'))
            ->latest()->get();
        return view('infos.agenda.index', compact('items'));
    }

    public function createAgenda()
    {
        return view('infos.agenda.create');
    }

    public function storeAgenda(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_kegiatan' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $kategori = Kategori::firstOrCreate(['nama' => 'Agenda']);

        $data = [
            'judul' => $request->nama_kegiatan,
            'isi' => $request->tempat,
            'tanggal' => $request->tanggal,
            'kategori_id' => $kategori->id,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('agenda', 'public');
        }

        Info::create($data);

        return redirect()->route('admin.agenda.index')->with('success','Agenda berhasil ditambahkan');
    }

    public function editAgenda($id)
    {
        $item = Info::findOrFail($id);
        return view('infos.agenda.edit', compact('item'));
    }

    public function updateAgenda(Request $request, $id)
    {
        $item = Info::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'nama_kegiatan' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'judul' => $request->nama_kegiatan,
            'isi' => $request->tempat,
            'tanggal' => $request->tanggal,
        ];

        if ($request->hasFile('gambar')) {
            if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('agenda', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.agenda.index')->with('success','Agenda berhasil diperbarui');
    }

    public function destroyAgenda($id)
    {
        $item = Info::findOrFail($id);

        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }

        $item->delete();

        return redirect()->route('admin.agenda.index')->with('success','Agenda berhasil dihapus');
    }

    // ========================
    // ADMIN ARTIKEL
    // ========================
    public function indexArtikel()
    {
        $items = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Artikel'))
            ->latest()->get();
        return view('infos.artikel.index', compact('items'));
    }

    public function createArtikel()
    {
        return view('infos.artikel.create');
    }

    public function storeArtikel(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'tanggal' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $kategori = Kategori::firstOrCreate(['nama' => 'Artikel']);

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal ?: now(),
            'kategori_id' => $kategori->id,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        Info::create($data);

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil ditambahkan');
    }

    public function editArtikel($id)
    {
        $item = Info::findOrFail($id);
        return view('infos.artikel.edit', compact('item'));
    }

    public function updateArtikel(Request $request, $id)
    {
        $item = Info::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'tanggal' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
        ];

        if ($request->hasFile('gambar')) {
            if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil diperbarui');
    }

    public function destroyArtikel($id)
    {
        $item = Info::findOrFail($id);

        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }

        $item->delete();

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil dihapus');
    }
}
