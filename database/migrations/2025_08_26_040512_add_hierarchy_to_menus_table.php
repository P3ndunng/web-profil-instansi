<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            // Tambah kolom baru
            $table->unsignedBigInteger('parent_id')->nullable()->after('urutan');
            $table->boolean('is_active')->default(true)->after('parent_id');
            $table->string('icon')->nullable()->after('is_active');
            $table->string('target')->default('_self')->after('icon');

            // Ubah kolom link jadi nullable (untuk menu dropdown)
            $table->string('link')->nullable()->change();

            // Tambah foreign key constraint
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');

            // Tambah index untuk performa
            $table->index(['parent_id', 'urutan']);
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            // Hapus foreign key dulu
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['parent_id', 'urutan']);

            // Hapus kolom yang ditambahkan
            $table->dropColumn(['parent_id', 'is_active', 'icon', 'target']);
        });
    }
};
