<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambahkan kolom jika belum ada
        if (!Schema::hasColumn('infos', 'tanggal')) {
            Schema::table('infos', function (Blueprint $table) {
                $table->date('tanggal')->nullable()->after('isi');
            });
        }

        if (!Schema::hasColumn('infos', 'tempat')) {
            Schema::table('infos', function (Blueprint $table) {
                $table->string('tempat')->nullable()->after('tanggal');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak perlu drop kolom dalam migration fix
        // Kolom akan tetap ada meski migration di-rollback
    }
};
