<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::all();
        return view('media.index', compact('media'));
    }

    public function create()
    {
        return view('media.creat');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4,avi,pdf,docx',
            'tipe' => 'nullable',
        ]);

        $path = $request->file('file')->store('media', 'public');

        Media::create([
            'judul' => $request->judul,
            'file' => $path,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('media.index')->with('success', 'Media berhasil ditambahkan');
    }

    public function edit(Media $media)
    {
        return view('media.edit', compact('media'));
    }

    public function update(Request $request, Media $media)
    {
        $request->validate([
            'judul' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,pdf,docx',
            'tipe' => 'nullable',
        ]);

        $data = $request->only(['judul', 'tipe']);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('media', 'public');
        }

        $media->update($data);

        return redirect()->route('media.index')->with('success', 'Media berhasil diupdate');
    }

    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->route('media.index')->with('success', 'Media berhasil dihapus');
    }
}
