<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // List semua berita
    public function index()
    {
        $beritas = Berita::latest()->paginate(9);
        return view('infoP.berita', compact('beritas'));
    }
}
