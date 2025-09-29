<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    // =======================
    // ADMIN / INTERNAL
    // =======================
    public function index()
    {
        $items = Artikel::orderBy('created_at', 'desc')->paginate(10);
        return view('infos.artikel.index', compact('items'));
    }

    public function create()
    {
        return view('infos.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'isi'     => 'required',
            'tanggal' => 'nullable|date',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
            $data['gambar'] = $file->storeAs('artikel', $filename, 'public');
        }

        Artikel::create($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = Artikel::findOrFail($id);
        return view('infos.artikel.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'isi'     => 'required',
            'tanggal' => 'nullable|date',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $artikel = Artikel::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
            $data['gambar'] = $file->storeAs('artikel', $filename, 'public');
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    // =======================
    // PUBLIK
    // =======================
    public function artikelPublik()
    {
        // Tetap menggunakan $artikels (sesuai semantik untuk artikel)
        $artikels = Artikel::orderBy('created_at', 'desc')->paginate(9);
        return view('infoP.artikel', compact('artikels'));
    }

    public function detail($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikelLainnya = Artikel::where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('infoP.artikel-detail', compact('artikel', 'artikelLainnya'));
    }
}
