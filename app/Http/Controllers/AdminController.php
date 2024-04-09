<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use App\Models\pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function add(Request $request)
    {
        if (empty($request->id_pengarang)) {
            $request->validate([
                'email' => 'unique:pengarang,email',
            ], [
                'email.unique' => 'Email sudah terpakai',
            ]);
            if ($request->foto) {
                $path = $request->file('foto')->store('images');
            }else{
                $path = 'default.jpg';
            }
        } else {
            $path = $request->fotoOld;
            $check = Pengarang::find($request->id_pengarang);
            if($check->email != $request->email){
                $request->validate([
                    'email' => 'unique:pengarang,email',
                ], [
                    'email.unique' => 'Email sudah terpakai',
                ]);
            }else if($check->foto != $request->foto){
                Storage::delete($check->foto);
                $path = $request->file('foto')->store('images');
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
}
