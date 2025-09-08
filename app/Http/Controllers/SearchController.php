<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $results = [];

        // Validasi minimal 2 karakter
        if (strlen($query) >= 2) {
            // Search dalam Menu
            $menuResults = Menu::where('nama', 'like', "%{$query}%")
                ->where('is_active', true)
                ->limit(5)
                ->get()
                ->map(function($menu) {
                    return [
                        'title' => $menu->nama,
                        'description' => 'Menu navigasi - ' . $menu->nama,
                        'category' => 'Menu',
                        'url' => $menu->link ?: '#'
                    ];
                });

            $results = array_merge($results, $menuResults->toArray());

            // Tambahkan pencarian untuk model lain jika ada
            /*
            // Search dalam Articles (uncomment jika sudah ada model Article)
            try {
                if (class_exists('App\Models\Article')) {
                    $articles = \App\Models\Article::where('title', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%")
                        ->where('is_published', true)
                        ->limit(10)
                        ->get()
                        ->map(function($article) {
                            return [
                                'title' => $article->title,
                                'description' => Str::limit(strip_tags($article->content), 150),
                                'category' => 'Artikel',
                                'url' => route('articles.show', $article->slug)
                            ];
                        });

                    $results = array_merge($results, $articles->toArray());
                }
            } catch (\Exception $e) {
                // Model tidak ada atau error, skip
            }

            // Search dalam News (uncomment jika sudah ada model News)
            try {
                if (class_exists('App\Models\News')) {
                    $news = \App\Models\News::where('title', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%")
                        ->where('is_published', true)
                        ->limit(10)
                        ->get()
                        ->map(function($item) {
                            return [
                                'title' => $item->title,
                                'description' => Str::limit(strip_tags($item->content), 150),
                                'category' => 'Berita',
                                'url' => route('news.show', $item->slug)
                            ];
                        });

                    $results = array_merge($results, $news->toArray());
                }
            } catch (\Exception $e) {
                // Model tidak ada atau error, skip
            }
            */

            // Contoh pencarian statis untuk demo
            $staticResults = [
                [
                    'title' => 'Profil Instansi',
                    'description' => 'Informasi lengkap tentang profil dan sejarah instansi',
                    'category' => 'Halaman',
                    'url' => '/profil'
                ],
                [
                    'title' => 'Layanan Publik',
                    'description' => 'Berbagai layanan publik yang tersedia untuk masyarakat',
                    'category' => 'Layanan',
                    'url' => '/layanan'
                ],
                [
                    'title' => 'Berita Terbaru',
                    'description' => 'Informasi dan berita terkini dari instansi',
                    'category' => 'Berita',
                    'url' => '/berita'
                ],
                [
                    'title' => 'Kontak Kami',
                    'description' => 'Informasi kontak dan alamat lengkap instansi',
                    'category' => 'Kontak',
                    'url' => '/kontak'
                ],
                [
                    'title' => 'Visi dan Misi',
                    'description' => 'Visi, misi, dan tujuan organisasi',
                    'category' => 'Profil',
                    'url' => '/visi-misi'
                ],
                [
                    'title' => 'Struktur Organisasi',
                    'description' => 'Bagan struktur organisasi dan pejabat',
                    'category' => 'Profil',
                    'url' => '/struktur'
                ],
                [
                    'title' => 'Galeri Foto',
                    'description' => 'Kumpulan foto kegiatan dan dokumentasi',
                    'category' => 'Media',
                    'url' => '/galeri'
                ],
                [
                    'title' => 'Pengumuman',
                    'description' => 'Pengumuman dan informasi penting',
                    'category' => 'Informasi',
                    'url' => '/pengumuman'
                ]
            ];

            // Filter berdasarkan query
            $filteredResults = array_filter($staticResults, function($item) use ($query) {
                return stripos($item['title'], $query) !== false || 
                       stripos($item['description'], $query) !== false ||
                       stripos($item['category'], $query) !== false;
            });

            // Gabungkan hasil
            $results = array_merge($results, array_values($filteredResults));

            // Limit total hasil
            $results = array_slice($results, 0, 15);
        }

        return response()->json([
            'query' => $query,
            'results' => $results,
            'total' => count($results),
            'message' => count($results) > 0 ? 'Pencarian berhasil' : 'Tidak ada hasil ditemukan untuk "' . $query . '"'
        ]);
    }
}