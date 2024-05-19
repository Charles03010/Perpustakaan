<?php

namespace App\Http\Controllers;

use App\Models\DetailBuku;
use App\Models\DetailSkripsi;
use App\Models\Peminjaman;
use App\Models\pengguna;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pinjamList = [];
        foreach (Peminjaman::all() as $pinjam) {
            $pinjamList[] = [$pinjam, $pinjam->user, $pinjam->repo];
        }
        $graph = [count(Peminjaman::all()), count(DetailBuku::all()), count(DetailSkripsi::all()), count(pengguna::all())];
        return view('admin.dashboard', ['peminjaman' => $pinjamList, 'graph' => $graph]);
    }
}
