<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sliders')->insert([
            [
                'judul' => 'Selamat Datang di Website Kami',
                'deskripsi' => 'Informasi terbaru seputar kegiatan dan layanan.',
                'gambar' => 'sliders/slider1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Agenda Terbaru',
                'deskripsi' => 'Ikuti agenda kegiatan kami yang sudah dijadwalkan.',
                'gambar' => 'sliders/slider2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Pengumuman Penting',
                'deskripsi' => 'Simak pengumuman resmi yang kami terbitkan di website ini.',
                'gambar' => 'sliders/slider3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
