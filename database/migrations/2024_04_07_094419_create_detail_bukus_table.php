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
        Schema::create('detail_buku', function (Blueprint $table) {
            $table->id("id_buku");
            $table->foreignId('id_repositori')->constrained('repositori','id_repositori')->cascadeOnDelete();
            $table->string('foto');
            $table->string('isbn');
            $table->string('jumlah_buku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_buku');
    }
};
