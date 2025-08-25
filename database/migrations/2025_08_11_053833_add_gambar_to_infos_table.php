<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('infos', function (Blueprint $table) {
            // Pastikan kolom 'gambar' belum ada
            if (!Schema::hasColumn('infos', 'gambar')) {
                if (Schema::hasColumn('infos', 'tanggal')) {
                    $table->string('gambar', 255)->nullable()->after('tanggal');
                } else {
                    $table->string('gambar', 255)->nullable();
                }
            }
        });
    }

    public function down()
    {
        Schema::table('infos', function (Blueprint $table) {
            if (Schema::hasColumn('infos', 'gambar')) {
                $table->dropColumn('gambar');
            }
        });
    }
};
