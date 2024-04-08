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
            $table->string('foto')->nullable();
            $table->string('deskripsi');
            $table->string('slug');
            $table->enum('jenis_kelamin',['L','P']);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('pengalaman_kerja')->nullable();
            $table->string('riwayat_pendidikan')->nullable();
            $table->string('riwayat_pekerjaan')->nullable();
            $table->string('penghargaan')->nullable();
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
