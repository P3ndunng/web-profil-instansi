<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('beritas')->insert([
            [
                'title' => 'Peluncuran Program Baru BBPTUHPT',
                'slug' => Str::slug('Peluncuran Program Baru BBPTUHPT'),
                'content' => 'BBPTUHPT baru saja meluncurkan program inovatif untuk mendukung peternakan berkelanjutan.',
                'author' => 'Admin',
                'published_at' => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kegiatan Pelatihan Peternak Muda',
                'slug' => Str::slug('Kegiatan Pelatihan Peternak Muda'),
                'content' => 'Pelatihan ini diikuti oleh puluhan peternak muda dari berbagai daerah di Indonesia.',
                'author' => 'Redaksi',
                'published_at' => Carbon::now()->subDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
