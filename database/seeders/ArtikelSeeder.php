<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('artikels')->insert([
            [
                'judul' => 'Teknologi Peternakan Modern',
                'isi' => 'Artikel ini membahas perkembangan terbaru dalam teknologi peternakan modern.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Manfaat Pakan Organik',
                'isi' => 'Pakan organik memiliki manfaat besar bagi kesehatan ternak.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
