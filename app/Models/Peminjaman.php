<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = [
        'id_pengguna',
        'id_repositori',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'denda',
        'keterangan'
    ];
    function repo() : HasOne
    {
        return $this->hasOne(Repositori::class, 'id_repositori', 'id_repositori');        
    }
    function user() : HasOne
    {
        return $this->hasOne(pengguna::class, 'id_pengguna', 'id_pengguna');
    }
}
