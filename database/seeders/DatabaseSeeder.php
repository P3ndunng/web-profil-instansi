<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user default kalau belum ada
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Jalankan seeder lain
        $this->call([
            PengumumenSeeder::class,
            ArtikelSeeder::class,
            SliderSeeder::class,
            BeritaSeeder::class,
            KategoriSeeder::class,
            InfoSeeder::class,
            GaleriSeeder::class,
            KontakSeeder::class,
        ]);
    }
}
