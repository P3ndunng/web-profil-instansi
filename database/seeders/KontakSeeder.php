<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KontakSeeder extends Seeder
{
    public function run()
    {
        DB::table('kontaks')->insert([
            [
                'nama' => 'Fakhri Aziz',
                'email' => 'fakhri@example.com',
                'telepon' => '081234567890',
                'pesan' => 'Halo admin, saya ingin menanyakan informasi lebih lanjut.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Aminah',
                'email' => 'siti@example.com',
                'telepon' => '082345678901',
                'pesan' => 'Apakah ada pelatihan peternakan minggu depan?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'telepon' => '083456789012',
                'pesan' => 'Saya tertarik mengikuti program kerja sama.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
