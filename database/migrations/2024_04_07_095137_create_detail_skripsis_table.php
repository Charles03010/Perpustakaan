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
        Schema::create('detail_skripsi', function (Blueprint $table) {
            $table->id("id_skripsi");
            $table->foreignId('id_repositori')->constrained('repositori','id_repositori')->cascadeOnDelete();
            $table->string('file');
            $table->enum('status',['pending','diterima','ditolak'])->default('pending');
            $table->string('pembimbing');
            $table->string('penguji');
            $table->foreignId('id_prodi')->constrained('prodi','id_prodi')->cascadeOnDelete();
            $table->foreignId('id_fakultas')->constrained('fakultas','id_fakultas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_skripsi');
    }
};
