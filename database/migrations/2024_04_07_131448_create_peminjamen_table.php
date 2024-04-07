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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id("id_peminjaman");
            $table->foreignId('id_pengguna')->constrained('pengguna','id_pengguna')->cascadeOnDelete();
            $table->foreignId('id_repositori')->constrained('repositori','id_repositori')->cascadeOnDelete();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->enum('status',['dipinjam','dikembalikan'])->default('dipinjam');
            $table->string('denda');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};