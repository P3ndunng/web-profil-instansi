<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaleriSeeder extends Seeder
{
    public function run()
    {
        DB::table('galeris')->insert([
            [
                'title' => 'Kegiatan Upacara',
                'caption' => 'Dokumentasi upacara bendera rutin di lingkungan BBPTUHPT.',
                'image_path' => 'images/galeri/upacara.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pelatihan Lapangan',
                'caption' => 'Peserta pelatihan sedang melakukan praktik lapangan.',
                'image_path' => 'images/galeri/pelatihan.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Gotong Royong',
                'caption' => 'Kegiatan gotong royong bersama membersihkan area sekitar balai.',
                'image_path' => 'images/galeri/gotong_royong.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kunjungan Kerja',
                'caption' => 'Kunjungan kerja dari tim pusat untuk monitoring kegiatan.',
                'image_path' => 'images/galeri/kunjungan.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pameran Produk',
                'caption' => 'Peserta memamerkan produk hasil ternak dalam pameran tahunan.',
                'image_path' => 'images/galeri/pameran.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
