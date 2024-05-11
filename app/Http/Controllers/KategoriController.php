<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function index()
    {
        return view('admin.kategori.index', ['kategori' => Kategori::all()]);
    }
    public function create()
    {
        return view('admin.kategori.tambah');
    }
    public function store(KategoriRequest $request)
    {
        function uniq_valid($request)
        {
            $request->validate([
                'nama_kategori' => 'unique:kategori,nama_kategori',
            ], [
                'nama_kategori.unique' => 'Kategori sudah tersedia',
            ]);
        }
        if (empty($request->id_kategori)) {
            uniq_valid($request);
        } else {
            $check = Kategori::find($request->id_kategori);
            if ($check->nama_kategori != $request->nama_kategori) {
                uniq_valid($request);
            }
        }
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['nama_kategori']);
        if (Kategori::updateOrCreate(['id_kategori' => $request->id_kategori], $validated)) {
            Alert::success('Sukses', 'Kategori berhasil diupdate');
            return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diupdate');
        }
        Alert::error('Gagal', 'Kategori gagal diupdate');
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.tambah', ['kategori' => $kategori]);
    }
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        if ($kategori->delete()) {
            Alert::success('Sukses', 'kategori berhasil dihapus');
            return redirect()->route('admin.kategori.index')->with('success', 'kategori berhasil dihapus');
        };
        Alert::error('Gagal', 'Kategori gagal dihapus');
        return back()->withErrors('Maaf Proses Gagal');
    }
}
