<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Info;

class BerandaController extends Controller
{
    public function index()
    {
        // Data galeri yang sudah ada
        $galeris = Galeri::orderBy('id', 'desc')->get();

        // Ambil 6 berita terbaru untuk ditampilkan di beranda
        $beritaTerbaru = Info::whereHas('kategori', fn($q) => $q->where('nama', 'Berita'))
            ->latest()
            ->take(6)
            ->get();

        return view('beranda', compact('galeris', 'beritaTerbaru'));
    }
}
