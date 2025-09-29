<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Info;
use App\Models\Galeri;
use App\Models\Artikel;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        // Ambil semua slider
        $sliders = Slider::all();

        // Ambil 6 berita terbaru berdasarkan nama kategori
        $beritaTerbaru = Info::whereHas('kategori', function($query) {
            $query->where('nama', 'Berita');
        })->latest()->take(6)->get();

        // Ambil 6 pengumuman terbaru berdasarkan nama kategori
        $pengumumanTerbaru = Info::whereHas('kategori', function($query) {
            $query->where('nama', 'Pengumuman');
        })->latest()->take(6)->get();

        // Ambil 6 agenda terbaru berdasarkan nama kategori
        $agendaTerbaru = Info::whereHas('kategori', function($query) {
            $query->where('nama', 'Agenda');
        })->latest()->take(6)->get();

        // Ambil 6 artikel terbaru berdasarkan nama kategori
        $artikelTerbaru = Info::whereHas('kategori', function($query) {
            $query->where('nama', 'Artikel');
        })->latest()->take(6)->get();

        // Ambil 6 galeri terbaru
        $galeris = Galeri::latest()->take(6)->get();

        return view('beranda', compact(
            'sliders',
            'beritaTerbaru',
            'pengumumanTerbaru',
            'agendaTerbaru',
            'artikelTerbaru',
            'galeris'
        ));
    }
}
