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
        Schema::create('pengarang', function (Blueprint $table) {
            $table->id("id_pengarang");
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('foto');
            $table->string('deskripsi');
            $table->string('slug');
            $table->enum('jenis_kelamin',['L','P']);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('pendidikan_terakhir');
            $table->string('pekerjaan');
            $table->string('pengalaman_kerja');
            $table->string('riwayat_pendidikan');
            $table->string('riwayat_pekerjaan');
            $table->string('penghargaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengarang');
    }
};
