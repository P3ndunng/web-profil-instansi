<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Info;
use App\Models\Galeri; // <-- tambahkan ini
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        // Ambil semua slider
        $sliders = Slider::all();

        // Ambil 6 berita terbaru
        $beritaTerbaru = Info::where('kategori_id', 1)
            ->latest()
            ->take(6)
            ->get();

        // Ambil 6 galeri terbaru
        $galeris = Galeri::latest()->take(6)->get();

        return view('beranda', compact('sliders', 'beritaTerbaru', 'galeris'));
    }
}
