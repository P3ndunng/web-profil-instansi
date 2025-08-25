<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::all();
        return view('media.index', compact('media')); // Tetap menggunakan view di root media
    }

    public function create()
    {
        return view('media.create'); // Tetap menggunakan view di root media
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4,avi,pdf,docx|max:10240', // max 10MB
        ]);

        $file = $request->file('file');
        $path = $file->store('media', 'public');

        Media::create([
            'judul' => $request->judul,
            'file' => $path,
            'tipe' => $file->getClientOriginalExtension(), // otomatis isi tipe
        ]);

        return redirect()->route('admin.media.index')->with('success', 'Media berhasil ditambahkan');
    }

    public function edit(Media $media)
    {
        return view('media.edit', compact('media')); // Tetap menggunakan view di root media
    }

    public function update(Request $request, Media $media)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,pdf,docx|max:10240',
        ]);

        $data = $request->only('judul');

        if ($request->hasFile('file')) {
            // hapus file lama
            if ($media->file && Storage::disk('public')->exists($media->file)) {
                Storage::disk('public')->delete($media->file);
            }

            $file = $request->file('file');
            $path = $file->store('media', 'public');

            $data['file'] = $path;
            $data['tipe'] = $file->getClientOriginalExtension(); // otomatis update tipe
        }

        $media->update($data);

        return redirect()->route('admin.media.index')->with('success', 'Media berhasil diupdate');
    }

    public function destroy(Media $media)
    {
        if ($media->file && Storage::disk('public')->exists($media->file)) {
            Storage::disk('public')->delete($media->file);
        }

        $media->delete();
        return redirect()->route('admin.media.index')->with('success', 'Media berhasil dihapus');
    }
}
