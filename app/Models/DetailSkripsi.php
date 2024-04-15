<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSkripsi extends Model
{
    use HasFactory;
    protected $table = 'detail_skripsi';
    protected $primaryKey = 'id_skripsi';
    protected $fillable = [
        "id_repositori",
        "file",
        "status",
        "pembimbing",
        "penguji",
        "id_prodi",
        "id_fakultas",
    ];
}
