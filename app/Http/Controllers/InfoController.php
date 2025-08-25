<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Kategori;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    // =======================
    // DASHBOARD CRUD
    // =======================
    public function index()
    {
        $infos = Info::with('kategori')->latest()->get();
        return view('infos.index', compact('infos'));
    }

    public function create(Request $request)
    {
        $kategoris = Kategori::all();
        $selectedKategori = $request->get('kategori');

        // Jika parameter kategori ada, tampilkan form khusus
        if ($selectedKategori) {
            $viewName = 'infos.create-' . strtolower($selectedKategori);

            // Pastikan view exists
            if (view()->exists($viewName)) {
                // Untuk agenda, kita perlu pastikan kategori agenda ada
                if ($selectedKategori === 'Agenda') {
                    $agendaKategori = Kategori::where('nama', 'Agenda')->first();

                    if (!$agendaKategori) {
                        return redirect()->route('infos.index')
                            ->with('error', 'Kategori Agenda tidak ditemukan. Silahkan buat kategori Agenda terlebih dahulu.');
                    }

                    return view($viewName, compact('kategoris', 'agendaKategori'));
                }

                return view($viewName, compact('kategoris'));
            }
        }

        return view('infos.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'isi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Dapatkan kategori untuk validasi tambahan
        $kategori = Kategori::find($request->kategori_id);

        if (!$kategori) {
            return redirect()->back()
                ->with('error', 'Kategori tidak valid.')
                ->withInput();
        }

        // Validasi khusus untuk agenda
        if ($kategori->nama == 'Agenda') {
            $request->validate([
                'tanggal' => 'required|date',
                'tempat' => 'required|string|max:255',
            ]);
        }

        $data = $request->only('kategori_id', 'judul', 'isi');

        // Tambahkan field khusus untuk agenda
        if ($kategori->nama == 'Agenda') {
            $data['tanggal'] = $request->tanggal;
            $data['tempat'] = $request->tempat;
        }

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar_info', 'public');
        }

        // Buat info
        $info = Info::create($data);

        // Jika kategori adalah Berita, buat juga di tabel berita
        if ($info->kategori->nama == 'Berita') {
            Berita::create([
                'judul' => $info->judul,
                'isi' => $info->isi,
                'gambar' => $info->gambar,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect()->route('infos.index')->with('success', 'Info berhasil ditambahkan.');
    }

    public function edit(Request $request, $id)
    {
        try {
            // Gunakan findOrFail untuk menghindari null
            $info = Info::with('kategori')->findOrFail($id);
            $kategoris = Kategori::all();

            // Pastikan kategori tidak null
            if ($info->kategori && $info->kategori->nama === 'Agenda') {
                $viewName = 'infos.edit-agenda';
                if (view()->exists($viewName)) {
                    return view($viewName, compact('info', 'kategoris'));
                }
            }

            return view('infos.edit', compact('info', 'kategoris'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('infos.index')
                ->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Gunakan findOrFail untuk menghindari null
            $info = Info::findOrFail($id);

            // Validasi dasar
            $request->validate([
                'kategori_id' => 'required|exists:kategoris,id',
                'judul' => 'required|string|max:255',
                'isi' => 'nullable|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Dapatkan kategori untuk validasi tambahan
            $kategori = Kategori::find($request->kategori_id);

            if (!$kategori) {
                return redirect()->back()
                    ->with('error', 'Kategori tidak valid.')
                    ->withInput();
            }

            // Validasi khusus untuk agenda
            if ($kategori->nama == 'Agenda') {
                $request->validate([
                    'tanggal' => 'required|date',
                    'tempat' => 'required|string|max:255',
                ]);
            }

            // Simpan judul lama untuk pencarian di tabel berita
            $judulLama = $info->judul;

            $data = $request->only('kategori_id', 'judul', 'isi');

            // Tambahkan field khusus untuk agenda
            if ($kategori->nama == 'Agenda') {
                $data['tanggal'] = $request->tanggal;
                $data['tempat'] = $request->tempat;
            } else {
                // Hapus field khusus agenda jika kategori diubah
                $data['tanggal'] = null;
                $data['tempat'] = null;
            }

            // Upload gambar baru jika ada
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($info->gambar) {
                    Storage::disk('public')->delete($info->gambar);
                }
                $data['gambar'] = $request->file('gambar')->store('gambar_info', 'public');
            }

            // Update info
            $info->update($data);

            // Update juga di tabel berita jika kategori adalah Berita
            if ($kategori->nama == 'Berita') {
                $berita = Berita::where('judul', $judulLama)->first();

                if ($berita) {
                    $berita->update([
                        'judul' => $info->judul,
                        'isi' => $info->isi,
                        'gambar' => $info->gambar
                    ]);
                } else {
                    // Jika tidak ditemukan, buat entri baru
                    Berita::create([
                        'judul' => $info->judul,
                        'isi' => $info->isi,
                        'gambar' => $info->gambar,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            } else {
                // Jika kategori diubah dari Berita ke lainnya, hapus dari tabel berita
                $berita = Berita::where('judul', $judulLama)->first();
                if ($berita) {
                    $berita->delete();
                }
            }

            return redirect()->route('infos.index')->with('success', 'Info berhasil diperbarui.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('infos.index')
                ->with('error', 'Data tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            // Gunakan findOrFail untuk menghindari null
            $info = Info::with('kategori')->findOrFail($id);

            // Hapus juga dari tabel berita jika ada
            if ($info->kategori && $info->kategori->nama == 'Berita') {
                $berita = Berita::where('judul', $info->judul)->first();
                if ($berita) {
                    $berita->delete();
                }
            }

            // Hapus gambar jika ada
            if ($info->gambar) {
                Storage::disk('public')->delete($info->gambar);
            }

            $info->delete();

            return redirect()->route('infos.index')->with('success', 'Info berhasil dihapus.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('infos.index')
                ->with('error', 'Data tidak ditemukan.');
        }
    }

    // =======================
    // METHOD BANTUAN: Pastikan Kategori Agenda Ada
    // =======================
    public function ensureAgendaCategory()
    {
        $agendaKategori = Kategori::where('nama', 'Agenda')->first();

        if (!$agendaKategori) {
            $agendaKategori = Kategori::create([
                'nama' => 'Agenda',
                'deskripsi' => 'Kategori untuk agenda kegiatan'
            ]);

            return $agendaKategori;
        }

        return $agendaKategori;
    }
}
