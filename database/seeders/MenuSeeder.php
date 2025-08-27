<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama jika ada
        Menu::truncate();

        // ================================
        // 1. MENU BERANDA
        // ================================
        $beranda = Menu::create([
            'nama' => 'BERANDA',
            'link' => '#beranda',
            'urutan' => 1,
            'parent_id' => null,
            'is_active' => true,
            'icon' => 'bi bi-house',
            'target' => '_self'
        ]);

        // ================================
        // 2. MENU PROFIL (dengan sub menu)
        // ================================
        $profil = Menu::create([
            'nama' => 'PROFIL',
            'link' => null, // kosong karena punya dropdown
            'urutan' => 2,
            'parent_id' => null,
            'is_active' => true,
            'icon' => 'bi bi-person-circle',
            'target' => '_self'
        ]);

        // Sub menu PROFIL
        $subMenusProfil = [
            ['nama' => 'TENTANG BBPTUHPT', 'link' => '/profil', 'urutan' => 1, 'icon' => 'bi bi-building'],
            ['nama' => 'STRUKTUR ORGANISASI', 'link' => '#struktur', 'urutan' => 2, 'icon' => 'bi bi-diagram-3'],
            ['nama' => 'SEJARAH', 'link' => '#sejarah', 'urutan' => 3, 'icon' => 'bi bi-clock-history'],
            ['nama' => 'VISI & MISI', 'link' => '#visi', 'urutan' => 4, 'icon' => 'bi bi-eye'],
            ['nama' => 'MOTO DAN JANJI LAYANAN', 'link' => '#moto', 'urutan' => 5, 'icon' => 'bi bi-heart'],
            ['nama' => 'TUGAS POKOK DAN FUNGSI', 'link' => '#tugas', 'urutan' => 6, 'icon' => 'bi bi-list-task'],
            ['nama' => 'PRESTASI', 'link' => '#prestasi', 'urutan' => 7, 'icon' => 'bi bi-trophy'],
            ['nama' => 'MAKLUMAT PELAYANAN', 'link' => '#maklumat', 'urutan' => 8, 'icon' => 'bi bi-file-text'],
            ['nama' => 'SDM', 'link' => '#sdm', 'urutan' => 9, 'icon' => 'bi bi-people'],
            ['nama' => 'KEBIJAKAN MUTU', 'link' => '#kebijakan', 'urutan' => 10, 'icon' => 'bi bi-shield-check'],
            ['nama' => 'GALLERY', 'link' => '#gallery', 'urutan' => 11, 'icon' => 'bi bi-images']
        ];

        foreach ($subMenusProfil as $subMenu) {
            Menu::create([
                'nama' => $subMenu['nama'],
                'link' => $subMenu['link'],
                'urutan' => $subMenu['urutan'],
                'parent_id' => $profil->id,
                'is_active' => true,
                'icon' => $subMenu['icon'],
                'target' => '_self'
            ]);
        }

        // ================================
        // 3. MENU LAYANAN (dengan sub menu)
        // ================================
        $layanan = Menu::create([
            'nama' => 'LAYANAN',
            'link' => null,
            'urutan' => 3,
            'parent_id' => null,
            'is_active' => true,
            'icon' => 'bi bi-gear',
            'target' => '_self'
        ]);

        // Sub menu LAYANAN
        Menu::create(['nama' => 'PRODUK KAMI', 'link' => '#produk', 'urutan' => 1, 'parent_id' => $layanan->id, 'is_active' => true, 'icon' => 'bi bi-box', 'target' => '_self']);
        Menu::create(['nama' => 'ALUR PEMBELIAN', 'link' => '#alur', 'urutan' => 2, 'parent_id' => $layanan->id, 'is_active' => true, 'icon' => 'bi bi-flow-chart', 'target' => '_self']);

        // Sub menu dengan nested dropdown
        $permohonanOnline = Menu::create([
            'nama' => 'PERMOHONAN LAYANAN ONLINE',
            'link' => null,
            'urutan' => 3,
            'parent_id' => $layanan->id,
            'is_active' => true,
            'icon' => 'bi bi-laptop',
            'target' => '_self'
        ]);

        // Sub-sub menu PERMOHONAN LAYANAN ONLINE
        Menu::create(['nama' => 'PEMBELIAN BIBIT ONLINE', 'link' => '#sub1', 'urutan' => 1, 'parent_id' => $permohonanOnline->id, 'is_active' => true, 'icon' => 'bi bi-cart', 'target' => '_self']);
        Menu::create(['nama' => 'BIAYA DAN TARIF', 'link' => '#sub2', 'urutan' => 2, 'parent_id' => $permohonanOnline->id, 'is_active' => true, 'icon' => 'bi bi-currency-dollar', 'target' => '_self']);
        Menu::create(['nama' => 'KUNJUNGAN PENELITIAN DAN MAGANG', 'link' => '#sub3', 'urutan' => 3, 'parent_id' => $permohonanOnline->id, 'is_active' => true, 'icon' => 'bi bi-journal-research', 'target' => '_self']);

        // Lanjutan sub menu LAYANAN
        $subMenusLayanan = [
            ['nama' => 'KUNJUNGAN, PENELITIAN & PEMAGANGAN', 'link' => '#kunjungan', 'urutan' => 4, 'icon' => 'bi bi-person-workspace'],
            ['nama' => 'BIMBINGAN TEKNIS', 'link' => '#bimbingan', 'urutan' => 5, 'icon' => 'bi bi-mortarboard'],
            ['nama' => 'LAYANAN SEWA ASET BALAI', 'link' => '#sewa', 'urutan' => 6, 'icon' => 'bi bi-house-door'],
            ['nama' => 'LABORATORIUM', 'link' => '#lab', 'urutan' => 7, 'icon' => 'bi bi-flask'],
            ['nama' => 'HARGA TERNAK DAN HPT', 'link' => '#harga', 'urutan' => 8, 'icon' => 'bi bi-tags'],
            ['nama' => 'SURVEY KEPUASAN MASYARAKAT', 'link' => '#survei', 'urutan' => 9, 'icon' => 'bi bi-clipboard-data']
        ];

        foreach ($subMenusLayanan as $subMenu) {
            Menu::create([
                'nama' => $subMenu['nama'],
                'link' => $subMenu['link'],
                'urutan' => $subMenu['urutan'],
                'parent_id' => $layanan->id,
                'is_active' => true,
                'icon' => $subMenu['icon'],
                'target' => '_self'
            ]);
        }

        // ================================
        // 4. MENU INFORMASI PUBLIK (dengan sub menu)
        // ================================
        $informasiPublik = Menu::create([
            'nama' => 'INFORMASI PUBLIK',
            'link' => null,
            'urutan' => 4,
            'parent_id' => null,
            'is_active' => true,
            'icon' => 'bi bi-info-circle',
            'target' => '_self'
        ]);

        // Sub menu INFORMASI PUBLIK
        Menu::create(['nama' => 'BERITA TERKINI', 'link' => '/berita', 'urutan' => 1, 'parent_id' => $informasiPublik->id, 'is_active' => true, 'icon' => 'bi bi-newspaper', 'target' => '_self']);
        Menu::create(['nama' => 'ARTIKEL', 'link' => '#artikel', 'urutan' => 2, 'parent_id' => $informasiPublik->id, 'is_active' => true, 'icon' => 'bi bi-file-earmark-text', 'target' => '_self']);
        Menu::create(['nama' => 'PEMBANGUNAN ZONA INTEGRITAS', 'link' => '#zona-integritas', 'urutan' => 3, 'parent_id' => $informasiPublik->id, 'is_active' => true, 'icon' => 'bi bi-shield', 'target' => '_self']);
        Menu::create(['nama' => 'PROTOKOL KESEHATAN COVID19', 'link' => '#protokol-covid', 'urutan' => 4, 'parent_id' => $informasiPublik->id, 'is_active' => true, 'icon' => 'bi bi-virus', 'target' => '_self']);

        // Sub menu PORTAL PPID dengan nested dropdown
        $portalPpid = Menu::create([
            'nama' => 'PORTAL PPID',
            'link' => null,
            'urutan' => 5,
            'parent_id' => $informasiPublik->id,
            'is_active' => true,
            'icon' => 'bi bi-door-open',
            'target' => '_self'
        ]);

        // Sub-sub menu PORTAL PPID
        $subMenusPpid = [
            ['nama' => 'PPID', 'link' => 'https://ppid.pertanian.go.id', 'target' => '_blank'],
            ['nama' => 'INFORMASI PUBLIK SETIAP SAAT', 'link' => '#informasi-setiap-saat', 'target' => '_self'],
            ['nama' => 'INFORMASI PUBLIK BERKALA', 'link' => '#informasi-berkala', 'target' => '_self'],
            ['nama' => 'INFORMASI PUBLIK SERTA MERTA', 'link' => '#informasi-serta-merta', 'target' => '_self'],
            ['nama' => 'TATA CARA PERMOHONAN INFORMASI PUBLIK', 'link' => '#tata-cara', 'target' => '_self'],
            ['nama' => 'HAK ATAS INFORMASI PUBLIK', 'link' => '#hak-informasi', 'target' => '_self'],
            ['nama' => 'MEKANISME PENGAJUAN KEBERATAN', 'link' => '#mekanisme-keberatan', 'target' => '_self'],
            ['nama' => 'PENANGANAN SENGKETA INFORMASI', 'link' => '#sengketa-informasi', 'target' => '_self']
        ];

        foreach ($subMenusPpid as $index => $subMenu) {
            Menu::create([
                'nama' => $subMenu['nama'],
                'link' => $subMenu['link'],
                'urutan' => $index + 1,
                'parent_id' => $portalPpid->id,
                'is_active' => true,
                'icon' => 'bi bi-file-earmark',
                'target' => $subMenu['target']
            ]);
        }

        // Lanjutan sub menu INFORMASI PUBLIK
        $subMenusInfoPublik = [
            ['nama' => 'LAPORAN IKM', 'link' => '#laporan-ikm', 'urutan' => 6, 'icon' => 'bi bi-file-bar-graph'],
            ['nama' => 'DISTRIBUSI BIBIT SAPI PERAH & KAMBING', 'link' => '#bibit-sapi-kambing', 'urutan' => 7, 'icon' => 'bi bi-truck'],
            ['nama' => 'DISTRIBUSI BIBIT HPT', 'link' => '#bibit-hpt', 'urutan' => 8, 'icon' => 'bi bi-boxes'],
            ['nama' => 'PENGADUAN MASYARAKAT', 'link' => '#pengaduan', 'urutan' => 9, 'icon' => 'bi bi-megaphone'],
            ['nama' => 'REGULASI DAN PERATURAN', 'link' => '#regulasi', 'urutan' => 10, 'icon' => 'bi bi-book'],
            ['nama' => 'DAFTAR RANCANGAN KEBIJAKAN', 'link' => '#rancangan-kebijakan', 'urutan' => 11, 'icon' => 'bi bi-list-ol'],
            ['nama' => 'GRAFIK PERKEMBANGAN', 'link' => '#grafik', 'urutan' => 12, 'icon' => 'bi bi-graph-up']
        ];

        foreach ($subMenusInfoPublik as $subMenu) {
            Menu::create([
                'nama' => $subMenu['nama'],
                'link' => $subMenu['link'],
                'urutan' => $subMenu['urutan'],
                'parent_id' => $informasiPublik->id,
                'is_active' => true,
                'icon' => $subMenu['icon'],
                'target' => '_self'
            ]);
        }

        // ================================
        // 5. MENU INOVASI (dengan sub menu)
        // ================================
        $inovasi = Menu::create([
            'nama' => 'INOVASI',
            'link' => null,
            'urutan' => 5,
            'parent_id' => null,
            'is_active' => true,
            'icon' => 'bi bi-lightbulb',
            'target' => '_self'
        ]);

        // Sub menu INOVASI
        $subMenusInovasi = [
            ['nama' => 'HALO DRH', 'link' => '#halo-drh', 'urutan' => 1, 'icon' => 'bi bi-telephone'],
            ['nama' => 'BRADEN', 'link' => '#braden', 'urutan' => 2, 'icon' => 'bi bi-cpu'],
            ['nama' => 'AREVY SYSTEM', 'link' => '#arevy', 'urutan' => 3, 'icon' => 'bi bi-diagram-3'],
            ['nama' => 'RUMINANSIA ONLINE', 'link' => '#ruminansia', 'urutan' => 4, 'icon' => 'bi bi-globe'],
            ['nama' => 'BREEDING ONLINE', 'link' => '#breeding', 'urutan' => 5, 'icon' => 'bi bi-heart-pulse'],
            ['nama' => 'E-PERSONAL', 'link' => '#e-personal', 'urutan' => 6, 'icon' => 'bi bi-person-badge'],
            ['nama' => 'E-DUPAK', 'link' => '#e-dupak', 'urutan' => 7, 'icon' => 'bi bi-file-earmark-check'],
            ['nama' => 'BUKU PINTAR INOVASI', 'link' => '#buku', 'urutan' => 8, 'icon' => 'bi bi-book-half']
        ];

        foreach ($subMenusInovasi as $subMenu) {
            Menu::create([
                'nama' => $subMenu['nama'],
                'link' => $subMenu['link'],
                'urutan' => $subMenu['urutan'],
                'parent_id' => $inovasi->id,
                'is_active' => true,
                'icon' => $subMenu['icon'],
                'target' => '_self'
            ]);
        }

        // ================================
        // 6. MENU UNDUH
        // ================================
        Menu::create([
            'nama' => 'UNDUH',
            'link' => '#unduh',
            'urutan' => 6,
            'parent_id' => null,
            'is_active' => true,
            'icon' => 'bi bi-download',
            'target' => '_self'
        ]);

        // ================================
        // 7. MENU KONTAK KAMI
        // ================================
        Menu::create([
            'nama' => 'KONTAK KAMI',
            'link' => '#kontak',
            'urutan' => 7,
            'parent_id' => null,
            'is_active' => true,
            'icon' => 'bi bi-envelope',
            'target' => '_self'
        ]);

        $this->command->info('✅ Menu seeder berhasil dijalankan!');
        $this->command->info('📊 Total menu: ' . Menu::count());
        $this->command->info('📁 Menu utama: ' . Menu::whereNull('parent_id')->count());
        $this->command->info('📄 Sub menu: ' . Menu::whereNotNull('parent_id')->count());
    }
}
