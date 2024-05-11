<?php

namespace App\Http\Controllers;

use App\Http\Requests\FakultasRequest;
use App\Models\Fakultas;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class FakultasController extends Controller
{
    public function index()
    {
        return view('admin.fakultas.index', ['fakultas' => Fakultas::all()]);
    }
    public function create()
    {
        return view('admin.fakultas.tambah');
    }
    public function store(FakultasRequest $request)
    {
        function uniq_name($request)
        {
            $request->validate([
                'nama' => 'unique:fakultas,nama_fakultas',
            ], [
                'nama.unique' => 'fakultas sudah tersedia',
            ]);
        }
        if (empty($request->id_fakultas)) {
            uniq_name($request);
            if ($request->foto) {
                $path = $request->file('foto')->store('fakultas', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $check = Fakultas::find($request->id_fakultas);
            $path = $check->foto;
            if ($check->nama_fakultas != $request->nama_fakultas) {
                uniq_name($request);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('fakultas', ['disk' => 'public']);
                }
            }
        }
        $validated = $request->validated();
        $validated['foto'] = $path;
        $validated['slug'] = Str::slug($request->nama_fakultas);
        if (Fakultas::updateOrCreate([
            'id_fakultas' => $request->id_fakultas,
        ], $validated)) {
            Alert::success('Berhasil', 'fakultas berhasil disimpan');
            return redirect()->route('admin.fakultas.index')->with('success', 'fakultas berhasil dijalankan');
        }
        Alert::error('Gagal', 'fakultas gagal disimpan');
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }
    public function show($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('admin.fakultas.detail', ['fakultas' => $fakultas]);
    }
    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('admin.fakultas.tambah', ['fakultas' => $fakultas]);
    }
    public function destroy($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        if ($fakultas->foto != 'default.jpg') {
            Storage::delete('public/' . $fakultas->foto);
        };
        if ($fakultas->delete()) {
            Alert::success('Berhasil', 'fakultas berhasil dihapus');
            return redirect()->route('admin.fakultas.index')->with('success', 'fakultas berhasil dihapus');
        };
        Alert::error('Gagal', 'fakultas gagal dihapus');
        return back()->withErrors('Maaf Proses Gagal');
    }
}
