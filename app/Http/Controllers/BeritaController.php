<?php

namespace App\Http\Controllers;

use App\Models\Info; // Gunakan model Info, bukan Berita
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // List semua berita untuk halaman publik
    public function index()
    {
        $beritas = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Berita'))
            ->latest()
            ->paginate(9);

        return view('infoP.berita', compact('beritas'));
    }

    // Detail berita untuk halaman publik (opsional)
    public function show($id)
    {
        $berita = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Berita'))
            ->findOrFail($id);

        return view('infoP.berita-detail', compact('berita'));
    }
}
