<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetailBuku extends Model
{
    use HasFactory;
    protected $table = 'detail_buku';
    protected $primaryKey = 'id_buku';
    protected $fillable = [
        "id_repositori",
        "foto",
        "isbn",
        'jumlah_buku',
    ];
    function repo() : HasOne
    {
        return $this->hasOne(Repositori::class, 'id_repositori', 'id_repositori');        
    }
}
