<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengumumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengumumen')->insert([
            [
                'judul' => 'Pengumuman Libur Nasional',
                'isi' => 'Kantor tutup pada tanggal 1 Oktober 2025 karena libur nasional.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Maintenance Server',
                'isi' => 'Server akan dimatikan sementara pada pukul 23.00 WIB untuk maintenance.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
