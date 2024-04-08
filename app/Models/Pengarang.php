<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    use HasFactory;
    protected $table = 'pengarang';
    protected $primaryKey = 'id_pengarang';
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'alamat',
        'foto',
        'deskripsi',
        'slug',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'pendidikan_terakhir',
        'pekerjaan',
        'pengalaman_kerja',
        'riwayat_pendidikan',
        'riwayat_pekerjaan',
        'penghargaan',
    ];
}
