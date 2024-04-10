<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\pengguna;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function addPengarang(Request $request)
    {
        if (empty($request->id_pengarang)) {
            $request->validate([
                'email' => 'unique:pengarang,email',
            ], [
                'email.unique' => 'Email sudah terpakai',
            ]);
            if ($request->foto) {
                $path = $request->file('foto')->store('pengarang', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $path = $request->fotoOld;
            $check = Pengarang::find($request->id_pengarang);
            if ($check->email != $request->email) {
                $request->validate([
                    'email' => 'unique:pengarang,email',
                ], [
                    'email.unique' => 'Email sudah terpakai',
                ]);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('pengarang', ['disk' => 'public']);
                }
            }
        };
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required',
            'no' => 'required|numeric',
            'alamat' => 'required',
            'jenisKelamin' => 'required',
            'tanggalLahir' => 'required|date',
            'tempatLahir' => 'required',
            'desk' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'no.required' => 'Nomor HP tidak boleh kosong',
            'no.numeric' => 'Nomor HP harus berupa angka',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'jenisKelamin.required' => 'Jenis Kelamin tidak boleh kosong',
            'tanggalLahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'tanggalLahir.date' => 'Tanggal Lahir harus berupa tanggal',
            'tempatLahir.required' => 'Tempat Lahir tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ]);
        if (Pengarang::updateOrCreate([
            'id_pengarang' => $request->id_pengarang,
        ], [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenisKelamin,
            'tanggal_lahir' => \Carbon\Carbon::parse($request->tanggalLahir)->format('Y-m-d'),
            'tempat_lahir' => $request->tempatLahir,
            'deskripsi' => $request->desk,
            'foto' => $path,
            'slug' => Str::slug($request->nama),
            'pendidikan_terakhir' => $request->pendidikanTerakhir,
            'pekerjaan' => $request->pekerjaan,
            'pengalaman_kerja' => $request->pengalamanKerja,
            'riwayat_pendidikan' => $request->pendidikanRiwayat,
            'riwayat_pekerjaan' => $request->riwayatPekerjaan,
            'penghargaan' => $request->penghargaan,
        ])) {
            return redirect('/pengarang-admin')->with('success', 'Pengarang berhasil dijalankan');
        }
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }

    public function addPenerbit(Request $request)
    {
        if (empty($request->id_penerbit)) {
            $request->validate([
                'email' => 'unique:penerbit,email',
            ], [
                'email.unique' => 'Email sudah terpakai',
            ]);
            if ($request->foto) {
                $path = $request->file('foto')->store('penerbit', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $path = $request->fotoOld;
            $check = Penerbit::find($request->id_penerbit);
            if ($check->email != $request->email) {
                $request->validate([
                    'email' => 'unique:penerbit,email',
                ], [
                    'email.unique' => 'Email sudah terpakai',
                ]);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('penerbit', ['disk' => 'public']);
                }
            }
        };
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required',
            'no' => 'required|numeric',
            'alamat' => 'required',
            'desk' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'no.required' => 'Nomor HP tidak boleh kosong',
            'no.numeric' => 'Nomor HP harus berupa angka',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ]);
        if (Penerbit::updateOrCreate([
            'id_penerbit' => $request->id_penerbit,
        ], [
            'nama_penerbit' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no,
            'alamat' => $request->alamat,
            'deskripsi' => $request->desk,
            'foto' => $path,
            'slug' => Str::slug($request->nama),
        ])) {
            return redirect('/penerbit-admin')->with('success', 'penerbit berhasil dijalankan');
        }
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }

    public function addKategori(Request $request)
    {
        if (empty($request->id_kategori)) {
            $request->validate([
                'nama' => 'unique:kategori,nama_kategori',
            ], [
                'nama.unique' => 'Kategori sudah tersedia',
            ]);
        }else{
            $check = Kategori::find($request->id_kategori);
            if ($check->nama_kategori != $request->nama) {
                $request->validate([
                    'nama' => 'unique:kategori,nama_kategori',
                ], [
                    'nama.unique' => 'kategori sudah tersedia',
                ]);
            }
        }
        $request->validate([
            'nama' => 'required',
            'desk' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
        ]);
        if (Kategori::updateOrCreate([
            'id_kategori' => $request->id_kategori,
        ], [
            'nama_kategori' => $request->nama,
            'deskripsi' => $request->desk,
            'slug' => Str::slug($request->nama),
        ])) {
            return redirect('/kategori-admin')->with('success', 'kategori berhasil dijalankan');
        }
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }

    public function addFakultas(Request $request)
    {
        if (empty($request->id_fakultas)) {
            $request->validate([
                'nama' => 'unique:fakultas,nama_fakultas',
            ], [
                'nama.unique' => 'fakultas sudah tersedia',
            ]);
            if ($request->foto) {
                $path = $request->file('foto')->store('fakultas', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        }else{
            $check = Fakultas::find($request->id_fakultas);
            $path = $check->foto;
            if ($check->nama_fakultas != $request->nama) {
                $request->validate([
                    'nama' => 'unique:fakultas,nama_fakultas',
                ], [
                    'nama.unique' => 'fakultas sudah tersedia',
                ]);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('fakultas', ['disk' => 'public']);
                }
            }
        }
        $request->validate([
            'nama' => 'required',
            'desk' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ]);
        if (Fakultas::updateOrCreate([
            'id_fakultas' => $request->id_fakultas,
        ], [
            'nama_fakultas' => $request->nama,
            'deskripsi' => $request->desk,
            'foto' => $path,
            'slug' => Str::slug($request->nama),
        ])) {
            return redirect('/fakultas-admin')->with('success', 'fakultas berhasil dijalankan');
        }
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }

    public function addProdi(Request $request)
    {
        if (empty($request->id_prodi)) {
            $request->validate([
                'nama' => 'unique:prodi,nama_prodi',
            ], [
                'nama.unique' => 'prodi sudah tersedia',
            ]);
            if ($request->foto) {
                $path = $request->file('foto')->store('prodi', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        }else{
            $check = Prodi::find($request->id_prodi);
            $path = $check->foto;
            if ($check->nama_prodi != $request->nama) {
                $request->validate([
                    'nama' => 'unique:prodi,nama_prodi',
                ], [
                    'nama.unique' => 'prodi sudah tersedia',
                ]);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('prodi', ['disk' => 'public']);
                }
            }
        }
        $request->validate([
            'nama' => 'required',
            'desk' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ]);
        if (Prodi::updateOrCreate([
            'id_prodi' => $request->id_prodi,
        ], [
            'nama_prodi' => $request->nama,
            'deskripsi' => $request->desk,
            'foto' => $path,
            'slug' => Str::slug($request->nama),
        ])) {
            return redirect('/prodi-admin')->with('success', 'prodi berhasil dijalankan');
        }
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }
}
