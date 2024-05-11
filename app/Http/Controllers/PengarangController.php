<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengarangRequest;
use App\Models\Pengarang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PengarangController extends Controller
{
    public function index()
    {
        return view('admin.pengarang.index', ['pengarang' => Pengarang::all()]);
    }
    public function create()
    {
        return view('admin.pengarang.tambah');
    }
    public function store(PengarangRequest $request)
    {
        function uniq_email($request)
        {
            $request->validate([
                'email' => 'unique:pengarang,email',
            ], [
                'email.unique' => 'Email sudah terpakai',
            ]);
        }
        if (empty($request->id_pengarang)) {
            uniq_email($request);
            if ($request->foto) {
                $path = $request->file('foto')->store('pengarang', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $check = Pengarang::find($request->id_pengarang);
            $path = $check->foto;
            if ($check->email != $request->email) {
                uniq_email($request);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('pengarang', ['disk' => 'public']);
                }
            }
        };
        $validated = $request->validated();
        $validated['foto'] = $path;
        $validated['slug'] = Str::slug($validated['nama']);
        $validated['tanggal_lahir'] = \Carbon\Carbon::parse($validated['tanggal_lahir'])->format('Y-m-d');
        if (Pengarang::updateOrCreate([
            'id_pengarang' => $request['id_pengarang'],
        ], $validated)) {
            Alert::success('Berhasil', 'Pengarang berhasil dijalankan');
            return redirect()->route('admin.pengarang.index')->with('success', 'Pengarang berhasil dijalankan');
        }
        Alert::error('Gagal', 'Pengarang gagal dijalankan');
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }
    public function show($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return view('admin.pengarang.detail', ['pengarang' => $pengarang]);
    }
    public function edit($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return view('admin.pengarang.tambah', ['pengarang' => $pengarang]);
    }
    public function destroy($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        if ($pengarang->foto != 'default.jpg') {
            Storage::delete('public/' . $pengarang->foto);
        };
        if ($pengarang->delete()) {
            Alert::success('Berhasil', 'Pengarang berhasil dihapus');
            return redirect()->route('admin.pengarang.index')->with('success', 'Pengarang berhasil dihapus');
        };
        Alert::error('Gagal', 'Pengarang gagal dihapus');
        return back()->withErrors('Maaf Proses Gagal');
    }
}
