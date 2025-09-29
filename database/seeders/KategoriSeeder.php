<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'nama' => 'Pengumuman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Informasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
