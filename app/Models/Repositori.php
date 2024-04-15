<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repositori extends Model
{
    use HasFactory;
    protected $table = 'repositori';
    protected $primaryKey = 'id_repositori';
    protected $fillable = [
        'id_pengarang',
        'id_penerbit',
        'id_kategori',
        'judul',
        'deskripsi',
        'slug',
        'tahun_terbit',
    ];
}
