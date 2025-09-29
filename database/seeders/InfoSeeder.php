<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InfoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('infos')->insert([
            [
                'judul' => 'Informasi Pelayanan',
                'isi' => 'Pelayanan administrasi dibuka setiap hari kerja pukul 08.00 - 15.00 WIB.',
                'kategori_id' => 1, // contoh kategori id 1
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Kontak Darurat',
                'isi' => 'Untuk keadaan darurat silakan hubungi nomor telepon resmi BBPTUHPT Baturaden.',
                'kategori_id' => 1, // contoh kategori id 1
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
