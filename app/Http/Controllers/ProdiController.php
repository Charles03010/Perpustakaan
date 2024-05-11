<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdiRequest;
use App\Models\Prodi;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ProdiController extends Controller
{
    public function index()
    {
        return view('admin.prodi.index', ['prodi' => Prodi::all()]);
    }
    public function create()
    {
        return view('admin.prodi.tambah');
    }
    public function store(ProdiRequest $request)
    {
        function uniq_name($request)
        {
            $request->validate([
                'nama' => 'unique:prodi,nama_prodi',
            ], [
                'nama.unique' => 'prodi sudah tersedia',
            ]);
        }
        if (empty($request->id_prodi)) {
            uniq_name($request);
            if ($request->foto) {
                $path = $request->file('foto')->store('prodi', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $check = Prodi::find($request->id_prodi);
            $path = $check->foto;
            if ($check->nama_prodi != $request->nama_prodi) {
                uniq_name($request);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('prodi', ['disk' => 'public']);
                }
            }
        }
        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->nama_prodi);
        $validated['foto'] = $path;
        if (Prodi::updateOrCreate([
            'id_prodi' => $request->id_prodi,
        ], $validated)) {
            Alert::success('Berhasil', 'prodi berhasil disimpan');
            return redirect()->route('admin.prodi.index')->with('success', 'prodi berhasil dijalankan');
        }
        Alert::error('Gagal', 'prodi gagal disimpan');
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }
    public function show($id)
    {
        $prodi = Prodi::findOrFail($id);
        return view('admin.prodi.detail', ['prodi' => $prodi]);
    }
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        return view('admin.prodi.tambah', ['prodi' => $prodi]);
    }
    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        if ($prodi->foto != 'default.jpg') {
            Storage::delete('public/' . $prodi->foto);
        };
        if ($prodi->delete()) {
            Alert::success('Berhasil', 'prodi berhasil dihapus');
            return redirect()->route('admin.prodi.index')->with('success', 'prodi berhasil dihapus');
        };
        Alert::error('Gagal', 'prodi gagal dihapus');
        return back()->withErrors('Maaf Proses Gagal');
    }
}
