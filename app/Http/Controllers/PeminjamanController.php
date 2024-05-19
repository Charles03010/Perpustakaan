<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanRequest;
use App\Models\Peminjaman;
use App\Models\pengguna;
use App\Models\Repositori;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    public function index()
    {
        $pinjamList = [];
        foreach (Peminjaman::all() as $pinjam) {
            $pinjamList[] = [$pinjam, $pinjam->user, $pinjam->repo];
        }
        return view('admin.peminjaman.index', ['peminjaman' => $pinjamList]);
    }
    public function create()
    {
        return view('admin.peminjaman.tambah', ['repo' => Repositori::all(), 'pengguna' => Pengguna::all()]);
    }
    public function store(PeminjamanRequest $request)
    {
        $validated = $request->validated();
        $validated['id_pengguna'] = explode(' - ', $request->id_pengguna)[0];
        $validated['id_repositori'] = explode(' - ', $request->id_repositori)[0];
        if (Peminjaman::updateOrCreate(['id_peminjaman' => $request->id_peminjaman], $validated)) {
            Alert::success('Sukses', 'peminjaman berhasil diupdate');
            return redirect()->route('admin.peminjaman.index')->with('success', 'peminjaman berhasil diupdate');
        }
        Alert::error('Gagal', 'peminjaman gagal diupdate');
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('admin.peminjaman.tambah', ['peminjaman' => $peminjaman, 'repo' => Repositori::all(), 'pengguna' => Pengguna::all()]);
    }
    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('admin.peminjaman.detail', ['peminjaman' => $peminjaman, 'pengguna' => pengguna::findOrFail($peminjaman->id_pengguna), 'repositori' => Repositori::findOrFail($peminjaman->id_repositori)]);
    }
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        if ($peminjaman->delete()) {
            Alert::success('Sukses', 'peminjaman berhasil dihapus');
            return redirect()->route('admin.peminjaman.index')->with('success', 'peminjaman berhasil dihapus');
        };
        Alert::error('Gagal', 'peminjaman gagal dihapus');
        return back()->withErrors('Maaf Proses Gagal');
    }
}
