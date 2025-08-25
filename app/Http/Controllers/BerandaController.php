<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class BerandaController extends Controller
{
    public function index()
    {
        $galeris = Galeri::orderBy('id', 'desc')->get();
        return view('beranda', compact('galeris'));
    }
}
