<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    // ========================
    // BERITA PUBLIK
    // ========================
    public function beritaPublik()
    {
        $beritas = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Berita'))
            ->latest()
            ->paginate(9);

        return view('infoP.berita', compact('beritas'));
    }

    // ========================
    // ADMIN BERITA
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
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'tanggal' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['judul','isi','tanggal']);
        $data['kategori_id'] = Kategori::where('nama','Berita')->first()->id ?? null;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Info::create($data);
        return redirect()->route('admin.berita.index')->with('success','Berita berhasil ditambahkan');
    }

    public function editBerita($id)
    {
        $item = Info::findOrFail($id);
        return view('infos.berita.edit', compact('item'));
    }

    public function updateBerita(Request $request, $id)
    {
        $item = Info::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'tanggal' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['judul','isi','tanggal']);

        if ($request->hasFile('gambar')) {
            if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $item->update($data);
        return redirect()->route('admin.berita.index')->with('success','Berita berhasil diperbarui');
    }

    public function destroyBerita($id)
    {
        $item = Info::findOrFail($id);

        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }

        $item->delete();
        return redirect()->route('admin.berita.index')->with('success','Berita berhasil dihapus');
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

        $kategori = Kategori::where('nama','Agenda')->first();
        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori Agenda tidak ditemukan.');
        }

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

        $kategori = Kategori::where('nama','Artikel')->first();
        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori Artikel tidak ditemukan.');
        }

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
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
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'tanggal' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $kategori = Kategori::where('nama', 'Pengumuman')->first();
        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori Pengumuman tidak ditemukan.');
        }

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'kategori_id' => $kategori->id,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        Info::create($data);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function editPengumuman($id)
    {
        $item = Info::findOrFail($id);
        return view('infos.pengumuman.edit', compact('item'));
    }

    public function updatePengumuman(Request $request, $id)
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
            $data['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroyPengumuman($id)
    {
        $item = Info::findOrFail($id);

        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }

        $item->delete();

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus');
    }


}
