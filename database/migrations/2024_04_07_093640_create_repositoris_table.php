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
        Schema::create('repositori', function (Blueprint $table) {
            $table->id("id_repositori");
            $table->foreignId('id_pengarang')->constrained('pengarang','id_pengarang')->cascadeOnDelete();
            $table->foreignId('id_penerbit')->constrained('penerbit','id_penerbit')->cascadeOnDelete();
            $table->foreignId('id_kategori')->constrained('kategori','id_kategori')->cascadeOnDelete();
            $table->string('judul');
            $table->string('deskripsi');
            $table->string('slug');
            $table->string('tahun_terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repositori');
    }
};
