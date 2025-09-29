<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengumumen', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi')->nullable();
            $table->string('file')->nullable(); // jika ada lampiran
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumen');
    }
};
