<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->text('caption')->nullable(); // ✅ tambahkan kolom caption
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('galeris');
    }
};
