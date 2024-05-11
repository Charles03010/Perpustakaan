<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenerbitRequest;
use App\Models\Penerbit;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PenerbitController extends Controller
{
    public function index()
    {
        return view('admin.penerbit.index', ['penerbit' => Penerbit::all()]);
    }
    public function create()
    {
        return view('admin.penerbit.tambah');
    }
    public function store(PenerbitRequest $request)
    {
        function uniq_email($request)
        {
            $request->validate([
                'email' => 'unique:penerbit,email',
            ], [
                'email.unique' => 'Email sudah terpakai',
            ]);
        }
        if (empty($request->id_penerbit)) {
            uniq_email($request);
            if ($request->foto) {
                $path = $request->file('foto')->store('penerbit', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $check = Penerbit::find($request->id_penerbit);
            $path = $check->foto;
            if ($check->email != $request->email) {
                uniq_email($request);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('penerbit', ['disk' => 'public']);
                }
            }
        };
        $validated = $request->validated();
        $validated['foto'] = $path;
        $validated['slug'] = Str::slug($validated['nama_penerbit']);
        if (Penerbit::updateOrCreate([
            'id_penerbit' => $request->id_penerbit,
        ], $validated)) {
            Alert::success('Berhasil', 'penerbit berhasil dijalankan');
            return redirect()->route('admin.penerbit.index')->with('success', 'penerbit berhasil dijalankan');
        }
        Alert::error('Gagal', 'penerbit gagal dijalankan');
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }
    public function show($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('admin.penerbit.detail', ['penerbit' => $penerbit]);
    }
    public function edit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('admin.penerbit.tambah', ['penerbit' => $penerbit]);
    }
    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        if ($penerbit->foto != 'default.jpg') {
            Storage::delete('public/' . $penerbit->foto);
        };
        if ($penerbit->delete()) {
            Alert::success('Berhasil', 'penerbit berhasil dihapus');
            return redirect()->route('admin.penerbit.index')->with('success', 'penerbit berhasil dihapus');
        };
        Alert::error('Gagal', 'penerbit gagal dihapus');
        return back()->withErrors('Maaf Proses Gagal');
    }
}
